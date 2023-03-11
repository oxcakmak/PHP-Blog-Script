<?php require_once('config.php');
/* Custom Json Builder */
function jsonBuilder($text, $type, $redirectLocation, $redirectInterval){
	$data['msgText'] = $text;
	$data['msgType'] = $type;
	$data['msgRedirectLocation'] = $redirectLocation;
	$data['msgRedirectInterval'] = $redirectInterval * 1000;
	echo html_entity_decode(json_encode(array_map('htmlentities',$data)));
}
/*
Text - Type - Location - Interval
jsonBuilder($lang['msg_empty'], 0, "REPLACE_ME", 5);
*/
/* Custom Url Making */
function makeUrl($address){ global $config; return $config['url'].$address; }
if(isset($_SESSION['session'])){
	/* Update Settings Meta */
	if(isset($_POST['updateSettingsMeta'])){
		$metaTitle = $hf->sclr($_POST['metaTitle']);
		$metaDescription = $hf->sclr($_POST['metaDescription']);
		$metaFooter = $hf->sclr($_POST['metaFooter']);
		if(!$metaTitle || !$metaDescription || !$metaFooter){ jsonBuilder($lang['msg_empty'], 0, NULL, 5); }else{
			$metaData = [
				'title' => $metaTitle,
				'description' => $metaDescription,
				'footer' => $metaFooter
			];
			$dbh->where("name", "config");
			if(!$dbh->update("config", $metaData)){ jsonBuilder($lang['msg_error'], 0, NULL, 5); }else{
				jsonBuilder($lang['msg_settings_meta_updated'], 1, $dot.$route['settings'], 5);
			}
		}
	}
	/* Update Settings Contact */
	if(isset($_POST['updateSettingsContact'])){
		$contactPhone = $hf->sclr($_POST['contactPhone']);
		$contactEmail = $hf->sclr($_POST['contactEmail']);
		$contactAddress = $hf->sclr($_POST['contactAddress']);
		if(!$contactPhone || !$contactEmail || !$contactAddress){ jsonBuilder($lang['msg_empty'], 0, NULL, 5); }else{
			$contactData = [
				'phone' => $contactPhone,
				'email' => $contactEmail,
				'address' => $contactAddress
			];
			$dbh->where("name", "config");
			if(!$dbh->update("config", $contactData)){ jsonBuilder($lang['msg_error'], 0, NULL, 5); }else{
				jsonBuilder($lang['msg_settings_contact_updated'], 1, $dot.$route['settings'], 5);
			}
		}
	}
	/* Update Settings Banner */
	if(isset($_POST['updateSettingsBanner'])){
		$bannerTitle = $hf->sclr($_POST['bannerTitle']);
		$bannerParagraph = $hf->sclr($_POST['bannerParagraph']);
		$btnTitle = $hf->sclr($_POST['btnTitle']);
		$btnHref = $hf->sclr($_POST['btnHref']);
		$btnStatus = $hf->sclr($_POST['btnStatus']);
		if(!$bannerTitle || !$bannerParagraph || !$btnTitle || !$btnHref || !$btnStatus){ jsonBuilder($lang['msg_empty'], 0, NULL, 5); }else{
			$bannerData = [
				'bannerTitle' => $bannerTitle,
				'bannerParagraph' => $bannerParagraph,
				'bannerBtnText' => $btnTitle,
				'bannerBtnAddress' => $btnHref,
				'bannerBtnStatus' => $btnStatus
			];
			$dbh->where("name", "config");
			if(!$dbh->update("config", $bannerData)){ jsonBuilder($lang['msg_error'], 0, NULL, 5); }else{
				jsonBuilder($lang['msg_settings_banner_updated'], 1, $dot.$route['settings'], 5);
			}
		}
	}
	/* Update Password */
	if(isset($_POST['updatePassword'])){
		$lastPass = $hf->sclr($_POST['lastPass']);
		$lastHash = $hf->hval($lastPass);
		$newPass = $hf->sclr($_POST['newPass']);
		$newHash = $hf->hval($newPass);
		$reNewPass = $hf->sclr($_POST['reNewPass']);
		$reNewHash = $hf->hval($reNewPass);
		if(!$lastPass || !$newPass || !$reNewPass){ jsonBuilder($lang['msg_empty'], 0, NULL, 5); }else{
			if($lastHash != $userData['password']){ jsonBuilder($lang['msg_not_match_password_last'], 0, NULL, 5); }else{
				if($newHash == $userData['password']){ jsonBuilder($lang['msg_not_same_new_password'], 3, NULL, 5); }else{
					if($newHash != $reNewHash){ jsonBuilder($lang['msg_not_match_password_new'], 3, NULL, 5); }else{
						$dbh->where("username", $userData['username']);
						if(!$dbh->update("user", ['password'=>$newHash])){ jsonBuilder($lang['msg_error'], 0, NULL, 5); }else{
							jsonBuilder($lang['msg_password_updated'], 1, $dot.$route['settings'], 5);
						}
					}
				}
			}
		}
	}
	/* Get Articles */
	if(isset($_POST['getArticles'])){
		header('Content-Type: application/json');
		$dbh->orderBy("id", "DESC"); $v = -1;
		foreach($dbh->get("article") as $articleRow){ $v++;
			$data[]["id"] = $v;
			$data[$v]["title"] = $articleRow['title'];
			$data[$v]["process"] = '<div class="btn-group"><a href="'.$config['url'].$route['blogs'].$articleRow['slug'].'" target="_blank" class="btn btn-primary btn-sm">'.$lang['t_view'].'</a><a href="'.$dot.$route['article'].$act.$route['edit'].$seo.$articleRow['slug'].'" class="btn btn-warning btn-sm">'.$lang['t_edit'].'</a><button class="btn btn-danger btn-sm btnDeleteArticle" onclick="deleteArticle(\''.$articleRow['slug'].'\', \''.$articleRow['title'].'\')">'.$lang['t_remove'].'</button></div>';
		}
		echo json_encode($data);
	}
	/* Create Article */
	if(isset($_POST['createArticle'])){
		$title = $hf->sclr($_POST['title']);
		$picture = $hf->sclr($_POST['picture']);
		$slug = $hf->slugs($title);
		$content = $_POST['content'];
		$description = $hf->sclr($_POST['description']);
		if(!$title || !$picture || !$content || !$description){ jsonBuilder($lang['msg_empty'], 0, NULL, 5); }else{
			if(!$hf->chkctStart($picture, $config['url'])){ jsonBuilder($lang['msg_image_address_start_with_own_website'], 2, NULL, 5); }else{
				if(!is_file(str_replace($config['url'], "", $picture))){ jsonBuilder($lang['msg_image_not_exists'], 3, NULL, 5); }else{
					$dbh->where("slug", $slug);
					if($dbh->has("article")){ jsonBuilder($lang['msg_article_exists'], 2, NULL, 5); }else{
						$articleData = [
							'picture' => $picture,
							'slug' => $slug,
							'title' => $title,
							'content' => $content,
							'description' => $description,
							'createDate' => $hf->ldtm(),
							'modifyDate' => $hf->ldtm()
						];
						if(!$dbh->insert("article", $articleData)){ jsonBuilder($lang['msg_error'], 0, NULL, 5); }else{
							jsonBuilder($lang['msg_article_created'], 1, $dot.$route['article'], 5);
						}
					}
				}				
			}
		}
	}
	/* Update Article */
	if(isset($_POST['updateArticle'])){
		$title = $hf->sclr($_POST['title']);
		$picture = $hf->sclr($_POST['picture']);
		$lastSlug = $hf->sclr($_POST['slug']);
		$slug = $hf->slugs($title);
		$content = $_POST['content'];
		$description = $hf->sclr($_POST['description']);
		if(!$title || !$picture || !$content || !$description){ jsonBuilder($lang['msg_empty'], 0, NULL, 5); }else{
			if(!$hf->chkctStart($picture, $config['url'])){ jsonBuilder($lang['msg_image_address_start_with_own_website'], 2, NULL, 5); }else{
				if(!is_file(str_replace($config['url'], "", $picture))){ jsonBuilder($lang['msg_image_not_exists'], 3, NULL, 5); }else{
					$dbh->where("slug", $lastSlug);
					if(!$dbh->has("article")){ jsonBuilder($lang['msg_article_not_exists'], 2, NULL, 5); }else{
						$articleData = [
							'picture' => $picture,
							'slug' => $slug,
							'title' => $title,
							'content' => $content,
							'description' => $description,
							'modifyDate' => $hf->ldtm()
						];
						$dbh->where("slug", $lastSlug);
						if(!$dbh->update("article", $articleData)){ jsonBuilder($lang['msg_error'], 0, NULL, 5); }else{
							jsonBuilder($lang['msg_article_updated'], 1, $dot.$route['article'], 5);
						}
					}
				}
			}
		}
	}
	/* Delete Article */
	if(isset($_POST['deleteArticle'])){
		$slug = $hf->sclr($_POST['slug']);
		$dbh->where("slug", $slug);
		if(!$dbh->has("article")){ jsonBuilder($lang['msg_article_not_exists'], 2, NULL, 5); }else{
			$dbh->where("slug", $slug);
			if(!$dbh->delete("article")){ jsonBuilder($lang['msg_error'], 0, NULL, 5); }else{
				jsonBuilder($lang['msg_article_deleted'], 1, $dot.$route['article'], 5);
			}
		}
	}
	/* Get Pages */
	if(isset($_POST['getPages'])){
		header('Content-Type: application/json');
		$dbh->orderBy("id", "DESC"); $v = -1;
		foreach($dbh->get("page") as $pageRow){ $v++;
			$data[]["id"] = $v;
			$data[$v]["title"] = $pageRow['title'];
			$data[$v]["process"] = '<div class="btn-group"><a href="'.$config['url'].$route['pages'].$pageRow['slug'].'" target="_blank" class="btn btn-primary btn-sm">'.$lang['t_view'].'</a><a href="'.$dot.$route['page'].$act.$route['edit'].$seo.$pageRow['slug'].'" class="btn btn-warning btn-sm">'.$lang['t_edit'].'</a><button class="btn btn-danger btn-sm btnDeletePage" onclick="deletePage(\''.$pageRow['slug'].'\', \''.$pageRow['title'].'\')">'.$lang['t_remove'].'</button></div>';
		}
		echo json_encode($data);
	}
	/* Create Page */
	if(isset($_POST['createPage'])){
		$title = $hf->sclr($_POST['title']);
		$slug = $hf->slugs($title);
		$locationNav = $hf->sclr($_POST['locationNav']);
		$locationFooter = $hf->sclr($_POST['locationFooter']);
		$content = $_POST['content'];
		$description = $hf->sclr($_POST['description']);
		if(!$title || !$locationNav || !$locationFooter || !$content || !$description){ jsonBuilder($lang['msg_empty'], 0, NULL, 5); }else{
			$dbh->where("slug", $slug);
			if($dbh->has("page")){ jsonBuilder($lang['msg_page_exists'], 2, NULL, 5); }else{
				$pageData = [
					'slug' => $slug,
					'title' => $title,
					'content' => $content,
					'description' => $description,
					'nav' => $locationNav,
					'footer' => $locationFooter,
					'createDate' => $hf->ldtm(),
					'modifyDate' => $hf->ldtm()
				];
				if(!$dbh->insert("page", $pageData)){ jsonBuilder($lang['msg_error'], 0, NULL, 5); }else{
					jsonBuilder($lang['msg_page_created'], 1, $dot.$route['page'], 5);
				}
			}
		}
	}
	/* Update Page */
	if(isset($_POST['updatePage'])){
		$title = $hf->sclr($_POST['title']);
		$lastSlug = $hf->sclr($_POST['slug']);
		$slug = $hf->slugs($title);
		$locationNav = $hf->sclr($_POST['locationNav']);
		$locationFooter = $hf->sclr($_POST['locationFooter']);
		$content = $_POST['content'];
		$description = $hf->sclr($_POST['description']);
		if(!$title || !$locationNav || !$locationFooter || !$content || !$description){ jsonBuilder($lang['msg_empty'], 0, NULL, 5); }else{
			$dbh->where("slug", $lastSlug);
			if(!$dbh->has("page")){ jsonBuilder($lang['msg_page_not_exists'], 2, NULL, 5); }else{
				$pageData = [
					'slug' => $slug,
					'title' => $title,
					'content' => $content,
					'description' => $description,
					'nav' => $locationNav,
					'footer' => $locationFooter,
					'modifyDate' => $hf->ldtm()
				];
				$dbh->where("slug", $lastSlug);
				if(!$dbh->update("page", $pageData)){ jsonBuilder($lang['msg_error'], 0, NULL, 5); }else{
					jsonBuilder($lang['msg_page_updated'], 1, $dot.$route['page'], 5);
				}
			}
		}
	}
	/* Delete Page */
	if(isset($_POST['deletePage'])){
		$slug = $hf->sclr($_POST['slug']);
		$dbh->where("slug", $slug);
		if(!$dbh->has("page")){ jsonBuilder($lang['msg_page_not_exists'], 2, NULL, 5); }else{
			$dbh->where("slug", $slug);
			if(!$dbh->delete("page")){ jsonBuilder($lang['msg_error'], 0, NULL, 5); }else{
				jsonBuilder($lang['msg_page_deleted'], 1, $dot.$route['page'], 5);
			}
		}
	}
	/* Get Files */
	if(isset($_POST['getFiles'])){
		header('Content-Type: application/json');
		$dbh->orderBy("id", "DESC"); $v = -1; $data = array();
		foreach($dbh->get("file") as $fileRow){ $v++;
			$data[]["id"] = $v;
			$data[$v]["name"] = $fileRow['name'].'<button onclick="viewImage(\''.$fileRow['link'].'\')" class="btn btn-info btn-sm m-l-10">'.$lang['t_view'].'</button>';
			$data[$v]["link"] = '<button class="btn btn-success btn-sm btnCopyLink" onclick="copyToClipboard(\''.$fileRow['link'].'\')">'.$lang['t_copy'].'</button>';
			$data[$v]["folder"] = $fileRow['folder'];
			$data[$v]["uploadDate"] = $fileRow['createDate'];
			$data[$v]["process"] = '<button class="btn btn-danger btn-sm btnDeleteFile" onclick="deleteFile(\''.$fileRow['hash'].'\', \''.$fileRow['name'].'\')">'.$lang['t_remove'].'</button>';
		}
		echo json_encode($data);
	}
	
	/* Upload File */
	if(isset($_POST['uploadFile'])){
		if(!$_FILES['file']){ jsonBuilder($lang['msg_empty'], 0, NULL, 5); }else{
			$fileName = @$_FILES['file']['name'];
			$fileSize = @$_FILES['file']['size'];
			$fileTmpName = @$_FILES['file']['tmp_name'];
			$fileType = @$_FILES['file']['type'];
			$fileExtensions = ['jpeg','jpg','png', 'webp', 'html'];
			$fileExtension = @strtolower(end(explode('.',$fileName)));
			$fileNameHash = hash("sha1", basename($fileName)."-".bin2hex(openssl_random_pseudo_bytes(32)));
			$fileNameEncoded = $fileNameHash.".".$fileExtension;
			$fileDateName = date("Y-m-d");
			$fileFolderDate = $config["fileDirs"].$fileDateName."/";
			if(!is_dir($fileFolderDate)){ @mkdir($fileFolderDate); }
			$uploadPath = $fileFolderDate.$fileNameEncoded;
			$fileLink = $config['url'].$uploadPath;
			if (!in_array($fileExtension,$fileExtensions)){ jsonBuilder($lang['msg_file_extension_only'], 2, NULL, 5); }else{
				if ($fileSize > 5000000){ jsonBuilder($lang['msg_file_extension_only'], 2, NULL, 5); }else{
					$fileData = [
						'hash' => $fileNameHash,
						'name' => $fileNameEncoded,
						'folder' => $fileDateName,
						'location' => $uploadPath,
						'link' => $fileLink,
						'createDate' => $hf->ldtm()
					];
					if(!$dbh->insert("file", $fileData)){ jsonBuilder($lang['msg_error'], 0, NULL, 5); }else{
						move_uploaded_file($fileTmpName, $uploadPath);
						jsonBuilder($lang['msg_file_uploaded'], 1, $dot.$route['file'], 5);
					}
				}
			}
		}
	}
	/* Delete File */
	if(isset($_POST['deleteFile'])){
		$hash = $hf->sclr($_POST['hash']);
		$dbh->where("hash", $hash);
		if(!$dbh->has("file")){ jsonBuilder($lang['msg_file_not_exists'], 2, NULL, 5); }else{
			$dbh->where("hash", $hash);
			$fileRow = $dbh->getOne("file");
			$dbh->where("hash", $hash);
			if(!$dbh->delete("file")){ jsonBuilder($lang['msg_error'], 0, NULL, 5); }else{
				@unlink($fileRow['location']);
				jsonBuilder($lang['msg_file_deleted'], 1, $dot.$route['file'], 3);
			}
		}
	}
}else{
	/* Login */
	if(isset($_POST['login'])){
		$username = $hf->sclr($_POST['username']);
		$password = $hf->sclr($_POST['password']);
		$passHash = $hf->hval($password);
		if(!$username || !$password){ jsonBuilder($lang['msg_empty'], 0, NULL, 5); }else{
			$dbh->where("username", $username);
			if(!$dbh->has("user")){ jsonBuilder($lang['msg_not_match_record'], 0, NULL, 5); }else{
				$dbh->where("username", $username);
				$userRow = $dbh->getOne("user");
				if($username != $userRow['username'] || $passHash != $userRow['password']){ 
					jsonBuilder($lang['msg_wrong_username_password'], 2, NULL, 5);
				}else if($passHash != $userRow['password']){ jsonBuilder($lang['msg_not_match_record'], 0, NULL, 5); }else{
					$_SESSION['session'] = true;
					$_SESSION['username'] = $username;
					jsonBuilder($lang['msg_login_successfull'], 1, makeUrl("admin?do=dashboard"), 5);
				}
			}
		}
	}
}
?>
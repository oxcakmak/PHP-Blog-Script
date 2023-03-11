<?php include('component.php'); 
if(isset($_SESSION['session'])){
	$pageContent .= '';
	/*
	$pageContent .= '<title>'.$lang['t_signin'].'</title>';
	*/
	switch($do){
		/*
		case "":
		$pageContent .= '<title>'.$lang['t_home'].'</title>
		
		';
		break;
		*/
		default:
		$pageContent .= '<title>'.$lang['t_home'].'</title>
		<div class="row">
			<div class="col-lg-3">
				<div class="card">
					<div class="card-body">
						<div class="d-flex flex-row">
							<div class="col-3 align-self-center"><div class="round"><i class="mdi mdi-file"></i></div></div>
							<div class="col-9 text-right align-self-center">
								<div class="m-l-10 ">
									<h5 class="mt-0">'.$dbh->getValue("file", "COUNT(*)").'</h5>
									<p class="mb-0 text-muted">'.$lang['t_file'].'</p>
								</div>
							</div>                                                                                                                
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="card">
					<div class="card-body">
						<div class="d-flex flex-row">
							<div class="col-3 align-self-center"><div class="round"><i class="mdi mdi-newspaper"></i></div></div>
							<div class="col-9 text-right align-self-center">
								<div class="m-l-10 ">
									<h5 class="mt-0">'.$dbh->getValue("article", "COUNT(*)").'</h5>
									<p class="mb-0 text-muted">'.$lang['t_article'].'</p>
								</div>
							</div>                                                                                                                
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="card">
					<div class="card-body">
						<div class="d-flex flex-row">
							<div class="col-3 align-self-center"><div class="round"><i class="mdi mdi-file-document"></i></div></div>
							<div class="col-9 text-right align-self-center">
								<div class="m-l-10 ">
									<h5 class="mt-0">'.$dbh->getValue("page", "COUNT(*)").'</h5>
									<p class="mb-0 text-muted">'.$lang['t_page'].'</p>
								</div>
							</div>                                                                                                                
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="card">
					<div class="card-body">
						<div class="d-flex flex-row">
							<div class="col-3 align-self-center"><div class="round"><i class="mdi mdi-account"></i></div></div>
							<div class="col-9 text-right align-self-center">
								<div class="m-l-10 ">
									<h5 class="mt-0">'.$dbh->getValue("user", "COUNT(*)").'</h5>
									<p class="mb-0 text-muted">'.$lang['t_user'].'</p>
								</div>
							</div>                                                                                                                
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title font-20 mt-0"><strong>'.$lang['t_files'].'</strong></h4>
						<table class="table table-bordered table-sm">
							<thead><tr><th>'.$lang['t_file_name'].'</th><th>'.$lang['t_folder'].'</th></tr></thead>
							<tbody>';
								$dbh->orderBy("id", "DESC");
								foreach($dbh->get("file", 5) as $row){ $pageContent .= '<tr><td>'.$row['name'].'</td><td>'.$row['folder'].'</td></tr>'; }
							 $pageContent .= '</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title font-20 mt-0"><strong>'.$lang['t_latest_posts'].'</strong></h4>
						<table class="table table-bordered table-sm">
							<thead><tr><th>'.$lang['t_title'].'</th><th>'.$lang['t_latest_modify'].'</th></tr></thead>
							<tbody>';
								$dbh->orderBy("id", "DESC");
								foreach($dbh->get("article", 5) as $row){ $pageContent .= '<tr><td><a class="text-bold" href="'.$config['url'].$route['blogs'].$row['slug'].'" target="_blank">'.$row['title'].'</a></td><td>'.$row['modifyDate'].'</td></tr>'; }
							 $pageContent .= '</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>';
		break;
		case "file":
		$pageHeader .= '<link href="'.$config['panelAssets'].'vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
		<link href="'.$config['panelAssets'].'vendor/datatables/responsive.bootstrap4.min.css" rel="stylesheet" />';
		$pageContent .= '<title>'.$lang['t_files'].'</title>
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title font-20 mt-0"><strong>'.$lang['t_files'].'</strong>&nbsp;<a href="javascript:void(0);" class="badge badge-default btn-wave" data-toggle="modal" data-target="#fileUploadModal">'.$lang['t_file_upload_new'].'</a></h4>
						<div class="modal fade" id="fileUploadModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
							<div class="modal-dialog zoomIn animated" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">'.$lang['t_file_upload_new'].'</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="mdi mdi-close"></i></span></button>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col-md-12">
												<div class="custom-file">
													<input type="file" class="custom-file-input fileUploadInput" id="inputGroupFile04" accept="image/png, image/jpeg, image/webp">
													<label class="custom-file-label" for="inputGroupFile04">'.$lang['t_choose_file'].'</label>
												</div>
											</div>
										</div>
									</div>                                          
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">'.$lang['t_cancel'].'</button>
										<button type="button" class="btn btn-success btnUploadFile">'.$lang['t_file_upload_new'].'</button>
									</div>
								</div>
							</div>
						</div>
						<div class="row"><div class="col-12 table-responsive"><table id="dataTable" class="table table-bordered">
							<thead>
								<tr>
									<th>#</th>
									<th>'.$lang['t_file_name'].'</th>
									<th>'.$lang['t_folder'].'</th>
									<th>'.$lang['t_file_link'].'</th>
									<th>'.$lang['t_upload_date'].'</th>
									<th>'.$lang['t_process'].'</th>
								</tr>
							</thead>
						</table></div></div>
					</div>
				</div>
			</div>
		</div>';
		$scriptContent .= '<script src="'.$config['panelAssets'].'vendor/datatables/jquery.dataTables.min.js"></script>
		<script src="'.$config['panelAssets'].'vendor/datatables/dataTables.bootstrap4.min.js"></script>
		<script src="'.$config['panelAssets'].'vendor/datatables/dataTables.responsive.min.js"></script>
		<script src="'.$config['panelAssets'].'vendor/datatables/responsive.bootstrap4.min.js"></script>
		<script src="'.$config['panelAssets'].'vendor/clipboardjs/clipboard.min.js"></script>
		<script>$.fn.dataTable.ext.errMode = "none"; var clipBoard = new ClipboardJS("btnCopyLink");
		$("#dataTable").DataTable({
			language: {
				info: "'.$lang['t_datable_info'].'",
				infoEmpty: "'.$lang['t_datable_info_empty'].'",
				loadingRecords: "'.$lang['t_datable_loading_records'].'",
				lengthMenu: "'.$lang['t_datable_length_menu'].'",
				zeroRecords: "'.$lang['t_datable_zero_records'].'",
				search: "'.$lang['t_datable_search'].'",
				infoFiltered: "'.$lang['t_datable_info_filtered'].'",
				paginate: {
					first: "'.$lang['t_datable_paginate_first'].'",
					previous: "'.$lang['t_datable_paginate_previous'].'",
					next: "'.$lang['t_datable_paginate_next'].'",
					last: "'.$lang['t_datable_paginate_last'].'"
				},
			},
			"ajax": {
				url: "'.$config['ajax'].'",
				type: "POST",
				data: {getFiles:"getFiles"},
				dataSrc: ""
			},
			autoWidth: true,
			columns: [
				{"data": "id"},
				{"data": "name"},
				{"data": "folder"},
				{"data": "link"},
				{"data": "uploadDate"},
				{"data": "process"}
			],
			responsive: true,
			"lengthMenu": [[10, 50, 100, 500, 1000, -1], [10, 50, 100, 500, 1000, "'.$lang['t_view_all'].'"]]
		});
		$("#inputGroupFile04").change(function(e){ if(e.target.files[0].name){ $(".custom-file-label").text($("#inputGroupFile04")[0].files[0].name); } });
		$("input:file").keyup(function(e) {
			if (27 == e.keyCode) {
				$(this).blur();
				$(".custom-file-label").text("'.$lang['t_choose_file'].'");
				return false;
			}
		});
		function deleteFile(hash, title){
			swal({
				title: \''.$lang['t_question_delete_file'].'\'.replace("_FILE_NAME_", title),
				type: "warning",
				showCancelButton: true,
				confirmButtonText: "'.$lang['t_yes_sure'].'",
				confirmButtonColor: "#29b348",
				cancelButtonText: "'.$lang['t_no_not_sure'].'",
				cancelButtonColor: "#ec536c",
				reverseButtons: true
			}).then(function(){
					$.ajax({
						type: "POST",
						url: "'.$config['ajax'].'",
						data: {hash: hash, deleteFile: "deleteFile"},
						dataType: "json",
						success: function(response){
							$(".btnDeletePage").attr("disabled", false);
							alert(response.msgText, response.msgType);
							if(response.msgRedirectLocation!=""){ setInterval(function(){ location.href = response.msgRedirectLocation; }, response.redirectInterval); }
						}
					});
			}, function(dismiss){ if(dismiss=="cancel"){ alert("'.$lang['msg_cancel_deletion'].'", "info"); } });
		}
		$(".btnUploadFile").click(function(e){
			$(".btnUploadFile").attr("disabled", true);
			e.preventDefault();
			var formData = new FormData();
			formData.append("file", $(".fileUploadInput").prop("files")[0]);
			formData.append("uploadFile", "uploadFile");
			$.ajax({
				type: "POST",
				url: "'.$config['ajax'].'",
				cache: false,
				contentType: false,
				processData: false,
				data: formData,
				dataType: "json",
				success: function(response){
					alert(response.msgText, response.msgType);
					if(response.msgType=="error"){ $(".btnUploadFile").attr("disabled", false); }
					if(response.msgRedirectLocation!=""){ setInterval(function(){ location.href = response.msgRedirectLocation; }, response.redirectInterval); }
				}
			});
		});
		function copyToClipboard(text){
			ClipboardJS.copy(text);
			alert("'.$lang['msg_file_link_copied'].'");
		}
		function getFileExt(event){
			return event.substring(event.lastIndexOf(".") + 1);
		}
		function viewImage(source){
			let bodyHtmlContent = "";
			if(getFileExt(source)=="html"){
				bodyHtmlContent = \'<iframe allowfullscreen="" frameborder="0" width="100%" src="\'+source+\'" title="'.$lang['t_file'].'"></iframe>\';
			}else if(getFileExt(source)=="png" || getFileExt(source)=="jpg" || getFileExt(source)=="jpeg"){
				bodyHtmlContent = \'<img alt="'.$lang['t_file'].'" class="img-fluid img-responsive" src="\'+source+\'">\';
			}
			document.getElementsByClassName("fileModalBody")[0].innerHTML = bodyHtmlContent;
			$("#fileModal").modal("show");
			console.log(getFileExt(source));
		}
		</script>
		<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle-1">'.$lang['t_view'].'</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="mdi mdi-close"></i></span></button>
					</div>
					<div class="modal-body text-center fileModalBody"></div>
					<div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal">'.$lang['t_close'].'</button></div>
				</div>
			</div>
		</div>';
		break;
		case "article":
		if($action=="add"){
			$pageHeader .= '<link href="'.$config['panelAssets'].'vendor/summernote/summernote.min.css" rel="stylesheet" />';
			$pageContent .= '<title>'.$lang['t_article_add_new'].'</title>
			<div class="card">
				<div class="card-body p-b-0">
					<h4 class="card-title font-20 mt-0"><strong>'.$lang['t_article_add_new'].'</strong></h4>
					<div class="row">
						<div class="col-md-6 m-b-10">
							<label for="exampleInputEmail1">'.$lang['t_title'].'</label><br>
							<input type="text" class="form-control title" placeholder="'.$lang['t_title'].'">
						</div>
						<div class="col-md-6 m-b-10">
							<label for="exampleInputEmail1">'.$lang['t_picture'].'</label><br>
							<input type="text" class="form-control picture" placeholder="'.$lang['t_picture'].'">
						</div>
						<div class="col-md-12 m-b-10">
							<label for="exampleInputEmail1">'.$lang['t_content'].'</label><br>
							<textarea rows="5" type="text" class="form-control content" id="content" placeholder="'.$lang['t_content'].'" style="resize:none;"></textarea>
						</div>
						<div class="col-md-12 m-b-15">
							<label for="exampleInputEmail1">'.$lang['t_description'].'</label><br>
							<input type="text" class="form-control description" placeholder="'.$lang['t_description'].'">
						</div>
						<div class="col-md-12"><div class="btn-group btn-block"><a href="'.$dot.$route['article'].'" class="btn btn-danger">'.$lang['t_cancel'].'</a><button class="btn btn-success btnCreateArticle">'.$lang['t_article_add_new'].'</button></div></div>
					</div>
				</div>
			</div>';
			$scriptContent .= '<script src="'.$config['panelAssets'].'vendor/cke1/ckeditor.js"></script>
			<script>CKEDITOR.replace("content");
			CKEDITOR.editorConfig = function(config){ config.extraPlugins = "codesnippet, youtube, embed"; };
			$(".btnCreateArticle").click(function(e){
				e.preventDefault();
				$(".btnCreateArticle").attr("disabled", true);
				$.ajax({
					type: "POST",
					url: "'.$config['ajax'].'",
					data: {title: $(".title").val(), picture: $(".picture").val(), content: CKEDITOR.instances.content.getData(), description: $(".description").val(), createArticle: "createArticle"},
					dataType: "json",
					success: function(response){ 
						$(".btnCreateArticle").attr("disabled", false);
						if(response.msgType=="success"){
							$(".title").val("");
							$(".picture").val("");
							CKEDITOR.instances.content.setData("");
							$(".description").val("");
						}
						alert(response.msgText, response.msgType);
						if(response.msgRedirectLocation!=""){ setInterval(function(){ location.href = response.msgRedirectLocation; }, response.redirectInterval); } }
				});
			});
			</script>';
		}else if($action=="edit"){
			$seo = @$hf->sclr($_GET['seo']);
			if(!$seo){ header('location:'.$dot.$route['article']); }
			$dbh->where("slug", $seo);
			if(!$dbh->has("article")){ header('location:'.$dot.$route['article']); }
			$dbh->where("slug", $seo);
			$articleRow = $dbh->getOne("article");
			$pageHeader .= '<link href="'.$config['panelAssets'].'vendor/summernote/summernote.min.css" rel="stylesheet">';
			$pageContent .= '<title>'.$lang['t_article_edit'].'</title>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body p-b-0">
							<h4 class="card-title font-20 mt-0"><strong>'.$lang['t_article_edit'].'</strong></h4>
							<div class="form-group row mb-0">
								<div class="col-md-6">
									<label for="exampleInputEmail1">'.$lang['t_title'].'</label><br>
									<input type="text" class="form-control title" placeholder="'.$lang['t_title'].'" value="'.$articleRow['title'].'">
								</div>
								<div class="col-md-6 m-b-5">
									<label for="exampleInputEmail1">'.$lang['t_picture'].'</label><br>
									<input type="text" class="form-control picture" placeholder="'.$lang['t_picture'].'" value="'.$articleRow['picture'].'">
								</div>
								<div class="col-md-12 m-b-5">
									<label for="exampleInputEmail1">'.$lang['t_content'].'</label><br>
									<textarea rows="5" type="text" class="form-control content" id="content" placeholder="'.$lang['t_content'].'" style="resize:none;">'.htmlspecialchars($articleRow['content']).'</textarea>
								</div>
								<div class="col-md-12 m-b-15">
									<label for="exampleInputEmail1">'.$lang['t_description'].'</label><br>
									<input type="text" class="form-control description" placeholder="'.$lang['t_description'].'" value="'.$articleRow['description'].'">
								</div>
								<div class="col-md-12"><div class="btn-group btn-block"><a href="'.$dot.$route['article'].'" class="btn btn-danger">'.$lang['t_cancel'].'</a><button class="btn btn-success btnUpdateArticle">'.$lang['t_article_edit'].'</button></div></div>
							</div>
						</div>
					</div>
				</div>
			</div>';
			$scriptContent .= '<script src="'.$config['panelAssets'].'vendor/cke1/ckeditor.js"></script>
			<script>CKEDITOR.replace("content");
			CKEDITOR.editorConfig = function(config){ config.extraPlugins = "codesnippet, youtube, embed"; };
			$(".btnUpdateArticle").click(function(e){
				e.preventDefault();
				$(".btnUpdateArticle").attr("disabled", true);
				$.ajax({
					type: "POST",
					url: "'.$config['ajax'].'",
					data: {slug: "'.$seo.'", title: $(".title").val(), picture: $(".picture").val(), content: CKEDITOR.instances.content.getData(), description: $(".description").val(), updateArticle: "updateArticle"},
					dataType: "json",
					success: function(response){ 
						$(".btnUpdateArticle").attr("disabled", false);
						if(response.msgType=="success"){
							$(".title").val("");
							$(".picture").val("");
							CKEDITOR.instances.content.setData("");
							$(".description").val("");
						}
						alert(response.msgText, response.msgType);
						if(response.msgRedirectLocation!=""){ setInterval(function(){ location.href = response.msgRedirectLocation; }, response.redirectInterval); } }
				});
			});
			</script>';
		}else{
			$pageHeader .= '<link href="'.$config['panelAssets'].'vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
			<link href="'.$config['panelAssets'].'vendor/datatables/responsive.bootstrap4.min.css" rel="stylesheet" />';
			$pageContent .= '<title>'.$lang['t_articles'].'</title>
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title font-20 mt-0"><strong>'.$lang['t_articles'].'</strong>&nbsp;<a class="badge badge-default btn-wave" href="'.$dot.$route['article'].$act.$route['add'].'" target="_self">'.$lang['t_article_add_new'].'</a></h4>
							<div class="row"><div class="col-12 table-responsive"><table id="dataTable" class="table table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>'.$lang['t_title'].'</th>
										<th>'.$lang['t_process'].'</th>
									</tr>
								</thead>
							</table></div></div>
						</div>
					</div>
				</div>
			</div>';
			$scriptContent .= '<script src="'.$config['panelAssets'].'vendor/datatables/jquery.dataTables.min.js"></script>
			<script src="'.$config['panelAssets'].'vendor/datatables/dataTables.bootstrap4.min.js"></script>
			<script src="'.$config['panelAssets'].'vendor/datatables/dataTables.responsive.min.js"></script>
			<script src="'.$config['panelAssets'].'vendor/datatables/responsive.bootstrap4.min.js"></script>
			<script>$.fn.dataTable.ext.errMode = "none";
			$("#dataTable").DataTable({
				language: {
					info: "'.$lang['t_datable_info'].'",
					infoEmpty: "'.$lang['t_datable_info_empty'].'",
					loadingRecords: "'.$lang['t_datable_loading_records'].'",
					lengthMenu: "'.$lang['t_datable_length_menu'].'",
					zeroRecords: "'.$lang['t_datable_zero_records'].'",
					search: "'.$lang['t_datable_search'].'",
					infoFiltered: "'.$lang['t_datable_info_filtered'].'",
					paginate: {
						first: "'.$lang['t_datable_paginate_first'].'",
						previous: "'.$lang['t_datable_paginate_previous'].'",
						next: "'.$lang['t_datable_paginate_next'].'",
						last: "'.$lang['t_datable_paginate_last'].'"
					},
				},
				"ajax": {
					url: "'.$config['ajax'].'",
					type: "POST",
					data: {getArticles:"getArticles"},
					dataSrc: ""
				},
				autoWidth: true,
				columns: [
					{"data": "id"},
					{"data": "title"},
					{"data": "process"}
				],
				responsive: true,
				"lengthMenu": [[10, 50, 100, 500, 1000, -1], [10, 50, 100, 500, 1000, "'.$lang['t_view_all'].'"]]
			});
			function deleteArticle(slug, title){
				swal({
					title: \''.$lang['t_question_delete_article'].'\'.replace("_ARTICLE_", title),
					type: "warning",
					showCancelButton: true,
					confirmButtonText: "'.$lang['t_yes_sure'].'",
					confirmButtonColor: "#29b348",
					cancelButtonText: "'.$lang['t_no_not_sure'].'",
					cancelButtonColor: "#ec536c",
					reverseButtons: true
				}).then(function(){
						$.ajax({
							type: "POST",
							url: "'.$config['ajax'].'",
							data: {slug: slug, deleteArticle: "deleteArticle"},
							dataType: "json",
							success: function(response){
								$(".btnDeletePage").attr("disabled", false);
								alert(response.msgText, response.msgType);
								if(response.msgRedirectLocation!=""){ setInterval(function(){ location.href = response.msgRedirectLocation; }, response.redirectInterval); }
							}
						});
				}, function(dismiss){ if(dismiss=="cancel"){ alert("'.$lang['msg_cancel_deletion'].'", "info"); } });
			}
			</script>
			';
		}
		break;
		case "page":
		if($action=="add"){
			$pageHeader .= '<link href="'.$config['panelAssets'].'vendor/summernote/summernote.min.css" rel="stylesheet" />';
			$pageContent .= '<title>'.$lang['t_page_add_new'].'</title>
			<div class="card">
				<div class="card-body">
					<h4 class="card-title font-20 mt-0"><strong>'.$lang['t_page_add_new'].'</strong></h4>
					<div class="row">
						<div class="col-md-6 m-b-10">
							<label for="exampleInputEmail1">'.$lang['t_title'].'</label><br>
							<input type="text" class="form-control title" placeholder="'.$lang['t_title'].'">
						</div>
						<div class="col-md-3 m-b-10">
							<label for="exampleInputEmail1">'.$lang['t_menu_location'].'</label><br>
							<select class="form-control locationNav">
								<option value="" selected>'.$lang['t_menu_location'].'</option>
								<option value="main">'.$lang['t_menu_main'].'</option>
								<option value="sub">'.$lang['t_menu_sub'].'</option>
							</select>
						</div>
						<div class="col-md-3 m-b-10">
							<label for="exampleInputEmail1">'.$lang['t_footer'].'</label><br>
							<select class="form-control locationFooter">
								<option value="" selected>'.$lang['t_footer'].'</option>
								<option value="yes">'.$lang['t_yes'].'</option>
								<option value="no">'.$lang['t_no'].'</option>
							</select>
						</div>
						<div class="col-md-12 m-b-10">
							<label for="exampleInputEmail1">'.$lang['t_content'].'</label><br>
							<textarea rows="5" type="text" class="form-control content" id="content" placeholder="'.$lang['t_content'].'" style="resize:none;"></textarea>
						</div>
						<div class="col-md-12 m-b-15">
							<label for="exampleInputEmail1">'.$lang['t_description'].'</label><br>
							<input type="text" class="form-control description" placeholder="'.$lang['t_description'].'">
						</div>
						<div class="col-md-12"><div class="btn-group btn-block"><a href="'.$dot.$route['page'].'" class="btn btn-danger">'.$lang['t_cancel'].'</a><button class="btn btn-success btnCreatePage">'.$lang['t_page_add_new'].'</button></div></div>
					</div>
				</div>
			</div>';
			$scriptContent .= '<script src="'.$config['panelAssets'].'vendor/cke1/ckeditor.js"></script>
			<script>CKEDITOR.replace("content");
			CKEDITOR.editorConfig = function(config){ config.extraPlugins = "codesnippet"; };
			$(".btnCreatePage").click(function(e){
				e.preventDefault();
				$(".btnCreatePage").attr("disabled", true);
				$.ajax({
					type: "POST",
					url: "'.$config['ajax'].'",
					data: {title: $(".title").val(), locationNav: $(".locationNav").val(), locationFooter: $(".locationFooter").val(), content: CKEDITOR.instances.content.getData(), description: $(".description").val(), createPage: "createPage"},
					dataType: "json",
					success: function(response){ 
						$(".btnCreatePage").attr("disabled", false);
						if(response.msgType=="success"){
							$(".title").val("");
							$(".locationNav").val("");
							$(".locationFooter").val("");
							CKEDITOR.instances.content.setData("");
							$(".description").val("");
						}
						alert(response.msgText, response.msgType);
						if(response.msgRedirectLocation!=""){ setInterval(function(){ location.href = response.msgRedirectLocation; }, response.redirectInterval); } }
				});
			});
			</script>';
		}else if($action=="edit"){
			$seo = @$hf->sclr($_GET['seo']);
			if(!$seo){ header('location:'.$dot.$route['page']); }
			$dbh->where("slug", $seo);
			if(!$dbh->has("page")){ header('location:'.$dot.$route['page']); }
			$dbh->where("slug", $seo);
			$pageRow = $dbh->getOne("page");
			$pageHeader .= '<link href="'.$config['panelAssets'].'vendor/summernote/summernote.min.css" rel="stylesheet">';
			$pageContent .= '<title>'.$lang['t_page_edit'].'</title>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body pb-0">
							<h4 class="card-title font-20 mt-0"><strong>'.$lang['t_page_edit'].'</strong></h4>
							<div class="form-group row pb-0">
								<div class="col-md-6 m-b-5">
									<label for="exampleInputEmail1">'.$lang['t_title'].'</label><br>
									<input type="text" class="form-control title" placeholder="'.$lang['t_title'].'" value="'.$pageRow['title'].'">
								</div>
								<div class="col-md-3 m-b-5">
									<label for="exampleInputEmail1">'.$lang['t_menu_location'].'</label><br>
									<select class="form-control locationNav">
										<option value="" selected>'.$lang['t_menu_location'].'</option>
										<option value="main"'.(($pageRow['nav']=="main")?' selected':'').'>'.$lang['t_menu_main'].'</option>
										<option value="sub"'.(($pageRow['nav']=="sub")?' selected':'').'>'.$lang['t_menu_sub'].'</option>
									</select>
								</div>
								<div class="col-md-3 m-b-5">
									<label for="exampleInputEmail1">'.$lang['t_footer'].'</label><br>
									<select class="form-control locationFooter">
										<option value="" selected>'.$lang['t_footer'].'</option>
										<option value="yes"'.(($pageRow['footer']=="yes")?' selected':'').'>'.$lang['t_yes'].'</option>
										<option value="no"'.(($pageRow['footer']=="no")?' selected':'').'>'.$lang['t_no'].'</option>
									</select>
								</div>
								<div class="col-md-12 m-b-5">
									<label for="exampleInputEmail1">'.$lang['t_content'].'</label><br>
									<textarea rows="5" type="text" class="form-control content" id="content" placeholder="'.$lang['t_content'].'" style="resize:none;">'.$pageRow['content'].'</textarea>
								</div>
								<div class="col-md-12 m-b-15">
									<label for="exampleInputEmail1">'.$lang['t_description'].'</label><br>
									<input type="text" class="form-control description" placeholder="'.$lang['t_description'].'" value="'.$pageRow['description'].'">
								</div>
								<div class="col-md-12"><div class="btn-group btn-block"><a href="'.$dot.$route['page'].'" class="btn btn-danger">'.$lang['t_cancel'].'</a><button class="btn btn-success btnUpdatePage">'.$lang['t_page_edit'].'</button></div></div>
							</div>
						</div>
					</div>
				</div>
			</div>';
			$scriptContent .= '<script src="'.$config['panelAssets'].'vendor/cke1/ckeditor.js"></script>
			<script>CKEDITOR.replace("content");
			CKEDITOR.editorConfig = function(config){ config.extraPlugins = "codesnippet"; };
			$(".btnUpdatePage").click(function(e){
				e.preventDefault();
				$(".btnUpdatePage").attr("disabled", true);
				$.ajax({
					type: "POST",
					url: "'.$config['ajax'].'",
					data: {slug: "'.$seo.'", title: $(".title").val(), locationNav: $(".locationNav").val(), locationFooter: $(".locationFooter").val(), content: CKEDITOR.instances.content.getData(), description: $(".description").val(), updatePage: "updatePage"},
					dataType: "json",
					success: function(response){ 
						$(".btnUpdatePage").attr("disabled", false);
						if(response.msgType=="success"){
							$(".title").val("");
							$(".locationNav").val("");
							$(".locationFooter").val("");
							CKEDITOR.instances.content.setData("");
							$(".description").val("");
						}
						alert(response.msgText, response.msgType);
						if(response.msgRedirectLocation!=""){ setInterval(function(){ location.href = response.msgRedirectLocation; }, response.redirectInterval); } }
				});
			});
			</script>';
		}else{
			$pageHeader .= '<link href="'.$config['panelAssets'].'vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
			<link href="'.$config['panelAssets'].'vendor/datatables/responsive.bootstrap4.min.css" rel="stylesheet" />';
			$pageContent .= '<title>'.$lang['t_pages'].'</title>
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title font-20 mt-0"><strong>'.$lang['t_pages'].'</strong>&nbsp;<a class="badge badge-default btn-wave" href="'.$dot.$route['page'].$act.$route['add'].'" target="_self">'.$lang['t_page_add_new'].'</a></h4>
							<div class="row"><div class="col-12 table-responsive"><table id="dataTable" class="table table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>'.$lang['t_title'].'</th>
										<th>'.$lang['t_process'].'</th>
									</tr>
								</thead>
							</table></div></div>
						</div>
					</div>
				</div>
			</div>';
			$scriptContent .= '<script src="'.$config['panelAssets'].'vendor/datatables/jquery.dataTables.min.js"></script>
			<script src="'.$config['panelAssets'].'vendor/datatables/dataTables.bootstrap4.min.js"></script>
			<script src="'.$config['panelAssets'].'vendor/datatables/dataTables.responsive.min.js"></script>
			<script src="'.$config['panelAssets'].'vendor/datatables/responsive.bootstrap4.min.js"></script>
			<script>$.fn.dataTable.ext.errMode = "none";
			$("#dataTable").DataTable({
				language: {
					info: "'.$lang['t_datable_info'].'",
					infoEmpty: "'.$lang['t_datable_info_empty'].'",
					loadingRecords: "'.$lang['t_datable_loading_records'].'",
					lengthMenu: "'.$lang['t_datable_length_menu'].'",
					zeroRecords: "'.$lang['t_datable_zero_records'].'",
					search: "'.$lang['t_datable_search'].'",
					infoFiltered: "'.$lang['t_datable_info_filtered'].'",
					paginate: {
						first: "'.$lang['t_datable_paginate_first'].'",
						previous: "'.$lang['t_datable_paginate_previous'].'",
						next: "'.$lang['t_datable_paginate_next'].'",
						last: "'.$lang['t_datable_paginate_last'].'"
					},
				},
				"ajax": {
					url: "'.$config['ajax'].'",
					type: "POST",
					data: {getPages:"getPages"},
					dataSrc: ""
				},
				autoWidth: true,
				columns: [
					{"data": "id"},
					{"data": "title"},
					{"data": "process"}
				],
				responsive: true,
				"lengthMenu": [[10, 50, 100, 500, 1000, -1], [10, 50, 100, 500, 1000, "'.$lang['t_view_all'].'"]]
			});
			function deletePage(slug, title){
				swal({
					title: \''.$lang['t_question_delete_page'].'\'.replace("_PAGE_", title),
					type: "warning",
					showCancelButton: true,
					confirmButtonText: "'.$lang['t_yes_sure'].'",
					confirmButtonColor: "#29b348",
					cancelButtonText: "'.$lang['t_no_not_sure'].'",
					cancelButtonColor: "#ec536c",
					reverseButtons: true
				}).then(function(){
						$.ajax({
							type: "POST",
							url: "'.$config['ajax'].'",
							data: {slug: slug, deletePage: "deletePage"},
							dataType: "json",
							success: function(response){
								$(".btnDeletePage").attr("disabled", false);
								alert(response.msgText, response.msgType);
								if(response.msgRedirectLocation!=""){ setInterval(function(){ location.href = response.msgRedirectLocation; }, response.redirectInterval); }
							}
						});
				}, function(dismiss){ if(dismiss=="cancel"){ alert("'.$lang['msg_cancel_deletion'].'", "info"); } });
			}
			</script>
			';
		}
		break;
		case "settings":
		$pageContent .= '<title>'.$lang['t_settings'].'</title>
		<div class="row">
			<div class="col-md-6">
				<!-- SECTION_META_WEBSITE -->
				<div class="card">
					<div class="card-body">
						<h4 class="card-title font-20 mt-0"><strong>'.$lang['t_settings_meta'].'</strong></h4>
						<div class="row">
							<div class="col-md-12 m-b-10">
								<label for="exampleInputEmail1">'.$lang['t_title'].'</label><br>
								<input type="text" class="form-control metaTitle" placeholder="'.$lang['t_title'].'" value="'.$configData['title'].'">
							</div>
							<div class="col-md-12 m-b-10">
								<label for="exampleInputPassword1">'.$lang['t_description'].'</label><br>
								<textarea rows="3" type="text" class="form-control metaDescription" placeholder="'.$lang['t_description'].'" style="resize:none;">'.$configData['description'].'</textarea>
							</div>
							<div class="col-md-12 m-b-15">
								<label for="exampleInputPassword1">'.$lang['t_footer'].'</label><br>
								<input type="text" class="form-control metaFooter" placeholder="'.$lang['t_footer'].'" value="'.$configData['footer'].'">
							</div>
						</div>
						<button class="btn btn-success btn-block btnUpdateSettingsMeta">'.$lang['t_update'].'</button>
					</div>
				</div>
				<!-- SECTION_BANNER_WEBSITE -->
				<div class="card">
					<div class="card-body m-b-0">
						<h4 class="card-title font-20 mt-0"><strong>'.$lang['t_banner_settings'].'</strong></h4>
						<div class="row">
							<div class="col-md-12 m-b-10">
								<label for="exampleInputEmail1">'.$lang['t_banner_title'].'</label><br>
								<input type="text" class="form-control bannerTitle" placeholder="'.$lang['t_banner_title'].'" value="'.$configData['bannerTitle'].'">
							</div>
							<div class="col-md-12 m-b-10">
								<label for="exampleInputPassword1">'.$lang['t_banner_paragraph'].'</label><br>
								<textarea rows="3" type="text" class="form-control bannerParagraph" placeholder="'.$lang['t_banner_paragraph'].'" style="resize:none;">'.$configData['bannerParagraph'].'</textarea>
							</div>
							<div class="col-md-8 m-b-10">
								<label for="exampleInputPassword1">'.$lang['t_button_text'].'</label><br>
								<input type="text" class="form-control btnTitle" placeholder="'.$lang['t_button_text'].'" value="'.$configData['bannerBtnText'].'">
							</div>
							<div class="col-md-4 m-b-10">
								<label for="exampleInputPassword1">'.$lang['t_button_status'].'</label><br>
								<select class="form-control btnStatus" value="'.$configData['bannerBtnStatus'].'">
									<option value="" selected>'.$lang['t_button_status'].'</option>
									<option value="yes"'.(($configData['bannerBtnStatus']=="yes"?" selected":"")).'>'.$lang['t_yes'].'</option>
									<option value="no"'.(($configData['bannerBtnStatus']=="no"?" selected":"")).'>'.$lang['t_no'].'</option>
								</select>
							</div>
							<div class="col-md-12 m-b-15">
								<label for="exampleInputPassword1">'.$lang['t_button_connection'].'</label><br>
								<input type="text" class="form-control btnHref" placeholder="'.$lang['t_button_connection'].'" value="'.$configData['bannerBtnAddress'].'">
							</div>
						</div>
						<button class="btn btn-success btn-block btnUpdateSettingsBanner">'.$lang['t_update'].'</button>
					</div>
				</div>
			</div>
			
			<div class="col-md-6">
				<!-- SECTION_CONTACT_WEBSITE -->
				<div class="card">
					<div class="card-body m-b-0">
						<h4 class="card-title font-20 mt-0"><strong>'.$lang['t_contact_settings'].'</strong></h4>
						<div class="row">
							<div class="col-md-6 m-b-10">
								<label for="exampleInputEmail1">'.$lang['t_phone'].'</label><br>
								<input type="text" class="form-control contactPhone" placeholder="'.$lang['t_phone'].'" value="'.$configData['phone'].'">
							</div>
							<div class="col-md-6 m-b-10">
								<label for="exampleInputEmail1">'.$lang['t_email'].'</label><br>
								<input type="text" class="form-control contactEmail" placeholder="'.$lang['t_email'].'" value="'.$configData['email'].'">
							</div>
							<div class="col-md-12 m-b-15">
								<label for="exampleInputPassword1">'.$lang['t_address'].'</label><br>
								<input type="text" class="form-control contactAddress" placeholder="'.$lang['t_address'].'" value="'.$configData['address'].'">
							</div>
						</div>
						<button class="btn btn-success btn-block btnUpdateSettingsContact">'.$lang['t_update'].'</button>
					</div>
				</div>
				<!-- SECTION_PASSWORD -->
				<div class="card">
					<div class="card-body m-b-0">
						<h4 class="card-title font-20 mt-0"><strong>'.$lang['t_password'].'</strong></h4>
						<div class="row">
							<div class="col-md-4 m-b-15">
								<label for="exampleInputEmail1">'.$lang['t_password_last'].'</label><br>
								<input type="password" class="form-control lastPass" placeholder="'.$lang['t_password_last'].'">
							</div>
							<div class="col-md-4 m-b-15">
								<label for="exampleInputPassword1">'.$lang['t_password_new'].'</label><br>
								<input type="password" class="form-control newPass" placeholder="'.$lang['t_password_new'].'">
							</div>
							<div class="col-md-4 m-b-15">
								<label for="exampleInputPassword1">'.$lang['t_password_renew'].'</label><br>
								<input type="password" class="form-control reNewPass" placeholder="'.$lang['t_password_renew'].'">
							</div>
						</div>
						<button class="btn btn-success btn-block btnUpdatePassword">'.$lang['t_update'].'</button>
					</div>
				</div>
			</div>
		</div>';
		$scriptContent .= '<script>var d = "";
		$(document).ready(function(){ 
			$(".contactPhone").mask("+99 999 999 9999");
			/*
			var replaceTime = setInterval(function(){
				$(".contactPhone").val("'.$configData['phone'].'");
				clearInterval(replaceTime);				
			}, 2500);
			*/
		});
		/* UPDATE_PASSWORD_SECTION */
		$(".btnUpdatePassword").click(function(e){
			e.preventDefault();
			$(".btnUpdatePassword").attr("disabled", true);
			$.ajax({
				type: "POST",
				url: "'.$config['ajax'].'",
				data: {lastPass: $(".lastPass").val(), newPass: $(".newPass").val(), reNewPass: $(".reNewPass").val(), updatePassword: "updatePassword"},
				dataType: "json",
				success: function(response){ 
					$(".btnUpdatePassword").attr("disabled", false);
					if(response.msgType=="success"){
						$(".lastPass").val("");
						$(".newPass").val("");
						$(".reNewPass").val("");
					}
					alert(response.msgText, response.msgType);
					if(response.msgRedirectLocation!=""){ setInterval(function(){ location.href = response.msgRedirectLocation; }, response.redirectInterval); } }
			});
		});
		/* UPDATE_META_SECTION */
		$(".btnUpdateSettingsMeta").click(function(e){
			e.preventDefault();
			$(".btnUpdateSettingsMeta").attr("disabled", true);
			$.ajax({
				type: "POST",
				url: "'.$config['ajax'].'",
				data: {metaTitle: $(".metaTitle").val(), metaDescription: $(".metaDescription").val(), metaFooter: $(".metaFooter").val(), updateSettingsMeta: "updateSettingsMeta"},
				dataType: "json",
				success: function(response){ 
					$(".btnUpdateSettingsMeta").attr("disabled", false);
					if(response.msgType=="success"){
						$(".metaTitle").val("");
						$(".metaDescription").val("");
						$(".metaFooter").val("");
					}
					alert(response.msgText, response.msgType);
					if(response.msgRedirectLocation!=""){ setInterval(function(){ location.href = response.msgRedirectLocation; }, response.redirectInterval); } }
			});
		});
		/* UPDATE_BANNER_SECTION */
		$(".btnUpdateSettingsBanner").click(function(e){
			e.preventDefault();
			$(".btnUpdateSettingsBanner").attr("disabled", true);
			$.ajax({
				type: "POST",
				url: "'.$config['ajax'].'",
				data: {bannerTitle: $(".bannerTitle").val(), bannerParagraph: $(".bannerParagraph").val(), btnTitle: $(".btnTitle").val(), btnHref: $(".btnHref").val(), btnStatus: $(".btnStatus").val(), updateSettingsBanner: "updateSettingsBanner"},
				dataType: "json",
				success: function(response){ 
					$(".btnUpdateSettingsBanner").attr("disabled", false);
					if(response.msgType=="success"){
						$(".bannerTitle").val("");
						$(".bannerParagraph").val("");
						$(".btnTitle").val("");
						$(".btnHref").val("");
						$(".btnStatus").val("");
					}
					alert(response.msgText, response.msgType);
					if(response.msgRedirectLocation!=""){ setInterval(function(){ location.href = response.msgRedirectLocation; }, response.redirectInterval); } }
			});
		});
		/* UPDATE_CONTACT_SECTION */
		$(".btnUpdateSettingsContact").click(function(e){
			e.preventDefault();
			$(".btnUpdateSettingsContact").attr("disabled", true);
			$.ajax({
				type: "POST",
				url: "'.$config['ajax'].'",
				data: {contactPhone: $(".contactPhone").val(), contactEmail: $(".contactEmail").val(), contactAddress: $(".contactAddress").val(), updateSettingsContact: "updateSettingsContact"},
				dataType: "json",
				success: function(response){ 
					$(".btnUpdateSettingsContact").attr("disabled", false);
					if(response.msgType=="success"){
						$(".contactPhone").val("");
						$(".contactEmail").val("");
						$(".contactAddress").val("");
					}
					alert(response.msgText, response.msgType);
					if(response.msgRedirectLocation!=""){ setInterval(function(){ location.href = response.msgRedirectLocation; }, response.redirectInterval); } }
			});
		});
		</script>';
		break;
		$pageHeader .= '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
		$pageContent .= '<title>'.$lang['t_signin'].'</title><div class="wrapper-page">
		<div class="card">
			<div class="card-body">
				<div class="text-center"><a href="'.$config['url'].'" class="logo logo-admin">'.$config["stuck"].'</a></div>
				<div class="px-3 pb-3">
					<form class="form-horizontal m-b-20">
						<div class="form-group row"><div class="col-12"><input type="text" class="form-control username" placeholder="'.$lang['t_username'].'"></div></div>
						<div class="form-group row"><div class="col-12"><input type="password" class="form-control password" placeholder="'.$lang['t_password'].'"></div></div>
						<div class="col-lg-12"><div class="g-recaptcha mb-3" data-sitekey="6LdYI3kUAAAAAPWox5ZVT7GF3tDILWKMDadVJKZx"></div></div>
						<div class="form-group text-center row m-b-20"><div class="col-12"><button class="btn btn-danger btn-block waves-effect waves-light loginBtn">'.$lang['t_signin'].'</button></div></div>
					</form>
				</div>
			</div>
		</div></div>';
		$scriptContent .= '<script>var d = ""; 
		$(".loginBtn").click(function(e){
			e.preventDefault();
			var rcres = grecaptcha.getResponse();
			if(rcres.length){
				$(".loginBtn").attr("disabled", true);
				$.ajax({
					type: "POST",
					url: "'.$config['ajax'].'",
					data: {username: $(".username").val(), password: $(".password").val(), login: "login"},
					dataType: "json",
					success: function(response){ $(".loginBtn").attr("disabled", false); alert(response.msgText, response.msgType); if(response.msgRedirectLocation!=""){ setInterval(function(){ location.href = response.msgRedirectLocation; }, response.redirectInterval); } }
				});
			}else{ alert("'.$lang['msg_complete_verification'].'", 2); }
		});
		</script>';
		case "logout":
			session_destroy();
			unset($_SESSION['session']);
			unset($_SESSION['user']);
			header('location:'.$dot.$route['login']);
		break;
	}
}else{
	$pageHeader .= '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
	$pageContent .= '<title>'.$lang['t_signin'].'</title><div class="wrapper-page">
	<div class="card">
		<div class="card-body">
			<div class="text-center"><a href="'.$config['url'].'" class="logo logo-admin">'.$config["stuck"].'</a></div>
			<div class="px-3 pb-3">
				<form class="form-horizontal m-b-20">
					<div class="form-group row"><div class="col-12"><input type="text" class="form-control username" placeholder="'.$lang['t_username'].'"></div></div>
					<div class="form-group row"><div class="col-12"><input type="password" class="form-control password" placeholder="'.$lang['t_password'].'"></div></div>
					<!-- <div class="col-lg-12"><div class="g-recaptcha mb-3" data-sitekey="REPLACE_ME_GOOGLE_CAPTCHA"></div></div> -->
					<div class="form-group text-center row m-b-20"><div class="col-12"><button class="btn btn-danger btn-block waves-effect waves-light loginBtn">'.$lang['t_signin'].'</button></div></div>
				</form>
			</div>
		</div>
	</div></div>';
	$scriptContent .= '<script>var d = ""; 
	$(".loginBtn").click(function(e){
		e.preventDefault();
		//var rcres = grecaptcha.getResponse();
		//if(rcres.length){
			$(".loginBtn").attr("disabled", true);
			$.ajax({
				type: "POST",
				url: "'.$config['ajax'].'",
				data: {username: $(".username").val(), password: $(".password").val(), login: "login"},
				dataType: "json",
				success: function(response){ $(".loginBtn").attr("disabled", false); alert(response.msgText, response.msgType); if(response.msgRedirectLocation!=""){ setInterval(function(){ location.href = response.msgRedirectLocation; }, response.redirectInterval); } }
			});
		//}else{ alert("'.$lang['msg_complete_verification'].'", 2); }
	});
	</script>';
}
/* Output */
$hf->rwc($component['adminHeader'].$pageHeader.'</head><body'.((isset($_SESSION['session']))?' class="fixed-left"':'').'>');
if(isset($_SESSION['session'])){ $hf->rwc('<div id="wrapper">'.$component['adminSidebar'].'<div class="content-page"><div class="content">'.((isset($_SESSION['session']))?$component['adminNavbar']:'').'<div class="page-content-wrapper "><div class="container-fluid"><br>'); }
$hf->rwc($pageContent);
if(isset($_SESSION['session'])){ $hf->rwc('</div></div></div></div></div>'); }
$hf->rwc($component['adminScript'].$scriptContent.'</body></html>');
?>
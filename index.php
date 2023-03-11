<?php require_once('component.php');
$hf->rwc($component['indexHeader']);
echo '<title>'.$configData['title'].' - '.$config['stuck'].'</title>
<meta name="description" content="'.$configData['description'].'">';
$hf->rwc('</head><body><div id="wrapper"><div class="w1">');
$hf->rwc($component['indexNavbar']);
$hf->rwc('<main id="main">');
echo '	
<!-- start of main banner -->
<section class="main-banner text-center small">
	<!-- slide -->
	<div class="slide" style="background-color: #000;">
		<span class="bg-overlay"></span>
		<div id="particles" style="width: 100%; position: absolute; top: 0; right: 0; bottom: 0; left: 0; z-index: 0;"></div>
		<div class="caption">
			<div class="holder">
				<h1 class="heading small">'.$configData['bannerTitle'].'</h1>
				<p>'.$configData['bannerParagraph'].'</p>
				<a target="_blank" href="https://www.facebook.com/oxcakmak/" class="btn btn-green text-uppercase">Facebook</a>&nbsp;
				<a target="_blank" href="https://github.com/oxcakmak" class="btn btn-green text-uppercase">Github</a>&nbsp;
				<a target="_blank" href="https://play.google.com/store/apps/dev?id=6033912928892684022" class="btn btn-green text-uppercase">Google Play</a>&nbsp;
				<a target="_blank" href="https://www.instagram.com/oxcakmak/" class="btn btn-green text-uppercase">Instagram</a>&nbsp;
				<a target="_blank" href="https://www.linkedin.com/in/oxcakmak" class="btn btn-green text-uppercase">LinkedIN</a>&nbsp;
				<a target="_blank" href="https://www.youtube.com/channel/UCDYm_wFqzvzl4219igt25GQ" class="btn btn-green text-uppercase">Youtube</a>&nbsp;
				<a target="_blank" href="https://web.whatsapp.com/send/?phone=902626060829&text&type=phone_number&app_absent=0" class="btn btn-green text-uppercase">Whatsapp</a>&nbsp;
				'.(($configData['bannerBtnStatus']==1)?'<a target="_blank" href="'.$configData['bannerBtnAddress'].'" class="btn btn-green text-uppercase">'.$configData['bannerBtnText'].'</a>':'').'
			</div>
		</div>
	</div>
	<a href="#portfolio" data-scroll-nav="1" class="btn-bottom pe-7s-angle-down"></a>
</section><!-- end of main banner -->
<div class="container pad-top-lg pad-bottom-sm" id="portfolio">
	<!-- start of main-heading -->
	<header class="main-heading text-center row">
		<div class="col-xs-12">
			<h2 class="heading">'.$lang['t_blog'].'</h2>
			<!-- <p>When you create your startup the only way to win <br>is to race ahead not to stop and fight.</p> -->
		</div>
	</header><!-- end of main-heading -->
	<div class="row pad-top-md pad-bottom-md">
		<!-- start of isotop-holder -->
		<div id="isotop-holder">';
			$dbh->orderBy("id", "DESC");
			foreach($dbh->get("article", 9) as $articleRow){ echo '
			<div class="item col-xs-12 col-sm-6 col-md-4"><!-- start of item -->
				<div class="product-box"><!-- start of product-box -->
					<a class="img-box" style="height: 240px;" href="'.$config["url"].$route['blogs'].$articleRow['slug'].'"><div class="hold"><img src="'.$articleRow['picture'].'" alt="'.$articleRow['title'].'" class="img-responsive"></div></a>
					<div class="box" style="height:128px;">
						<h3 class="heading"><a href="'.$config["url"].$route['blogs'].$articleRow['slug'].'">'.$articleRow['title'].'</a></h3>
						<!-- <div class="frame"><span class="price">'.substr($articleRow['createDate'], 0, -6).'</span></div> -->
					</div>
				</div><!-- end of product-box -->
			</div><!-- end of item -->'; } echo '
		</div><!-- end of isotop-holder -->
	</div>
	<div class="row"><div class="col-xs-12 text-center"><a href="'.$config["url"].$route['blog'].'" class="btn btn-default add text-uppercase">'.$lang['t_view_all'].'</a></div></div>
	</div>
</div>';
$hf->rwc('</main>');
$hf->rwc($component['indexFooter']);
$hf->rwc('</div><span id="back-top" class="pe-7s-angle-up main-bg-color"></span></div>');
$hf->rwc($component['indexScript']);
$hf->rwc('</body></html>');
?>
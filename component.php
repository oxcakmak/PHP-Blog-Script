<?php require_once('config.php');
$component = [];
/* General */
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';

/* Website Header */
$component['indexHeader'] = '<!DOCTYPE html><html><head>
<!-- set the encoding of your site -->
<meta charset="utf-8">
<!-- set the viewport width and initial-scale on mobile devices -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- set the apple mobile web app capable -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- set the HandheldFriendly -->
<meta name="HandheldFriendly" content="True">
<!-- set the apple mobile web app status bar style -->
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<!-- include the site stylesheet -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CWork+Sans:300,400,500,600" rel="stylesheet">
<!-- include the site stylesheet -->
<link rel="stylesheet" href="'.$config['assets'].'index/css/bootstrap.css">
<!-- include the site stylesheet -->
<link rel="stylesheet" href="'.$config['assets'].'index/css/fonts-icons.css">
<!-- include the site stylesheet -->
<link rel="stylesheet" href="'.$config['assets'].'index/css/plugin-resets.css">
<!-- include the site stylesheet -->
<link rel="stylesheet" href="'.$config['assets'].'index/css/style.css">
<!-- include the site stylesheet -->
<link rel="stylesheet" href="'.$config['assets'].'index/css/responsive.css">
<!-- include the site stylesheet -->
<link rel="stylesheet" href="'.$config['assets'].'index/css/color.css">
<link rel="apple-touch-icon" sizes="57x57" href="'.$config['assets'].'index/images/favicons/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="'.$config['assets'].'index/images/favicons/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="'.$config['assets'].'index/images/favicons/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="'.$config['assets'].'index/images/favicons/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="'.$config['assets'].'index/images/favicons/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="'.$config['assets'].'index/images/favicons/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="'.$config['assets'].'index/images/favicons/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="'.$config['assets'].'index/images/favicons/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="'.$config['assets'].'index/images/favicons/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="'.$config['assets'].'index/images/favicons/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="'.$config['assets'].'index/images/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="'.$config['assets'].'index/images/favicons/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="'.$config['assets'].'index/images/favicons/favicon-16x16.png">
<link rel="manifest" href="'.$config['assets'].'index/images/favicons/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="'.$config['assets'].'index/images/favicons/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6113880253435669" crossorigin="anonymous"></script>';

/* Website Navbar */
$component['indexNavbar'] = '<!-- start of page header -->
<header id="header" class="nospace">
	<!-- header holder -->
	<div class="header-holder">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<!-- Page logo -->
					<div class="logo pull-left"><a href="'.$config['url'].'">'.$config['stuck'].'</a></div>
					<div class="holder pull-right" style="width:auto;">
						<a href="#" class="pe-7s-menu menu-opener opener pull-right visible-xs"></a>
						<!-- start of page navigation -->
						<nav id="nav" class="text-uppercase">
							<ul class="list-inline">
								<li><a href="'.$config['url'].'">'.$lang['t_home'].'</a></li>
								<li><a href="'.$config['url'].$route['blog'].'">'.$lang['t_blog'].'</a></li>';
								/* Check Main Pages If Exists */
								$dbh->where("nav", "main"); if($dbh->has("page")){ $dbh->where("nav", "main")->orderBy("slug", "ASC"); foreach($dbh->get("page") as $pageRow){ $component['indexNavbar'] .= '<li><a href="'.$config['url'].$route['pages'].$pageRow['slug'].'">'.$pageRow['title'].'</a></li>'; } }
								/* Check Sub Pages If Exists */
								$dbh->where("nav", "sub");
								if($dbh->has("page")){
									$component['indexNavbar'] .= '<li><a class="drop-link" href="#">'.$lang['t_pages'].'</a><div class="drop"><ul class="list-unstyled">';
									$dbh->where("nav", "sub")->orderBy("slug", "ASC");
									foreach($dbh->get("page") as $pageRow){ $component['indexNavbar'] .= '<li><a href="'.$config['url'].$route['pages'].$pageRow['slug'].'" class="nav-link">'.$pageRow['title'].'</a></li>'; }
									$component['indexNavbar'] .= '</ul></div></li>';
								}
$component['indexNavbar'] .= '</ul>
						</nav><!-- end of page navigation -->
					</div>
				</div>
			</div>
		</div>
	</div>
</header><!-- end of page header -->';

/* Website Footer */
$component['indexFooter'] = '<!-- start of page footer -->
<footer id="footer">
	<div class="bg-dark2 pad-top-lg pad-bottom-xs">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-4 mar-bottom-xs">
					<!-- logo -->
					<div class="logo"><a href="'.$config['url'].'">'.$config['stuck'].'</a></div>
					<p>'.$configData['description'].'</p>
					<ul class="list-unstyled mt-2" style="margin-bottom:0;">
						<li><a href="tel:'.$configData['phone'].'">'.$configData['phone'].'</a></li>
						<li><a href="mailto:'.$configData['email'].'">'.$configData['email'].'</a></li>
					</ul>
					<p>'.$configData['address'].'</p>
				</div>
				<div class="col-xs-12 col-sm-5 mar-bottom-xs">
					<span class="title text-uppercase" style="margin:0;">'.$lang['t_blog'].'</span>
					<ul class="list-unstyled">';
					$dbh->orderBy("id", "DESC");
					foreach($dbh->get("article", 10) as $articleRow){ $component['indexFooter'] .= '<li><a href="'.$config['url'].$route['blogs'].$articleRow['slug'].'">'.$articleRow['title'].'</a></li>'; }
$component['indexFooter'] .= '</ul>
				</div>
				<div class="col-xs-12 col-sm-3 mar-bottom-xs">
					<span class="title text-uppercase" style="margin:0;">'.$lang['t_pages'].'</span>
					<ul class="list-unstyled">';
					$dbh->where("footer", "yes")
					->orderBy("slug", "ASC");
					foreach($dbh->get("page") as $pageRow){ $component['indexFooter'] .= '<li><a href="'.$config['url'].$route['pages'].$pageRow['slug'].'">'.$pageRow['title'].'</a></li>'; }
$component['indexFooter'] .= '</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- start of f-bottom -->
	<div class="bg-dark3 f-bottom">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<span class="pull-left">'.$configData['footer'].'</span>
					<!-- <span class="pull-right"><a href="#">Policy Privacy</a>  &nbsp; &nbsp; &nbsp; &nbsp; <a href="#">Terms &amp; Conditions</a></span> -->
				</div>
			</div>
		</div>
	</div><!-- end of f-bottom -->
</footer><!-- end of page footer -->';

/* Website Script */
$component['indexScript'] = '<script src="'.$config['assets'].'index/js/jquery.js"></script>
<script src="'.$config['assets'].'index/js/plugins.js"></script>
<script src="'.$config['assets'].'index/js/jquery.main.js"></script>
<script src="'.$config["assets"].'index/js/particles.min.js"></script>
<script src="'.$config["assets"].'index/js/particles.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-172622736-1"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag("js", new Date());
	gtag("config", "UA-172622736-1");
</script>';

/* Admin Area Header */
$component['adminHeader'] = '<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<link href="'.$config['panelAssets'].'css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="'.$config['panelAssets'].'css/icons.css" rel="stylesheet" type="text/css">
<link href="'.$config['panelAssets'].'css/style.css" rel="stylesheet" type="text/css">
<link href="'.$config['panelAssets'].'css/materialdesignicons.min.css" rel="stylesheet" />
<link href="'.$config['panelAssets'].'vendor/sweet-alert2/sweetalert2.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
<style>body * { font-family: \'Raleway\', sans-serif; font-weight: 300; }</style>
<link rel="apple-touch-icon" sizes="57x57" href="'.$config['assets'].'index/images/favicons/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="'.$config['assets'].'index/images/favicons/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="'.$config['assets'].'index/images/favicons/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="'.$config['assets'].'index/images/favicons/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="'.$config['assets'].'index/images/favicons/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="'.$config['assets'].'index/images/favicons/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="'.$config['assets'].'index/images/favicons/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="'.$config['assets'].'index/images/favicons/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="'.$config['assets'].'index/images/favicons/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="'.$config['assets'].'index/images/favicons/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="'.$config['assets'].'index/images/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="'.$config['assets'].'index/images/favicons/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="'.$config['assets'].'index/images/favicons/favicon-16x16.png">
<link rel="manifest" href="'.$config['assets'].'index/images/favicons/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="'.$config['assets'].'index/images/favicons/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">';

/* Admin Area Scripts */
$component['adminScript'] = '<script src="'.$config['panelAssets'].'js/jquery.min.js"></script>
<script src="'.$config['panelAssets'].'js/popper.min.js"></script>
<script src="'.$config['panelAssets'].'js/bootstrap.min.js"></script>
<script src="'.$config['panelAssets'].'js/modernizr.min.js"></script>
<script src="'.$config['panelAssets'].'js/detect.js"></script>
<script src="'.$config['panelAssets'].'js/fastclick.js"></script>
<script src="'.$config['panelAssets'].'js/jquery.blockUI.js"></script>
<script src="'.$config['panelAssets'].'js/waves.js"></script>
<script src="'.$config['panelAssets'].'js/jquery.nicescroll.js"></script>
<script src="'.$config['panelAssets'].'vendor/sweet-alert2/sweetalert2.min.js"></script>
<script src="'.$config['panelAssets'].'vendor/masked-input/jquery.masked-input.min.js"></script>
<script src="'.$config['panelAssets'].'js/app.js"></script>
<style>.swal2-modal .swal2-title { font-size: 1.5vw; word-wrap: break-word; white-space: initial;}</style>
<script>function alert(text, type){ 
	swal({
		title: text,
		text: "",
		type: ((type==0)?"error":((type==1)?"success":((type==2)?"warning":((type==3)?"info":"info")))),
		confirmButtonText: "'.$lang['t_ok'].'"
	});
}</script>';

/* Admin Area Navbar */
$component['adminNavbar'] = '<div class="topbar"><nav class="navbar-custom"><ul class="list-inline menu-left mb-0"><li class="float-left"><button class="button-menu-mobile open-left waves-light waves-effect"><i class="mdi mdi-menu"></i></button></li></ul><div class="clearfix"></div></nav></div>';

/* Admin Area Sidebar */
$component['adminSidebar'] = '
<div class="left side-menu">
	<button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect"><i class="mdi mdi-close"></i></button>

	<!-- LOGO -->
	<div class="topbar-left">
		<div class="text-center">
			<!--<a href="index.html" class="logo"><i class="mdi mdi-assistant"></i> Zoter</a>-->
			<a href="'.$config['admin'].'" class="logo text-white">'.$config['stuck'].'</a>
		</div>
	</div>

	<div class="sidebar-inner niceScrollleft">

		<div id="sidebar-menu">
			<ul>
				<li><a href="'.$config['admin'].'" class="waves-effect"><i class="mdi mdi-home"></i><span>'.$lang['t_home'].'</span></a></li>
				<li><a href="'.$dot.$route['file'].'" class="waves-effect"><i class="mdi mdi-file"></i><span>'.$lang['t_file'].'</span></a></li>
				<li><a href="'.$dot.$route['article'].'" class="waves-effect"><i class="mdi mdi-newspaper"></i><span>'.$lang['t_article'].'</span></a></li>
				<li><a href="'.$dot.$route['page'].'" class="waves-effect"><i class="mdi mdi-file-document"></i><span>'.$lang['t_page'].'</span></a></li>
				<li><a href="'.$dot.$route['settings'].'" class="waves-effect"><i class="mdi mdi-cog"></i><span>'.$lang['t_settings'].'</span></a></li>
				<li><a href="'.$dot.$route['logout'].'" class="waves-effect"><i class="mdi mdi-logout"></i><span>'.$lang['t_signout'].'</span></a></li>
			</ul>
		</div>
		<div class="clearfix"></div>
	</div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->';
/*
				<li class="menu-title">Components</li>
				<li><a href="'.$dot.$route['settings'].'" class="waves-effect"><i class="mdi mdi-cog-outline"></i><span>'.$lang['t_settings'].'</span></a></li>
				<li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-bullseye"></i> <span> UI Elements </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
					<ul class="list-unstyled">
						<li><a href="ui-buttons.html">Buttons</a></li>
					</ul>
				</li>
				*/
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';
$component['change_me'] = 'change_me';

?>
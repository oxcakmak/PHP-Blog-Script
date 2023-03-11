<?php require_once('component.php');
$hf->rwc($component['indexHeader']);
$slug = $hf->sclr($_GET['slug']);
if(empty($slug) || $slug == NULL){ header('location:'.$config["url"]); }
$dbh->where("slug", $slug);
if(!$dbh->has("article")){ include('404.php'); exit; }
$dbh->where("slug", $slug);
$articleRow = $dbh->getOne("article");
echo '<title>'.$articleRow['title'].' - '.$config['stuck'].'</title>
<meta name="description" content="'.$articleRow['description'].'">
<meta property="og:description" content="'.$articleRow['description'].'" />
<meta property="og:locale" content="tr_TR" />
<meta property="og:site_name" content="'.$config['stuck'].'" />
<meta property="og:url" content="'.$config['url'].$route['blogs'].$slug.'" />
<meta property="og:image" content="'.$articleRow['picture'].'" />
<script type="application/ld+json">
{
	"@context": "https://schema.org/",
	"@type": "article",
	"name": "'.$articleRow['title'].'",
	"image": ["'.$articleRow['picture'].'"],
	"description": "'.$articleRow['description'].'",
	"brand": {
		"@type": "'.$config['stuck'].'",
		"name": "'.$config['stuck'].'"
	}
}
</script>
<link href="'.$config["panelAssets"].'vendor/highlight/highlight.min.css" rel="stylesheet" />
<style>.blog-detail p { margin: 0 0 5px; color: black; } .blog-detail ol,ul,li { color: black; } .blog-detail pre { overflow-x:scroll; -moz-tab-size: 4; -o-tab-size: 4; tab-size: 4; } .blog-detail blockquote { margin: 1px 0 15px 0;}</style>
<style>
.readBar {
	background-color: #2ecc71;
	position: fixed;
	top: 0;
	bottom: auto;
	left: 0;
	width: 0%;
	height: 5px;
	z-index: 1000;
}
</style>
<script>
/*
let prog = document.getElementsByClassName("readBar")[0],
	body = document.body,
    html = document.documentElement;
let height = document.querySelector(".blog-detail").offsetHeight;
// prog.style.width = 0 + "%";
const setProgress = () => {
   let scrollFromTop = (document.documentElement.scrollTop || body.scrollTop) + html.clientHeight;
   let width = height * 100 + 50 + "%";
   
   prog.style.width = width;
}
window.addEventListener("scroll", setProgress);
*/
</script>';
$hf->rwc('</head><body><div id="wrapper"><div class="w1"><div class="readBar"></div>');
$hf->rwc($component['indexNavbar']);
$hf->rwc('<main id="main" class="bg-grey border-top">');
echo '<!-- start of page-header -->
<div class="page-header text-center" style="background-color: #000;">
	<span class="bg-overlay"></span>
	<div id="particles" style="width: 100%; position: absolute; top: 0; right: 0; bottom: 0; left: 0; z-index: 0;"></div>
	<div class="container pad-top-md pad-bottom-sm">
		<div class="row pad-top-md pad-bottom-sm">
			<div class="col-xs-12">
				<h1 class="heading">'.$articleRow['title'].'</h1>
				<ul class="list-inline breadcrumbs">
					<li><a href="'.$config['url'].'">'.$lang['t_home'].'</a></li>
					<li><a href="'.$config['url'].$route['articles'].$slug.'">'.$lang['t_article'].'</a></li>
					<li><a href="'.$config['url'].$route['articles'].$slug.'">'.$articleRow['title'].'</a></li> 
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="container pad-top-xs pad-bottom-xs">
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-9">
			<div class="blog-detail" style="margin-bottom:0;">
				<div class="text-box bg-white" style="padding:10px;">
					<h2 class="heading" style="text-transform:capitalize;">'.$articleRow['title'].'</h2>
					<span class="meta" style="margin:0;color:black;">'.$articleRow['description'].'</span>
				</div>
				<div class="img"><img src="'.$articleRow['picture'].'" alt="'.$articleRow['title'].'" class="img-responsive" ></div>
				<div class="text-box bg-white" style="padding:10px;"><div class="articontent">'.$articleRow['content'].'</div></div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4 col-md-3">
			<section class="widget post-widget bg-white" style="padding-bottom:0;">
				<h2 class="heading" style="padding-left:10px; margin-bottom:10px;padding-top:10px;">'.$lang['t_latest_posts'].'</h2>
				<ul class="list-unstyled" style="padding-left:10px;padding-bottom:0;">';
					$dbh->orderBy("id", "DESC");
					foreach($dbh->get("article", 10) as $articleRow){ echo '
					<li>
						<a href="#" class="img-box"><img src="'.$articleRow['picture'].'" alt="'.$articleRow['title'].'" class="img-responsive"></a>
						<div class="text-box">
							<span class="head add"><a href="'.$config["url"].$route['blogs'].$articleRow['slug'].'" style="text-transform:capitalize;">'.substr($articleRow['title'], 0, 20).'</a></span>
							<span class="txt">'.substr($articleRow['createDate'], 0, -6).'</span>
						</div>
					</li>'; } echo '
				</ul>
			</section>
		</div>
	</div><!-- end of port-detail -->
	
</div>';
$hf->rwc('</main>'.$component['indexFooter'].'</div><span id="back-top" class="pe-7s-angle-up main-bg-color"></span></div>'.$component['indexScript']);
echo '<script src="'.$config["panelAssets"].'vendor/highlight/highlight.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", (event) => {
	document.querySelectorAll("pre").forEach((el) => {
		hljs.highlightElement(el);
	});
	$(".articontent img").css("height", "auto");
});
$(window).scroll(function() {
  
  // Variables
  var height = $(document).height() - $(window).height(); 
  var scroll  = $(window).scrollTop();
  console.log("Scroll: "+ scroll + "Height: "+ height);
  
  // Read percent calculation
  var readPercent = (scroll / height) * 100;
  console.log("Read Percent: " + readPercent);
  
  // Set progress bar width to read percent
  if (readPercent > 1) {
    $(".readBar").css("width", readPercent+15 + "%");
  }else{ $(".readBar").css("width", "0%"); }

});
</script>';
$hf->rwc('</body></html>');
?>
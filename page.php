<?php require_once('component.php');
$hf->rwc($component['indexHeader']);
$slug = @$hf->sclr($_GET['slug']);
if(empty($slug) || $slug == NULL){ header('location:'.$config["url"]); }
$dbh->where("slug", $slug);
if(!$dbh->has("page")){ include('404.php'); exit; }
$dbh->where("slug", $slug);
$pageRow = $dbh->getOne("page");
echo '<title>'.$pageRow['title'].' - '.$config['stuck'].'</title>
<meta name="description" content="'.$pageRow['description'].'">
<script type="application/ld+json">
[{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [{
	"@type": "ListItem",
	"position": 1,
	"name": "'.$pageRow['title'].'",
	"item": "'.$config["url"].$route['pages'].$pageRow['slug'].'"
  }]
}]
</script>
<style>.blog-detail p { margin: 0 0 8px; } .blog-detail pre { white-space:pre-wrap; }</style>';
$hf->rwc('</head><body><div id="wrapper"><div class="w1">');
$hf->rwc($component['indexNavbar']);
$hf->rwc('<main id="main" class="bg-grey">');
echo '
<!-- start of page-header -->
<div class="page-header text-center" style="background-color: #000;">
	<span class="bg-overlay"></span>
	<div id="particles" style="width: 100%; position: absolute; top: 0; right: 0; bottom: 0; left: 0; z-index: 0;"></div>
	<div class="container pad-top-xs pad-bottom-lg">
		<div class="row pad-top-md pad-bottom-xs">
			<div class="col-xs-12">
				<h1 class="heading">'.$lang['t_pages'].'</h1>
				<ul class="list-inline breadcrumbs">
					<li><a href="'.$config['url'].'">'.$lang['t_home'].'</a></li>
					<li>'.$lang['t_pages'].'</li>
				</ul><!-- end of breadcrumbs -->
			</div>
		</div>
	</div>
</div><!-- end of page-header -->
<div class="container pad-top-md pad-bottom-md">
	<div class="row pad-top-xs">
		<div class="col-xs-12 col-sm-8 col-md-9">
			<div class="blog-detail">
				<div class="text-box bg-white">
					<h2 class="heading">'.$pageRow['title'].'</h2><br /><div>'.$pageRow['content'].'</div><br />
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4 col-md-3">
			<!-- start of widget cat-widget -->
			<section class="widget cat-widget">
				<h2 class="heading">'.$lang['t_pages'].'</h2>
				<ul class="list-unstyled">';
					$dbh->orderBy("slug", "ASC");
					foreach($dbh->get("page") as $pageRow){ $hf->rwc('<li'.(($slug==$pageRow['slug'])?' class="active"':'').'><a href="'.$config['url'].$route['pages'].$pageRow['slug'].'">'.$pageRow['title'].'</a></li>'); } echo '
				</ul>
			</section><!-- end of widget cat-widget -->
			
		</div>
	</div>
</div>';
$hf->rwc('</main>');
$hf->rwc($component['indexFooter']);
$hf->rwc('</div><span id="back-top" class="pe-7s-angle-up main-bg-color"></span></div>');
$hf->rwc($component['indexScript']);
$hf->rwc('</body></html>');
?>
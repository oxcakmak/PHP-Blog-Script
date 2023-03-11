<?php require_once('component.php');
$hf->rwc($component['indexHeader']);
$page = @intval($_GET['p']); if(!$page){ $page = 1; }
$query = @$hf->sclr($_GET['q']);
$url = "";
if($query != NULL || $query != ""){
	$rawSearch = rawWhereFilterColumn($query, array("title", "content", "description"));
	$totalDataCount = $dbh->rawQuery('SELECT COUNT(*) AS retval FROM article WHERE '.$rawSearch)[0]['retval'];
	$url = $config['url'].$route['blog'].'?q='.$query.'&';
	$hf->rwc('<title>'.$lang['t_searching'].' - '.$config['stuck'].'</title>');
}else{
	$totalDataCount = $dbh->getValue("article", "COUNT(*)");
	$url = $config['url'].$route['blog'].'?';
	$hf->rwc('<title>'.$lang['t_blog'].' - '.$config['stuck'].'</title>');
}
$pageLimit = 12;
$pageNumber = ceil($totalDataCount/$pageLimit);
$viewData = $page * $pageLimit - $pageLimit;
$viewPerPage = 10;
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
				<h1 class="heading">'.$lang['t_blog'].'</h1>
				<ul class="list-inline breadcrumbs">
					<li><a href="'.$config['url'].'">'.$lang['t_home'].'</a></li>
					<li>'.$lang['t_blog'].'</li>
				</ul><!-- end of breadcrumbs -->
			</div>
		</div>
	</div>
</div><!-- end of page-header -->
<div class="container pad-top-xs">
	<div class="row"><div class="col-xs-12"><header class="shop-header mar-bottom-xs">'.(($query != NULL || $query != "")?'<span class="txt">'.str_replace(array("%s", "%c"), array($query, $totalDataCount) , $lang['t_search_x_result_x_found']).'</span>':'').'<form action="" method="GET" class="search-form pull-right" style="margin-bottom:0;"><input type="text" placeholder="'.$lang['t_keyword'].'" class="form-control" name="q"'.(($query != NULL || $query != "")?' value="'.$query.'"':'').'><button class="icon pe-7s-search" type="submit"></button></form></header><!-- end of shop-header --></div></div>
	<div class="row mar-bottom-xs">';
		if($totalDataCount > 0){
		foreach($dbh->rawQuery('SELECT * FROM article '.(($query != NULL || $query != "")?'WHERE '.@$rawSearch:'').' ORDER BY id DESC LIMIT ?, ?', [$viewData, $pageLimit]) as $articleRow){ echo '
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 mar-bottom-xs">
			<div class="product-box small">
				<a class="img-responsive" href="'.$config["url"].$route['blogs'].$articleRow['slug'].'"><div class="hold"><img src="'.$articleRow['picture'].'" alt="'.$articleRow['title'].'" class="img-responive"></div></a>
				<div class="box" style="height:82px;"><h3 class="heading large"><a href="'.$config["url"].$route['blogs'].$articleRow['slug'].'">'.substr($articleRow['title'], 0, 50).'</a></h3></div>
			</div><!-- end of product-box small -->
		</div>'; }
		}else{ echo 'yok'; }
		echo '		
	</div>
	<div class="row mar-bottom-lg">
		<div class="col-xs-12">';
			if($totalDataCount > 0){ $hf->rwc('<ul class="list-inline shop-pagination text-center">');
				if($page > 1){ $hf->rwc('<li><a href="'.$url.'p=1"><i class="fa fa-angle-double-left"></i></a></li><li><a style="font-size:15px;margin-right:10px;" href="'.$url.'p='.($page - 1).'"><i class="fa fa-angle-left"></i></a></li>'); }
				for($i = $page - $viewPerPage; $i < $page + $viewPerPage +1; $i++){ if($i > 0 && $i <= $pageNumber){ if($i == $page){ $hf->rwc('<li class="active"><a href="'.$url.'p='.$i.'">'.$i.'</a><li>'); }else{ $hf->rwc('<li><a href="'.$url.'p='.$i.'">'.$i.'</a></li>'); } } }
				if($page != $pageNumber){ $hf->rwc('<li><a href="'.$url.'p='.($page + 1).'"><i class="fa fa-angle-right"></i></a></li><li><a href="'.$url.'p='.$pageNumber.'"><i class="fa fa-angle-double-right"></i></a></li>'); }
				$hf->rwc('</ul>');
			} echo '
		</div>
	</div>
</div>';
$hf->rwc('</main>'.$component['indexFooter'].'</div><span id="back-top" class="pe-7s-angle-up main-bg-color"></span></div>'.$component['indexScript']);
$hf->rwc('</body></html>');
?>
<?php require_once('component.php');
$hf->rwc($component['indexHeader']);
echo '<title>'.$lang['t_not_found'].' - '.$config['stuck'].'</title>';
$hf->rwc('</head><body><div id="wrapper"><div class="w1">');
$hf->rwc($component['indexNavbar']);
$hf->rwc('<main id="main" class="bg-grey border-top">');
echo '<section class="main-banner text-center small">
<div class="slide" style="background-color: #000;">
	<span class="bg-overlay"></span>
	<div id="particles" style="width: 100%; position: absolute; top: 0; right: 0; bottom: 0; left: 0; z-index: 0;"></div>
	<div class="caption">
		<div class="holder">
			<h1 class="heading small">'.$lang['t_not_found'].'</h1>
			<p>'.$lang['t_not_found_description'].'</p>
			<a href="'.$config['url'].'" class="btn btn-green text-uppercase">'.$lang['t_home_comeback'].'</a>
		</div>
	</div>
</div>
</section>';
$hf->rwc('</main>');
$hf->rwc($component['indexFooter']);
$hf->rwc('</div><span id="back-top" class="pe-7s-angle-up main-bg-color"></span></div>');
$hf->rwc($component['indexScript']);
$hf->rwc('</body></html>');
?>
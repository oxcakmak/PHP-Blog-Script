<?php require_once('config.php');
header('Content-Type: text/xml');
$hf->rwc('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><url><loc>'.$config["url"].'</loc><lastmod>'.date("Y-m-d\TH:i:s+03:00").'</lastmod><changefreq>weekly</changefreq><priority>0.5</priority></url><url><loc>'.$config["url"].$route['404'].'</loc><lastmod>'.date("Y-m-d\TH:i:s+03:00").'</lastmod><changefreq>weekly</changefreq><priority>0.5</priority></url><url><loc>'.$config["url"].$route['blog'].'</loc><lastmod>'.date("Y-m-d\TH:i:s+03:00").'</lastmod><changefreq>weekly</changefreq><priority>0.5</priority></url>');
$dbh->orderBy("slug", "ASC");
foreach($dbh->get("article") as $articleRow){ $hf->rwc('<url><loc>'.$config["url"].$route['blogs'].$articleRow['slug'].'</loc><lastmod>'.date("Y-m-d\TH:i:s+03:00", strtotime($articleRow['modifyDate'])).'</lastmod><changefreq>weekly</changefreq><priority>0.5</priority></url>'); }
$dbh->orderBy("slug", "ASC");
foreach($dbh->get("page") as $pageRow){ $hf->rwc('<url><loc>'.$config["url"].$route['pages'].$pageRow['slug'].'</loc><lastmod>'.date("Y-m-d\TH:i:s+03:00", strtotime($pageRow['modifyDate'])).'</lastmod><changefreq>weekly</changefreq><priority>0.5</priority></url>'); }
$hf->rwc('</urlset>');
?>
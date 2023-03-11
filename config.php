<?php
/* Default */
function minifier($code) {
    $search = array(
        // Remove whitespaces after tags
        '/\>[^\S ]+/s',
        // Remove whitespaces before tags
        '/[^\S ]+\</s',
        // Removes comments
        '/<!--(.|\s)*?-->/'
    );
    $replace = array('>', '<', '\\1');
    $code = preg_replace($search, $replace, $code);
    return $code;
}
ob_start();
session_start();
setlocale(LC_ALL, "tr_TR.UTF-8", "tr_TR", "tr", "turkish");
date_default_timezone_set("Europe/Istanbul");
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

/* Function */
include("hepa.php");
$hf = new hepa;

/* Language */
include("tr_TR.php");

/* Route */
include("route.php");

/* Connection */
include("MysqliDb.php");
$dbh = new MysqliDb([
	'type' => 'mysql',
    'host' => 'localhost',
    'username' => 'root', 
    'password' => '',
    'db'=> 'oxcakmak',
    'charset' => 'utf8'
]);

/* Variables */
$config = array();
$config["rootpath"] = __DIR__."/";
$config["url"] = "http://localhost/";
$config["panel"] = $config["url"]."panel/";
$config["admin"] = $config["url"]."admin";
$config["ajax"] = $config["url"]."ajax";
$config["assets"] = $config["url"]."assets/";
$config["indexAssets"] = $config["url"]."assets/index/";
$config["panelAssets"] = $config["url"]."assets/panel/";
$config["stuck"] = "OXCAKMAK";
$config["fileDir"] = "assets/file";
$config["fileDirs"] = "assets/file/";

/* Custom Var */
$pageHeader = '';
$pageContent = '';
$scriptContent = '';
$do = @$hf->sclr($_GET['do']);
$dot = $config['admin']."?do=";
$action = @$hf->sclr($_GET['action']);
$act = "&action=";
$seo = "&seo=";
$userData = array();
$configData = array();

/* Fetch User Info */
if(isset($_SESSION['session'])){
	$dbh->where("username", $_SESSION['username']);
	$userInfo = $dbh->getOne("user");
	$userData['username'] = $userInfo['username'];
	$userData['email'] = $userInfo['email'];
	$userData['password'] = $userInfo['password'];
	$userData['resetCode'] = $userInfo['resetCode'];
}
/* Fetch Config Data */
$dbh->where("name", "config");
$configInfo = $dbh->getOne("config");
$configData['name'] = $configInfo['name'];
$configData['title'] = $configInfo['title'];
$configData['description'] = $configInfo['description'];
$configData['footer'] = $configInfo['footer'];
$configData['phone'] = $configInfo['phone'];
$configData['email'] = $configInfo['email'];
$configData['address'] = $configInfo['address'];
$configData['bannerTitle'] = $configInfo['bannerTitle'];
$configData['bannerParagraph'] = $configInfo['bannerParagraph'];
$configData['bannerBtnText'] = $configInfo['bannerBtnText'];
$configData['bannerBtnAddress'] = $configInfo['bannerBtnAddress'];
$configData['bannerBtnStatus'] = $configInfo['bannerBtnStatus'];

/* SQL Search Implode Function */
function rawWhereFilterColumn($filter, $search_columns)
{
  $search_terms = explode(' ', $filter);
  $search_condition = "";

  for ($i = 0; $i < count($search_terms); $i++) {
    $term = $search_terms[$i];

    for ($j = 0; $j < count($search_columns); $j++) {
      if ($j == 0) $search_condition .= "(";
      $search_field_name = $search_columns[$j];
      $search_condition .= "$search_field_name LIKE '%" . $term . "%'";
      if ($j + 1 < count($search_columns)) $search_condition .= " OR ";
      if ($j + 1 == count($search_columns)) $search_condition .= ")";
    }
    if ($i + 1 < count($search_terms)) $search_condition .= " AND ";
  }
  return $search_condition;
}
?>
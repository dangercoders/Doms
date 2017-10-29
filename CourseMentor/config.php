<?php

error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ob_start();
session_start();

//define('PROJECT_NAME', 'Login System with Google using OAuth PHP and MySQL - www.thesoftwareguy.in');

define('DB_DRIVER', 'mysql');
define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'shubham1_doms');
define('DB_SERVER_PASSWORD', 'PSR3fbN0bs58');
define('DB_DATABASE', 'shubham1_doms');

$dboptions = array(
    PDO::ATTR_PERSISTENT => FALSE,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
try {
  $DB = new PDO(DB_DRIVER . ':host=' . DB_SERVER . ';dbname=' . DB_DATABASE, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, $dboptions);
} catch (Exception $ex) {
  echo $ex->getMessage();
  die;
}

/* make sure the url end with a trailing slash */
define("SITE_URL", "http://shubhamagarwal.co.in/DOMS/CourseMentor/");
/* the page where you will be redirected for authorzation */
define("REDIRECT_URL", SITE_URL."google_login.php");

/* * ***** Google related activities start ** */
define("CLIENT_ID", "69001864462-d0gsjr4aq6d6bpo7aj07ilf6ncgalk6i.apps.googleusercontent.com");
define("CLIENT_SECRET", "sTfSJZ4mel3op0XaiLCSJFL_");

/* permission */
define("SCOPE", 'https://www.googleapis.com/auth/userinfo.email '.
		'https://www.googleapis.com/auth/userinfo.profile' );



/* logout both from google and your site **/
define("LOGOUT_URL", "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=". urlencode(SITE_URL."logout.php"));
/* * ***** Google related activities end ** */
?>
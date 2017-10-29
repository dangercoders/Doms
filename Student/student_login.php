<?php

session_start();	
 ini_set('error_reporting', 0);
ini_set('display_errors', 0);
require_once('includes/header.html');
	//Unset the variables stored in session
if (isset($_SESSION["SESS_RollNo"]) && $_SESSION["SESS_RollNo"] != "") {
  // user already logged in the site
  header('location: student_home.php');
}
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<link type="text/css" href="css/reg_form.css" rel="stylesheet" />
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title>DOMS@StudentLogIn</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<script type="text/javascript" src="reg_formvalid.js"></script>
</head>
<body>

<p><?php echo $message; ?>
<div id="emptyDiv"></div>
<div id="description"></div>
<!--container start-->
<div id="container">
  <div id="container_body">
    <div>
      <h2 class="form_title">Student Log In</h2>
    </div>
    <!--Form  start-->
    <div id="form_name">
      <div class="firstnameorlastname">
       <form name="form" method="post" action="">
       <?php
       if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
			echo '<ul class="err">';
			foreach($_SESSION['ERRMSG_ARR'] as $msg) {
				echo '<li>',$msg,'</li>'; 
				}
			echo '</ul>';
			unset($_SESSION['ERRMSG_ARR']);
			}
       ?>
	  <div>
      <a href="google_login.php"><img src="images/glogin.png" alt=""/></a>
      </div>
      <div>
      <h1>If You Are Not Register Please <a href="std_submit.php">Click Here</a></h1>
      </div>
     </form>
    </div>
    <!--form ends-->
  </div>
</div>
</div>
<!--container ends-->
 </body>
 </html>
<?php

session_start();	
require_once './config.php';
if (isset($_SESSION["SESS_CourseMentorEmail"])) {
  // user already logged in the site
  header('Location: CourseMentor_home.php');
}
   
 ?>
<? require_once('includes/header.html');?>

<html>
<head>
<link type="text/css" href="css/reg_form.css" rel="stylesheet" />

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
      <h2 class="form_title">CourseMentor Log In</h2>
    </div>
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
      <h1>If You Are Not Register Please <a href="CourseMentorReg.php" target="_blank">Click Here</a></h1>
      </div>
     </form>
    </div>
    <!--form ends-->
  </div>
</div>
<!--container ends-->
 </body>
 </html>
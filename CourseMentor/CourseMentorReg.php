<?php 
session_start();
require_once('includes/header.html');
/*** begin our session ***/
if(isset($_POST['btn-signup']))
{
require 'db_info.php';
  /*$dbh = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/
    
$con=mysqli_connect("localhost","$username","$password","$database");
  
$FirstName =mysqli_real_escape_string ($con, $_POST['FirstName']);
$FirstName=trim($FirstName);
$FirstName=ucfirst($FirstName);
$LastName = mysqli_real_escape_string($con, $_POST['LastName']);
$LastName=trim($LastName);
$LastName=ucfirst($LastName);

$Email = mysqli_real_escape_string ($con, $_POST['Email']);
//$Password =mysqli_real_escape_string ($con, $_POST['Password']);
//$bday =  mysqli_real_escape_string($con, $_POST['bday']);
$usrtel = mysqli_real_escape_string ($con, $_POST['usrtel']);
$Department = mysqli_real_escape_string ($con, $_POST['Department']);

# Validate First Name #
		// if its not alpha numeric, throw error
		if (!ctype_alpha(str_replace(array("'", "-"), "",$FirstName))) { 
			$errmsg_arr[] = 'Firstname should be alpha numeric characters only';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: std_submit.php");
				exit();
			}
		}
		// if first_name is not 3-20 characters long, throw error
		if (strlen($FirstName) < 3 OR strlen($FirstName) > 20) {
			$errmsg_arr[] = 'First name should be within 3-20 characters long.';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: std_submit.php");
				exit();
			}
		}
 
	# Validate Last Name #
		// if its not alpha numeric, throw error
		if (!ctype_alpha(str_replace(array("'", "-"), "", $LastName))) { 
			$errmsg_arr[] = 'Last name should be alpha characters only.';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: std_submit.php");
				exit();
			}
		}
		// if first_name is not 3-20 characters long, throw error
		if (strlen($LastName) < 3 OR strlen($LastName) > 20) {
			$errmsg_arr[] = 'Last name should be within 3-20 characters long.';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: std_submit.php");
				exit();
			}
		}
 /*
	# Validate Password #
		// if first_name is not 3-20 characters long, throw error
		if (strlen($Password) < 3 OR strlen($Password) > 20) {
			$errmsg_arr[] = 'Password should be within 3-20 characters long.';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: std_submit.php");
				exit();
			}
		}*/
 # Validate Phone #
		// if phone is invalid, throw error
		if (!ctype_digit($usrtel) OR strlen($usrtel) != 10) {
			$errmsg_arr[] = 'Enter a valid phone number.';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: std_submit.php");
				exit();
			}
		}
		
$qry= "SELECT * FROM CourseMentor_data WHERE Email='$Email'";
$result=mysqli_query($con,$qry);
 if (!mysqli_query($con,$qry)) {
  die('Error: ' . mysqli_error($con));
} 
if($result=mysqli_query($con,$qry)) {
                $rowcount=mysqli_num_rows($result);
		if($rowcount > 0) {
		       $errmsg_arr[] = 'You Are Already Register <a href="CourseMentor_login.php" >LogIn</a> ';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: std_submit.php");
				exit();
			}
                               }
                             }  

$FullName=$FirstName." ".$LastName;
  $sql="INSERT INTO CourseMentor_data (FullName, Email, Phone, Department)
  VALUES ('$FullName', '$Email', '$usrtel','$Department')";
 if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
} 
else{ 
		 header("Location: CourseMentor_login.php");
      }
}		 
?>







<html>
<head>
<link type="text/css" href="css/reg_form.css" rel="stylesheet" />
<script typ="text/javascript" src="validation.js" > </script>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
</head>
<body>
<p><?php echo $message; ?>
<div id="emptyDiv"></div>
<div id="description"></div>
<!--container start-->
<div id="container">
  <div id="container_body">
    <div>
      <h2 class="form_title"> CourseMentor Registration</h2>
    </div>
    <!--Form  start-->
    <div id="form_name">
      <div class="firstnameorlastname">
       <form name="form" action="CourseMentorReg.php" onsubmit="return validateForm()" method="post">
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
        
        <input type="text" name="FirstName" value="" placeholder="First Name"  class="input_name" required>
        <input type="text" name="LastName" value="" placeholder="Last Name" class="input_name" >
         
      </div>
	  
      <div id="email_form">
        <input type="email" name="Email" value=""  placeholder="Your Gmail Id" class="input_email" required>
      </div>
             
	  </div >
	  <div id="email_form">
         <input type="tel" name="usrtel" placeholder="Contact No" class="input_ContactNo" required>
      </div>
      
	 <div id="email_form">
        <select name="Department" required>
          <option value="" selected >Department</option>
          <option value="Mechnical">Mechnical</option>
          <option value="Electrical">Electrical</option>
          <option value="Civil">Civil</option>
          <option value="Footwear">Footwear</option>
        </select>
	  </div>
      <!--<div id="Upload_image">
                <input type="file" id="fileinput" accept="image/*" />
                <div id="gallery"></div>
                <script src="gallery.js"></script>
	  </div>	-->		
     <div>
         <!-- <p id="sign_user" onClick="Submit()">Sign Up </p> 
		 <INPUT type="submit" onClick="return validateForm()" value="Submit">-->
		  <input  id="sign_user" type="submit" name="btn-signup">
		<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
      </div>
     </form>
    </div>
    <!--form ends-->
  </div>
</div>
<!--container ends-->
 </body>
 </html>
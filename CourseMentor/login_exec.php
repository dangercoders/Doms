<?php
session_start();
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");

  $errmsg_arr = array();
 
	//Validation error flag
	$errflag = false;
 
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($con, $str);
	}
	
	//Sanitize the POST values
	
 if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: CourseMentor_login.php");
		exit();
	}


  
  $Email =  mysqli_real_escape_string($con, $_POST['Email']);
  //$Password = clean($_POST['Password']);
	$Password =mysqli_real_escape_string ($con, $_POST['Password']);
$qry= "SELECT * FROM CourseMentor_data WHERE Email='$Email' AND Password='$Password'";
$result=mysqli_query($con,$qry);
 if (!mysqli_query($con,$qry)) {
  die('Error: ' . mysqli_error($con));
} 
if($result=mysqli_query($con,$qry)) {
                $rowcount=mysqli_num_rows($result);
		if($rowcount > 0) {
			//Login Successful
			session_regenerate_id();
			$member = mysqli_fetch_assoc($result);
			$_SESSION['SESS_CourseMentorMEMBER_ID'] = $member['mem_id'];
			$_SESSION['SESS_CourseMentorEmail'] = $member['Email'];
			$_SESSION['SESS_CourseMentorFirstName'] = $member['FirstName'];
			$_SESSION['SESS_CourseMentorLastName'] = $member['LastName'];
			 
			session_write_close();
			header("location: CourseMentor_home.php");
			exit();
		}else {	
	             //Login failed
			$errmsg_arr[] = 'user name and password not found';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: CourseMentor_login.php");
				exit();
			}
		}
	}else {
		die("Query failed");
	}
	
	
	
?>
	
	
	
	
	
	
	
	
	
	
	
	
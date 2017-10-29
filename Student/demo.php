<?php
session_start();
$errmsg_arr = array();
 
	//Validation error flag
	$errflag = false;
  require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
$FirstName =mysqli_real_escape_string ($con, $_POST['FirstName']);
$FirstName=trim($FirstName);
$FirstName=ucfirst($FirstName);
echo $FirstName;
$LastName = mysqli_real_escape_string($con, $_POST['LastName']);
$LastName=trim($LastName);
$LastName=ucfirst($LastName);
$RollNo =  mysqli_real_escape_string($con, $_POST['RollNo']);
$Email = mysqli_real_escape_string ($con, $_POST['Email']);
$Gender = mysqli_real_escape_string($con, $_POST['Sex']);
$Year =  mysqli_real_escape_string($con, $_POST['Year']);
$Branch = mysqli_real_escape_string ($con, $_POST['Branch']);
$CourseCode=  mysqli_real_escape_string($con, $_POST['CourseCode']);
$FullName=$FirstName." ".$LastName;
echo $FullName;
echo $CourseCode;
	 $_SESSION['SESS_FullName']=$FullName;
        $_SESSION["SESS_Email"]=$Email;
        $_SESSION['SESS_RollNo']=$RollNo;
        $_SESSION['SESS_Branch']=$Branch;
        $_SESSION['SESS_Year']=$Year;
        $_SESSION['SESS_Gender']=$Gender;
        
?>

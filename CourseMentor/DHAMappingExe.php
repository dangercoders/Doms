<?php
session_start();
if(isset($_POST['DHAMapping']))
{
$errmsg_arr = array();
 
	//Validation error flag
	$errflag = false;
require 'db_info.php';
  /*$dbh = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/
    
$con=mysqli_connect("localhost","$username","$password","$database");
  
$CourseCode1 = filter_var($_POST['CourseCode1'], FILTER_SANITIZE_STRING);
$CourseCode2 = filter_var($_POST['CourseCode2'], FILTER_SANITIZE_STRING); 
$sql2= "INSERT INTO $CourseCode2 SELECT * FROM $CourseCode1 Where questionid NOT IN (SELECT questionid from $CourseCode2)";  
if ($con->query($sql2) === TRUE) {
    $errmsg_arr[] = 'DHAMapping  Successfully';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: DHAMapping.php");
				exit();
			}
    
} else {
    echo "Error4 creating database: " . $con->error;
}
}
?>
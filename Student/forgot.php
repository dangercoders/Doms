<?php 
session_start();

$errmsg_arr = array();
$errflag = false;

/*** begin our session ***/

require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
$deregistrationcode =mysqli_real_escape_string ($con, $_GET['deregistrationcode']);
$sql="SELECT * From deregistruser where deregistrationcode='$deregistrationcode'";
$result = mysqli_query($con, $sql);
 
if (mysqli_num_rows($result) > 0) 
{
while($row = mysqli_fetch_assoc($result)) { 
    // Gather all $row values into local variables 
    $RollNo= $row["RollNo"];  
    $sql = "DELETE FROM deregistruser WHERE deregistrationcode= '$deregistrationcode'";
         $query = mysqli_query($con, $sql);
    $sql1 = "DELETE FROM student_data WHERE RollNo= '$RollNo'";
         $query1 = mysqli_query($con, $sql1);     
         
         $errmsg_arr[] = 'You Have Successfully Deregister ';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: DailyHomeAssingment.php");
				exit();
			}
                               }

         
    }
  
  else{
  $errmsg_arr[] = 'Your Registration Link Has Been Expired';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: deregister.php");
				exit();
			}
  }  
  
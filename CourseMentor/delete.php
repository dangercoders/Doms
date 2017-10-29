<?php
session_start();
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
$CourseCode=$_SESSION['SESS_CourseCode'];
$AssNo=$_SESSION['SESS_AssNo']; 
//$questionid='2'; 
$questionid= mysqli_real_escape_string($con, $_POST['questionid']);

   
// Query For Delete dhaquestion image  from folder if any 
  $sql="SELECT Image FROM $CourseCode WHERE questionid= '$questionid'";
         $query = mysqli_query($con, $sql); 
         $row = mysqli_fetch_array($query);
         $File=$row["Image"];
         if($File!=NULL){
         unlink("../Student/dhauploads/$File");
         }
         $sql = "DELETE FROM $CourseCode WHERE questionid= '$questionid'";
         $query = mysqli_query($con, $sql);

?>
 
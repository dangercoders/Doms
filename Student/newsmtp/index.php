<?php

require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
 
$sql = "SELECT Email,FullName FROM CourseMentor_data";
$query = mysqli_query($con, $sql) or die (mysqli_error()); 
if (!mysqli_query($con,$sql)) {
  die('Error1: ' . mysqli_error($con));
             }
$Email=array();
$FullName=array();
while ($row = mysqli_fetch_assoc($query)) {  
    // Gather all $row values into local variables 
    $Email[]= $row["Email"];  
    $FullName[]= $row["FullName"];
    }
    $Email=array_filter($Email);
    $FullName=array_filter($FullName);
    for($i=0;$i<count($Email);$i++){


$to="shiksha000@gmail.com";
$from="dangercoders@gmail.com";
$subject = "WelCome ";
$message = "Dear $FullName[$i], 
echo $Email[$i];

 


Thanks
 
";
include('smtpwork.php');
}
?>
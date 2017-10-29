<?php
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
date_default_timezone_set("Asia/Kolkata");
$current_date= date("Y/m/d");
$current_time= date("H:i:s");

$sql = "SELECT * FROM ActiveDHA WHERE Date='$current_date' AND Year='4'";
$query = mysqli_query($con, $sql) or die (mysqli_error()); 
if (!mysqli_query($con,$sql)) {
  die('Error1: ' . mysqli_error($con));
             }
$CourseCodeArray=array();
while ($row = mysqli_fetch_assoc($query)) {  
    // Gather all $row values into local variables 
    $CourseCodeArray[]= $row["CourseCode"];  
    }
    $CourseCodeArray=array_filter($CourseCodeArray);
    for($i=0;$i<count($CourseCodeArray);$i++){
    $sql1 = "SELECT * FROM ActiveDHA WHERE CourseCode='$CourseCodeArray[$i]'";
    $query1 = mysqli_query($con, $sql1) or die (mysqli_error()); 
    if (!mysqli_query($con,$sql1)) {
  die('Error2: ' . mysqli_error($con));
             }
    echo $CourseCodeArray[$i];
    while ($secondrow = mysqli_fetch_assoc($query1)) {
                $Date= $secondrow ["Date"];  
                $Time= $secondrow ["Time"]; 
                $Interval= $secondrow ["Interval"];
                echo $Interval;
                $AssNodb= $secondrow ["AssNo"];  
                $numbers = preg_replace('/[^0-9]/', '', $AssNodb);
                $letters = preg_replace('/[^a-zA-Z]/', '', $AssNodb);
                $numbers= $numbers+1;
                $AssNo=$letters."".$numbers;
                $AssDate= date('Y-m-d', strtotime($Date. ' +'. $Interval .'days'));
                         $sql2 = "UPDATE ActiveDHA SET Date = '$AssDate', AssNo='$AssNo' WHERE CourseCode='$CourseCodeArray[$i]'";
                      if (!mysqli_query($con,$sql2)) {
  die('Error: ' . mysqli_error($con));
             }
                               }
                              // mysqli_free_result($query1);
                       } 
if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
             }
?>
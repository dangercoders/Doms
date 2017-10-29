<?php
session_start();
require 'db_info.php';
require 'fusioncharts.php';
 ini_set('error_reporting', 0);
ini_set('display_errors', 0);
$con=mysqli_connect("localhost","$username","$password","$database");
$Rollno=$_SESSION['SESS_RollNo'];
if(!isset($Rollno)){
//mysql_close($con); // Closing Connection
header('Location: student_login.php'); // Redirecting To Home Page
}
else {
$sql1 = "SELECT * FROM student_data WHERE RollNo='$Rollno'";
$query = mysqli_query($con, $sql1) or die (mysqli_error()); 
while ($row = mysqli_fetch_array($query)) {  
    // Gather all $row values into local variables 
    $RollNo = $row["RollNo"];  
    $FullName = $row["FullName"];  
    $Branch=  $row["Branch"];
    $Year=$row["Year"];
} 
}
?>
<? require_once('includes/header.html');?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
    table { 
color: #333;
font-family: Helvetica, Arial, sans-serif;
width: 100%; 
border-collapse: 
collapse; border-spacing: 0; 
}

td, th { 
border: 1px solid black; /* No more visible border */
height: 30px; 

transition: all 0.3s;  /* Simple transition for hover effect */
}

th {
background: #DFDFDF;  /* Darken header a bit */
font-weight: bold;
}

td {
background: #FAFAFA;
text-align: center;
}

/* Cells in even rows (2,4,6...) are one color */ 
tr:nth-child(even) td { background: #F1F1F1; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */ 
tr:nth-child(odd) td { background: #FEFEFE; }  

tr td:hover { background: #666; color: #FFF; } /* Hover cell effect! */

body {
  background: #43A047 ;
 
} 

</style>


<title>DEI Online Notice Board</title>

<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<div id="body">
	<table width="80%" border="1">
    <tr>
    <!--<th colspan="4">your Current Notice <label></label></th>-->
    </tr>
    <tr>
    <td><h1>Notice Title</h1></td>
    <td><h1>Mentor Name</h1></td>
    <td><h1>Notice Time</h1></td>
    <td><h1>View<h1></td>
    </tr>
    <?php
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");

//$sql = "SELECT * FROM student_data WHERE RollNo='$Rollno'";
	$sql="SELECT * FROM NoticeBoard Where (Department='$Branch' OR Department='ALL') AND (Year='$Year' OR Year='ALL')";
	$result_set=mysqli_query($con, $sql);
	while($row=mysqli_fetch_array($result_set))
	{
		?>
        <tr>
        <td><?php echo $row['Title'] ?></td>
        <td><?php echo $row['Name'] ?></td>
        <td><?php echo $row['TimeStamp'] ?></td>
        <td><a href="uploads/<?php echo $row['File'] ?>" target="_blank">view file</a></td>
        </tr>
        <?php
	}
	?>
    </table>
    
</div>
</body>
</html>
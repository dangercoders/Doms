<?php
session_start();
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
$CourseMentorEmail=$_SESSION['SESS_CourseMentorEmail'];
if(!isset($CourseMentorEmail)){
//mysql_close($con); // Closing Connection
header('Location: CourseMentor_login.php'); // Redirecting To Home Page
}
else {
$sql = "SELECT * FROM CourseMentor_data WHERE Email='$CourseMentorEmail'";
$query = mysqli_query($con, $sql) or die (mysqli_error()); 
while ($row = mysqli_fetch_array($query)) {  
    // Gather all $row values into local variables 
    $CourseMentorEmail = $row["Email"];  
    $FullName = $row["FullName"];  
    $_SESSION['SESS_CourseMentorFullName']=$FullName;
     
} 
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<link type="text/css" href="default.css" rel="stylesheet" />
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title>DOMS@CourseMentorHome</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<script type="text/javascript" src="reg_formvalid.js"></script>
</head>
<body>

<div id="upbg"></div>

<div id="outer">


	<div id="header">
		<div id="headercontent">
			<img src='images/engineeringLogo.png' style="border:1px solid rgb(50,50,50)">
			 
		</div>
	</div>


	<form method="post" action="">
		<div id="search">
			<input type="text" class="text" maxlength="64" name="keywords" />
			<input type="submit" class="submit" value="Search" />
		</div>
	</form>


	<div id="headerpic"></div>

	
	<div id="menu">
		<!-- HINT: Set the class of any menu link below to "active" to make it appear active -->
		<ul>
			<li><a href="index.html" class="active">Home</a></li>
			<li><a href="AddCourse.php">AddCourse</a></li>
			<li><a href="AddQuiz.php">AddQuiz</a></li>
			<li><a href="../Student/index.php">Announcement</a></li>
			<li><a href="Progress.php">Progress</a></li>
			<li><a href="Excel_Report.php">Result</a></li>
			<li><a href="DHASchedule.php">DHASchedule</a></li>
			<li><a href="CourseMentor_logout.php">LogOut</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>
	<div>
	<h3 align="center">Welcome <?php echo $FullName ?> </h3>
	</div>
  
<div id="footer">
			<div class="left"></div>
			<div class="right">Design by <a href="http://www.nodethirtythree.com/">Abhishek & shubham</a></div>
	</div>
 </body>
 </html>
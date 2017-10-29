<?php
session_start();
require 'db_info.php';
require 'fusioncharts.php';

$con=mysqli_connect("localhost","$username","$password","$database");
$Rollno=$_SESSION['SESS_RollNo'];
if(!isset($Rollno)){
//mysql_close($con); // Closing Connection
header('Location: student_login.php'); // Redirecting To Home Page
}
else {
$sql = "SELECT * FROM student_data WHERE RollNo='$Rollno'";
$query = mysqli_query($con, $sql) or die (mysqli_error()); 
while ($row = mysqli_fetch_array($query)) {  
    // Gather all $row values into local variables 
    $RollNo = $row["RollNo"];  
    $FullName = $row["FullName"];
    $Year= $row["Year"];  
    $Branch= $row["Branch"];
     
      
} 
}
?>

<? require_once('includes/header.html');?>

 <html>
<head>
<link type="text/css" href="css/reg_form.css" rel="stylesheet" />
<title>@DOMS Progress Graph</title>
<script type="text/javascript" src="reg_formvalid.js"></script>
</head>
<body>
<p><?php echo $message; ?>
<div id="emptyDiv"></div>
<div id="description"></div>
<!--container start-->
<div id="container">
  <div id="container_body">
    <div>
      <h2 class="form_title">Progress</h2>
    </div>
    <!--Form  start-->
    <div id="form_name">
      <div class="firstnameorlastname">
       <form name="form" method="post" action="Progressgraph.php">
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
	  <div id="email_form">
        <?php
                        require 'db_info.php'; 
                       $con=mysqli_connect("localhost","$username","$password","$database");
                     // $var='CourseTable';
                     // $CourseTable=$var."_".$Department;
                        
                      $sql="SELECT CourseCode FROM CourseTable Where Year='$Year' AND Department='$Branch'"; 
                             if (!mysqli_query($con,$sql)) {
                      die('Error: ' . mysqli_error($con));
                         }
                     echo "<select name=CourseCode value=''>CourseCode</option>"; // list box select command

                    foreach ($con->query($sql) as $row){//Array or records stored in $row
                    echo $row[CourseCode];
                     echo "<option value=$row[CourseCode]>$row[CourseCode]</option>"; 

                     }
echo "</select>";// Closing of list box
?>      </div>
	 
     <div>
         
		<input  id="sign_user" type="submit" name="Progress" value="Check Progress">
		 
      </div>
     </form>
    </div>
    <!--form ends-->
  </div>
</div>
<!--container ends-->
 </body>
 </html>
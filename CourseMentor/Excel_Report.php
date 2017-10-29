<?php
session_start();
require 'db_info.php';
$FullName=$_SESSION['SESS_CourseMentorFullName'];
?>
   
<? require_once('includes/header.html'); ?>
 <html>
<head>
<link type="text/css" href="css/reg_form.css" rel="stylesheet" />
<title>@DOMS Get Report</title>
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
      <h2 class="form_title">Get Result</h2>
    </div>
    <!--Form  start-->
    <div id="form_name">
      <div class="firstnameorlastname">
       <form name="form" method="post" action="Result.php">
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
                      //$var='CourseTable';
                     // $CourseTable=$var."_".$Department;
                      $sql="SELECT CourseCode, CourseName FROM CourseTable Where CourseMentor='$FullName'"; 
                             if (!mysqli_query($con,$sql)) {
                      die('Error: ' . mysqli_error($con));
                         }
                     echo "<select name=CourseCode value=''>CourseCode</option>"; // list box select command

                    foreach ($con->query($sql) as $row){//Array or records stored in $row
                     echo "<option value=$row[CourseCode]>$row[CourseCode] $row[CourseName]</option>"; 

                     }
echo "</select>";// Closing of list box
?>      </div>
	 
     <div>
        <!--<p id="sign_user" onClick="Submit()">Sign Up </p> -->
		<input  id="sign_user" type="submit" name="GetResult">
		<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
      </div>
     </form>
    </div>
    <!--form ends-->
  </div>
</div>
<!--container ends-->
 </body>
 </html>
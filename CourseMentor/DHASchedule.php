<?php
session_start();
require 'db_info.php';
$errmsg_arr = array();
$errflag = false;

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
    $Department= $row["Department"];  
} 
}

?>
<? require_once('includes/header.html'); ?>
<html>
<head>

 <link type="text/css" href="css/reg_form.css" rel="stylesheet" />
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<!--Load Script and Stylesheet -->
 <script type="text/javascript" src="js/jquery.simple-dtpicker.js"></script>
 <link type="text/css" href="css/jquery.simple-dtpicker.css" rel="stylesheet" />
 <script type="text/javascript">
			$(function(){
			 	// -- append by class just for lower strings count --
				$('.dtpicker').appendDtpicker({"minuteInterval": 15, "calendarMouseScroll": false, "futureOnly": true, "autodateOnStart": false});

				$('#startdt').change(function() {
				     $('#enddt').handleDtpicker('setMinDate', $('#startdt').val()); //set end datetime not lower then start datetime
				});
			});
		</script>
		
 
<title>@DOMS DHA Schedule</title>
    
</head>
<body>
 
<div id="emptyDiv"></div>
<div id="description"></div>
<!--container start-->
<div id="container">
  <div id="container_body">
    <div>
      <h2 class="form_title"> DHA Scheduling</h2>
    </div>

<div id="form_name">
      <div class="firstnameorlastname">
       <form name="form" action="DHAScheduleEXE.php" onsubmit="return validateForm()" method="post">
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
        
        <?php
                  require 'db_info.php'; 
                  $con=mysqli_connect("localhost","$username","$password","$database");
                  //$var='CourseTable';
                   
                  //$CourseTable=$var. "_" .$Department;                      
                  $sql="SELECT CourseCode,CourseName FROM CourseTable Where CourseMentor='$FullName'"; 
                 mysqli_query($con, $sql);
                  
                 echo "<select name=CourseCode value=''>CourseCode</option>"; // list box select command

                 foreach ($con->query($sql) as $row){//Array or records stored in $row
                 echo "<option value=$row[CourseCode]>$row[CourseCode]  $row[CourseName]</option>"; 

                                  }
                echo "</select>";// Closing of list box
                     ?>
         </div><br>
         
         <div id="RollNo_form">
        
        <?php
        require 'db_info.php'; 
        $con=mysqli_connect("localhost","$username","$password","$database");
        $sql="SELECT AssNo FROM AssTable"; 
        if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
         }
          echo "<select name=AssNo id=AssNo value=''>AssNo </option>"; // list box select command

         foreach ($con->query($sql) as $row){//Array or records stored in $row
               echo "<option value=$row[AssNo]>$row[AssNo]</option>"; 

             }
             echo "</select>";// Closing of list box
?>
        
      </div>  
	  
	   
                        <div id="dateTimeInput">
         
        </div>
<div id="email_form">
         <input type="text" class="dtpicker" name="startdt" id="startdt" placeholder="DHA Start Time" required>
      </div>
      
      <div id="email_form">
         <input type="text" class="dtpicker" name="enddt" id="enddt" placeholder="DHA End Time" required>
      </div>
      
<div id="email_form">
        <input type="text" name="Interval" value=""  placeholder="DHA Time Interval" class="input_email" required>
      </div>
<div>
          
		  <input  id="sign_user" type="submit" name="ScheduleDHA" value="ScheduleDHA">
		 
      </div>
     </form>
    </div>
    <!--form ends-->
  </div>
</div>
<!--container ends-->
 </body>
 </html>         
         
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
    
    $Department = $row["Department"]; 
    
} 
} 
 ?>



<?  require_once('includes/header.html');?>
<html>
<head>
<link type="text/css" href="css/reg_form.css" rel="stylesheet" />
<title>@DOMS DHA Mapping</title>
     
    
</head>
<body>
<p><?php echo $message; ?>
<div id="emptyDiv"></div>
<div id="description"></div>
<!--container start-->
<div id="container">
  <div id="container_body">
    <div>
      <h2 class="form_title">DHA Mapping</h2>
    </div>
    <!--Form  start-->
    <div id="form_name">
      <div class="firstnameorlastname">
       <form name="form" action="DHAMappingExe.php" method="post">
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
                  $var='CourseTable';
                  
                  //$CourseTable=$var. "_" .$Department; 
                   
                  $sql="SELECT CourseCode,CourseName FROM CourseTable Where CourseMentor='$FullName'"; 
                  if (!mysqli_query($con,$sql)) {
                           die('Error: ' . mysqli_error($con));
                       }
                 echo "<select name=CourseCode1 value=''>CourseName</option>"; // list box select command

                 foreach ($con->query($sql) as $row){//Array or records stored in $row
                 echo "<option value=$row[CourseCode]>$row[CourseCode]    $row[CourseName]</option>"; 

                                  }
                echo "</select>";// Closing of list box
                     ?>
         </div><br>
	 
<div id="RollNo_form">
        
        <?php
        require 'db_info.php'; 
        $con=mysqli_connect("localhost","$username","$password","$database");
         $sql="SELECT CourseCode,CourseName FROM CourseTable ORDER BY Year, Department"; 
        if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
              }
        echo "<select name=CourseCode2 value=''>CourseCode2</option>"; // list box select command

         foreach ($con->query($sql) as $row){//Array or records stored in $row
               echo "<option value=$row[CourseCode]>$row[CourseCode]    $row[CourseName]</option>"; 

             }
             echo "</select>";// Closing of list box
?>
        
      </div>  
	  
     <div>
          
		  <input  id="sign_user" type="submit" name="DHAMapping" value="DHAMapping">
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
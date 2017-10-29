<?php
session_start();
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
$CourseMentorEmail=$_SESSION['SESS_CourseMentorEmail'];
$CourseCode=$_SESSION['SESS_CourseCode'];
if(isset($CourseCode)){
                  unset($_SESSION['SESS_AssNo']);
                  unset($_SESSION['SESS_CourseCode']);
                  }
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
<? require_once('includes/header.html'); ?>
<html>
<head>
<link type="text/css" href="css/reg_form.css" rel="stylesheet" />
<script type="text/javascript" src="reg_formvalid.js"></script>
<script type="text/javascript">
$(document).ready(function(){
                    $('#AssNo').change(function(){
                    window.location = "http://www.shubhamagarwal.co.in/DOMS/CourseMentor/editdha.php";
                  //  $(location).attr('href', 'http://shubhamagarwal.co.in/DOMS/CourseMentor/editdha.php')
                    });
               });
 
</script>
</head>
<body>
<p><?php echo $message; ?>
<div id="emptyDiv"></div>
<div id="description"></div>
<!--container start-->
<div id="container">
  <div id="container_body">
    <div>
      <h2 class="form_title">Select Course & Assignment</h2>
    </div>
    <!--Form  start-->
    <div id="form_name">
       
       <form name="form" method="post" action="editdha.php">
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
        
	  <div id="RollNo_form">
        
        <?php
        require 'db_info.php'; 
        //$CourseTable='CourseTable';
        //$TableName= $CourseTable. "_" .$Branch;
        
        $con=mysqli_connect("localhost","$username","$password","$database");
        $sql="SELECT CourseCode,CourseName FROM CourseTable WHERE CourseMentor='$FullName'"; 
        if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
         }
          echo "<select name=CourseCode value=''>CourseCode</option>"; // list box select command

         foreach ($con->query($sql) as $row){//Array or records stored in $row
               echo "<option value=$row[CourseCode]>$row[CourseCode]   $row[CourseName]</option>"; 

             }
             echo "</select>";// Closing of list box
?>
        
      </div>
	  <br>
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
       
       <div>
          
		  <input  id="sign_user" type="submit" name="btn-signup">
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
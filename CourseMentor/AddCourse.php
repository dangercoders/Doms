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
} 
}
$Specialization='Specialization';
$Branch='Branch';
?>
<? require_once('includes/header.html');?>
<!DOCTYPE html>
<html>
<head>
<link type="text/css" href="css/reg_form.css" rel="stylesheet" />
<script typ="text/javascript" src="validation.js" > </script>
<title>@DOMS AddCourse</title>
    
</head>
<body>
<p><?php echo $message; ?>
<div id="emptyDiv"></div>
<div id="description"></div>
<!--container start-->
<div id="container">
  <div id="container_body">
    <div>
      <h2 class="form_title">Add Course</h2>
    </div>
    <!--Form  start-->
    <form name="AddCourse" action="AddCourse_exec.php" method="post">  
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
    <div id="CourseCode_form">
        <input type="text" name="CourseCode" value=""  placeholder="CourseCode" class="CourseCode" required>
      </div>
    <div id="CourseName_form">
        <input type="text" name="CourseName" value=""  placeholder="CourseName" class="CourseName" required>
      </div>

	  <div id="Year">
              <input type="number" name="Year" min="1" max="4" step="1" placeholder="Year" class="input_Year" required>
      </div>
      <div id="Year">
              <input type="number" name="Credit" min="1" max="8" step="1" placeholder="Credit" class="input_Year" required>
      </div>
      
      <div id="RollNo_form">
        
        <?php
        require 'db_info.php';         
        $con=mysqli_connect("localhost","$username","$password","$database");
        $sql="SELECT BranchId,Branch FROM Branch"; 
        if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
         }
          echo "<select name='Branch'><option value='$BranchId'>".$Branch."</option>"; // list box select command

         foreach ($con->query($sql) as $row){//Array or records stored in $row
               echo "<option value=$row[BranchId]>$row[Branch]</option>"; 

             }
             echo "</select>";// Closing of list box
?>
        
      </div>
      <br>
      <div id="RollNo_form">
        
        <?php
        require 'db_info.php';         
        $con=mysqli_connect("localhost","$username","$password","$database");
        $sql="SELECT SpecializationId,Specialization FROM specialization"; 
        if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
         }
          echo "<select name='Specialization'><option value='$SpecializationId'>".$Specialization."</option>";
          
         foreach ($con->query($sql) as $row){//Array or records stored in $row
               echo "<option value=$row[SpecializationId]>$row[Specialization]</option>"; 

             }
             echo "</select>";// Closing of list box
?>
        
      </div>
      <div><p>Select Specialization as <b>None</b> for <b>First</b> & <b>Second</b> Year Course</p></div>
      
 <!--     
	 <div>
        <select name="Branch" required>
          <option value="" selected >Branch</option>
          <option value="Mechnical">Mechnical</option>
          <option value="Electrical">Electrical</option>
          <option value="Civil">Civil</option>
          <option value="Footwear">Footwear</option>
          <option value="SectionA">SectionA</option>
          <option value="SectionB">SectionB</option>
          <option value="SectionC">SectionC</option>
          <option value="SectionD">SectionD</option>

        </select>
	  </div> -->
	  
      <!--<div id="Upload_image">
                <input type="file" id="fileinput" accept="image/*" />
                <div id="gallery"></div>
                <script src="gallery.js"></script>
	  </div>	-->		
     <div>
         <input  id="sign_user" type="submit" name="btn-signup" value="Add">
      </div>
     </form>
    </div>
    <!--form ends-->
  </div>
</div>
<!--container ends-->
 </body>
 </html>
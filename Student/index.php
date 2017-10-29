<?php
session_start();
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
$CourseMentorEmail=$_SESSION['SESS_CourseMentorEmail'];
if(!isset($CourseMentorEmail)){
//mysql_close($con); // Closing Connection
header('Location: ../CourseMentor/CourseMentor_login.php'); // Redirecting To Home Page
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
?>
<? require_once('includes/header1.html'); ?>

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
      <h2 class="form_title">Notice Board</h2>
    </div>
	<form action="upload.php" method="post" enctype="multipart/form-data">
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

	<div id="Title_form">
         <textarea rows="4" cols="50" name="Title" value=""  placeholder="Title/Message" class="Title" required></textarea>
      </div>
	
	<div>
        <select name="Department" required>
          <option value="" selected >Department</option>
          <option value="Mechnical">Mechnical</option>
          <option value="Electrical">Electrical</option>
          <option value="Civil">Civil</option>
          <option value="Footwear">Footwear</option>
          <option value="ALL">ALL</option>
        </select>
	  </div><br>
	  
	<div>
        <select name="Year" required>
          <option value="" selected >Year</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="ALL">ALL</option>
        </select>
	  </div><br>
	  
       
	  <div id="Upload_file">
                 <input type="file" name="file" id="fileinput" value='choose File'/>
           </div>
     
     <div>
          
		  <input  id="sign_user" type="submit" name="Upload" value="Upload">
      </div>
	</form>
	</div>
	</div>
	
    <br /><br />
    <?php
	if(isset($_GET['success']))
	{
		?>
        <label>File Uploaded Successfully...  <a href="view.php">click here to view file.</a></label>
        <?php
	}
	else if(isset($_GET['fail']))
	{
		?>
        <label>Problem While File Uploading !</label>
        <?php
	}
	else
	{
		?>
        <label>Try to upload any files(PDF, DOC, EXE, VIDEO, MP3, ZIP,etc...)</label>
        <?php
	}
	?>
</div>
<div id="footer">
<!--<label>By <a href="http://cleartuts.blogspot.com">cleartuts.blogspot.com</a></label>-->
</div>
</body>
</html>
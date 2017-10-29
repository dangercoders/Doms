<?php
session_start();
require 'db_info.php';
 ini_set('error_reporting', 0);
ini_set('display_errors', 0);
$con=mysqli_connect("localhost","$username","$password","$database");
$Rollno=$_SESSION['SESS_RollNo'];
if(!isset($Rollno)){
//mysql_close($con); // Closing Connection
header('Location: ../Student/student_login.php'); // Redirecting To Home Page
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
<html>
<head>
<link type="text/css" href="css/reg_form.css" rel="stylesheet" />
<script typ="text/javascript" src="validation.js" > </script>
<title>@DOMS AddCourse</title>
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

  

</style>
    </head>
       <body>
<p><?php echo $message; ?>
<!--container start-->
<div id="container">
  <div id="container_body">
    <div>
      <h2 class="form_title">Upload Resume</h2>
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
	  <div id="Upload_file">
                 <input type="file" name="file" id="fileinput" value='choose File'/>
           </div>
     
     <div>
          
		  <input  id="sign_user" type="submit" name="Upload" value="Upload">
		  <label>Try to upload files(PDF, DOC)</label>
      </div>
	</form>
	</div>
	</div>
	
    <br /><br />
     <?php
      if(isset($_GET['fail']))
	{
		?>
        <label>Problem While File Uploading !</label>
        <?php
	}
	 ?>
</div>
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
<div id="footer">
<!--<label>By <a href="http://cleartuts.blogspot.com">cleartuts.blogspot.com</a></label>-->
</div>
</body>
</html>
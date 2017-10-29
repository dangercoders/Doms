<?php
session_start();
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
if(isset($_POST['Upload']))
{    
     $Title=mysqli_real_escape_string ($con, $_POST['Title']);
     $Department=mysqli_real_escape_string ($con, $_POST['Department']);
     $year=mysqli_real_escape_string ($con, $_POST['Year']);
     $FullName=$_SESSION['SESS_CourseMentorFullName'];
     $File=$_FILES['file']['name'];
     if($File){
	$file = rand(1000,100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];
	$file_type = $_FILES['file']['type'];
	//$folder="uploads/";
	$folder="../Student/uploads/";
	
	// new file size in KB
	$new_size = $file_size/1024;  
	// new file size in KB
	
	// make file name in lower case
	$new_file_name = strtolower($file);
	// make file name in lower case
	
	$final_file=str_replace(' ','-',$new_file_name);
	//move_uploaded_file($file_loc,$folder2.$final_file);
	if(move_uploaded_file($file_loc,$folder.$final_file))
	{
	
		$sql="INSERT INTO NoticeBoard(file,Name,Department,Year,Title) VALUES('$final_file','$FullName','$Department','$year','$Title')";
		mysqli_query($con, $sql);
		/*if ($con->query($sql) === TRUE) {
                echo "New record created successfully";
     } 
     else {
     
        echo "Error: " . $sql . "<br>" . $con->error;
      }
*/
		?>
     <script>	
        window.location.href='index.php';
        </script>
		<?php
	}
	else
	{
		?>
		<script>
		
		alert('error while uploading file');
        window.location.href='index.php?fail';
        </script>
		<?php
	}
}
else{
                    $sql="INSERT INTO NoticeBoard(Name,Department,Year,Title) VALUES('$FullName','$Department','$year','$Title')";
		mysqli_query($con, $sql);
		if ($con->query($sql) === TRUE) {
                echo "New record created successfully";
                header('Location: index.php');
     } 
     else {
     
        echo "Error: " . $sql . "<br>" . $con->error;
      }
		
		
  }
  }
?>
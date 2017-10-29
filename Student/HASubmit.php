<?php
session_start();
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
     
                $FullName= $_SESSION['SESS_FullName'];
                $RollNo= $_SESSION['SESS_RollNo'];
                $Email= $_SESSION['SESS_Email'];
                $Branch= $_SESSION['SESS_Branch'];
                $Year= $_SESSION['SESS_Year'];
                $Gender= $_SESSION['SESS_Gender'];
                $CourseCode=  mysqli_real_escape_string($con, $_POST['CourseCode']);
                $QNumber=  mysqli_real_escape_string($con, $_POST['QNo']);
                $HANo  = mysqli_real_escape_string ($con, $_POST['HANo']);
                $_SESSION['SESS_CourseCode'] = $CourseCode;
                $_SESSION['SESS_HANo '] = $HANo ;
                $pieces = explode(" ", $FullName);
                $FirstName= $pieces[0]; // piece1
                $LastName=$pieces[1]; // piece2
                
     $Title=mysqli_real_escape_string ($con, $_POST['Title']);
     $File=$_FILES['file']['name'];
	$file = $RollNo."-".$HANo."-".$QNumber;
    $file_loc = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];
	$file_type = $_FILES['file']['type'];
	//$folder="uploads/";
	$folder="../CourseMentor/$CourseCode/";
	
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
	         $errmsg_arr[] = 'HA Successfully Submited !!';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: HomeAssingment.php");
				exit();
			}
		 
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
?>
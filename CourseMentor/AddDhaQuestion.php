<?php
session_start();
$CourseCode=$_SESSION['SESS_CourseCode'];
$AssNo=$_SESSION['SESS_AssNo'];
// include to get database connection
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
 
 $question=mysqli_real_escape_string ($con, $_POST['question']);
     $wrong_answer1=mysqli_real_escape_string ($con, $_POST['choice1']);
     $wrong_answer1=trim($wrong_answer1);
     $wrong_answer2=mysqli_real_escape_string ($con, $_POST['choice2']);
     $wrong_answer2=trim($wrong_answer2);
     $wrong_answer3=mysqli_real_escape_string ($con, $_POST['choice3']);
     $wrong_answer3=trim($wrong_answer3);
     $correct_answer=mysqli_real_escape_string ($con, $_POST['answer']);
      
     $File=$_FILES['file']['name'];
       
     if($File){
	$file =rand(1,100)."-".$CourseCode."-".$AssNo;
    $file_loc = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];
	$file_type = $_FILES['file']['type'];
	 
	$folder="../Student/dhauploads/";
	
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
	
	
		$sql="INSERT INTO $CourseCode (questionid, name, choice1, choice2, choice3, answer,Image, AssNo)
                            VALUES ('NULL', '$question', '$wrong_answer1', '$wrong_answer2', '$wrong_answer3', '$correct_answer', '$final_file', '$AssNo')";
		 
		if ($con->query($sql) === TRUE) {
                header('Location: editdha.php');
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				 
				exit();
			}
			  }
		 
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
 
                    $sql="INSERT INTO $CourseCode (questionid, name, choice1, choice2, choice3, answer, AssNo)
                            VALUES ('NULL', '$question', '$wrong_answer1', '$wrong_answer2', '$wrong_answer3', '$correct_answer', '$AssNo')";
		 
		if ($con->query($sql) === TRUE) {
                header('Location: editdha.php');
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				// header('Location: CourseMentor_login.php');
				exit();
			}
     } 
     else {
     
        echo "Error: " . $sql . "<br>" . $con->error;
      }
		
		
  }
  
?> 
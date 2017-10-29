<?php
session_start();
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
     
     $questionid=$_SESSION['SESS_questionid'];
     $CourseCode=$_SESSION['SESS_CourseCode'];
     $AssNo=$_SESSION['SESS_AssNo'];
     $question=mysqli_real_escape_string ($con, $_POST['question']);
     $wrong_answer1=mysqli_real_escape_string ($con, $_POST['choice1']);
     $wrong_answer1=trim($wrong_answer1);
     $wrong_answer2=mysqli_real_escape_string ($con, $_POST['choice2']);
     $wrong_answer2=trim($wrong_answer2);
     $wrong_answer3=mysqli_real_escape_string ($con, $_POST['choice3']);
     $wrong_answer3=trim($wrong_answer3);
     $correct_answer=mysqli_real_escape_string ($con, $_POST['answer']);
     
     $FullName=$_SESSION['SESS_CourseMentorFullName'];
     $File=$_FILES['file']['name'];
             
     if($File){
	
         $sql="SELECT Image FROM $CourseCode WHERE questionid= '$questionid'";
         $query = mysqli_query($con, $sql); 
         $row = mysqli_fetch_array($query);
         $File=$row["Image"];
         if($File!=NULL){
         unlink("../Student/dhauploads/$File");
         }
         $sql = "DELETE FROM $CourseCode WHERE questionid= '$questionid'";
         $query = mysqli_query($con, $sql); 
         $file = $File;
    $file_loc = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];
	$file_type = $_FILES['file']['type'];
	//$folder="uploads/";
	$folder="../Student/dhauploads/";
	
	// new file size in KB
	$new_size = $file_size/1024;  
	// new file size in KB
	
	// make file name in lower case
	$new_file_name = strtolower($file);
	// make file name in lower case
	
	$final_file=str_replace(' ','-',$new_file_name);
	//move_uploaded_file($file_loc,$folder2.$final_file);
	if(move_uploaded_file($file_loc,$folder.$final_file)){
$sql="INSERT INTO $CourseCode (questionid, name, choice1, choice2, choice3, answer,Image, AssNo)
                            VALUES ('$questionid', '$question', '$wrong_answer1', '$wrong_answer2', '$wrong_answer3', '$correct_answer', '$final_file', '$AssNo')"; 
//$sql="UPDATE $CourseCode SET `name`=$question, `choice1`=$wrong_answer1, `choice2`=$wrong_answer2, `choice3`=$wrong_answer2, `answer`=$correct_answer, `Image`=$final_file, //`AssNo`=$AssNo Where `questionid`=$questionid";
		 if ($con->query($sql) === TRUE) {
		 header('Location: editdha.php');
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				 
				exit();
			}

     } 
     else {
    echo "Error updating record: " . $con->error;
           }
         }
     
	
               }
else{

         $sql="SELECT Image FROM $CourseCode WHERE questionid= '$questionid'";
         $query = mysqli_query($con, $sql); 
         $row = mysqli_fetch_array($query);
         $File=$row["Image"];
         $sql1 = "DELETE FROM $CourseCode WHERE questionid= '$questionid'";
         $query1 = mysqli_query($con, $sql1); 
         $sql2="INSERT INTO $CourseCode (questionid, name, choice1, choice2, choice3, answer,Image, AssNo)
                            VALUES ('$questionid', '$question', '$wrong_answer1', '$wrong_answer2', '$wrong_answer3', '$correct_answer', '$File', '$AssNo')";
         
         
          

//$sql=  "UPDATE $CourseCode SET name = $question, choice1=$wrong_answer1, choice2=$wrong_answer2, choice3=$wrong_answer3, answer=$correct_answer, AssNo=$AssNo   WHERE //questionid='$questionid'";
//$sql="UPDATE $CourseCode SET `name`=$question, `choice1`=$wrong_answer1, `choice2`=$wrong_answer2, `choice3`=$wrong_answer2, `answer`=$correct_answer, `Image`=$final_file, //`AssNo`=$AssNo Where `questionid`=$questionid";
		 if ($con->query($sql2) === TRUE) {
		 header('Location: editdha.php');
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				        
				exit();
			}

     } 
     else {
    echo "Error updating record: " . $con->error;
}
  }
          
?>
<?php 
session_start();
 
/*** begin our session ***/
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
  /*$dbh = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/
    $errmsg_arr = array();
 
	//Validation error flag
	$errflag = false;
	
 if(isset($_POST['registeruser']))
{
  
 $FullName= $_SESSION['SESS_FullName'];
 $RollNo= $_SESSION['SESS_RollNo'];
 $Email= $_SESSION['SESS_Email'];
 $Branch= $_SESSION['SESS_Branch'];
 $Year= $_SESSION['SESS_Year'];
 $Gender= $_SESSION['SESS_Gender'];
 }
 if(isset($_POST['unregisteruser']))
{

$FirstName =mysqli_real_escape_string ($con, $_POST['FirstName']);
$FirstName=trim($FirstName);
$FirstName=ucfirst($FirstName);
$LastName = mysqli_real_escape_string($con, $_POST['LastName']);
$LastName=trim($LastName);
$LastName=ucfirst($LastName);
$RollNo =  mysqli_real_escape_string($con, $_POST['RollNo']);
$Email = mysqli_real_escape_string ($con, $_POST['Email']);
$Gender = mysqli_real_escape_string($con, $_POST['Sex']);
$Year =  mysqli_real_escape_string($con, $_POST['Year']);
$Branch = mysqli_real_escape_string ($con, $_POST['BranchId']);
$Securityquestion = mysqli_real_escape_string ($con, $_POST['Securityquestion']);
$Securityanswer = mysqli_real_escape_string ($con, $_POST['Securityanswer']);
$SpecializationId= mysqli_real_escape_string ($con, $_POST['SpecializationId']);
$FullName=$FirstName." ".$LastName;
$_SESSION['SESS_RollNo']=$RollNo;
$_SESSION['SESS_FullName']=$FullName;
}
$CourseCode=  mysqli_real_escape_string($con, $_POST['CourseCode']);
$sql="SELECT AssNo FROM ActiveDHA where CourseCode='$CourseCode'";
 foreach ($con->query($sql) as $row){//Array or records stored in $row
               $AssNo=$row[AssNo]; 
             }
$_SESSION['SESS_CourseCode'] = $CourseCode;
         $_SESSION['SESS_AssNo'] = $AssNo;
$pieces = explode(" ", $FullName);
     $FirstName= $pieces[0]; // piece1
    $LastName=$pieces[1]; // piece2
	# Validate First Name #
		// if its not alpha numeric, throw error
		if (!ctype_alpha(str_replace(array("'", "-"), "",$FirstName))) { 
			$errmsg_arr[] = 'Firstname should be alpha numeric characters only';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				 
				header("location: DailyHomeAssingment.php");
				exit();
			}
		}
		// if first_name is not 3-20 characters long, throw error
		if (strlen($FirstName) < 3 OR strlen($FirstName) > 20) {
		        //$errmsg_arr[] = $FirstName;
			$errmsg_arr[] = 'First name should be within 3-20 characters long.';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: DailyHomeAssingment.php");
				exit();
			}
		}
 
	# Validate Last Name #
		// if its not alpha numeric, throw error
		if (!ctype_alpha(str_replace(array("'", "-"), "", $LastName))) { 
			$errmsg_arr[] = 'Last name should be alpha characters only.';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: DailyHomeAssingment.php");
				exit();
			}
		}
		// if first_name is not 3-20 characters long, throw error
		if (strlen($LastName) < 3 OR strlen($LastName) > 20) {
			$errmsg_arr[] = 'Last name should be within 3-20 characters long.';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: DailyHomeAssingment.php");
				exit();
			}
		}
 /*
	# Validate Password #
		// if first_name is not 3-20 characters long, throw error
		if (strlen($Password) < 3 OR strlen($Password) > 20) {
			$errmsg_arr[] = 'Password should be within 3-20 characters long.';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: std_submit.php");
				exit();
			}
		}
 # Validate Phone #
		// if phone is invalid, throw error
		if (!ctype_digit($usrtel) OR strlen($usrtel) != 10) {
			$errmsg_arr[] = 'Enter a valid phone number.';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: std_submit.php");
				exit();
			}
		}
		
 # Validate SrNo #
		// if phone is invalid, throw error
		if (!ctype_digit($SrNo) OR (strlen($SrNo) < 1 OR strlen($SrNo) > 3)) {
			$errmsg_arr[] = 'Enter a valid Sr Number.';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: std_submit.php");
				exit();
			}
		}
*/
# Validate RollNo #
		// if phone is invalid, throw error
		if (!ctype_digit($RollNo) OR (strlen($RollNo) < 1 OR strlen($RollNo) > 8)) {
			$errmsg_arr[] = 'Enter a valid Roll Number.';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: DailyHomeAssingment.php");
				exit();
			}
		}

        $sql = "SELECT * FROM student_data WHERE RollNo='$RollNo'";
	$result = $con->query($sql);

if ($result->num_rows == 0) {

   //Validate Email From Database
$qry= "SELECT * FROM student_data WHERE Email='$Email'";
$result=mysqli_query($con,$qry);
 if (!mysqli_query($con,$qry)) {
  die('Error: ' . mysqli_error($con));
} 
if($result=mysqli_query($con,$qry)) {
                $rowcount=mysqli_num_rows($result);
		if($rowcount > 0) {
		       $errmsg_arr[] = 'You Are Already Register <a href="student_login.php" >LogIn</a> ';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: DailyHomeAssingment.php");
				exit();
			}
                               }
                             }  
$Branch = str_replace('.', '', $Branch);
$SpecializationId= str_replace('.', '', $SpecializationId);
 $sql="INSERT INTO student_data (FullName, RollNo,Email,Gender,Year, Branch,SpecializationId, Securityquestion, Securityanswer)
  VALUES ('$FullName', '$RollNo', '$Email', '$Gender', '$Year', '$Branch','$SpecializationId', '$Securityquestion', '$Securityanswer')";
 if (!mysqli_query($con,$sql)) {
  echo "Error: " . $sql . "<br>" . $con->error;
 header("Location:DailyHomeAssingment.php");
} 
else{ 

		//unset($_SESSION['SESS_FullName']);
		unset($_SESSION['SESS_Email']);
		unset($_SESSION['SESS_Gender']);
		unset($_SESSION['SESS_Year']);
		unset($_SESSION['SESS_Branch']); 
		//unset($_SESSION["SESS_Securityquestion"]);
		//unset($_SESSION["SESS_Securityanswer"]);
      }
      /*
      if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}*/

                 }
//echo $FullName;
         
         
    header("Location:DHA.php");
                 
?>
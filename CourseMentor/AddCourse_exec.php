<?php
session_start();
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");

$errmsg_arr = array();
 
	//Validation error flag
	$errflag = false;
	
    $CourseCode = filter_var($_POST['CourseCode'], FILTER_SANITIZE_STRING);
    $CourseName = filter_var($_POST['CourseName'], FILTER_SANITIZE_STRING);
    $CourseName=ucwords("$CourseName");
    $Year  = filter_var($_POST['Year'], FILTER_SANITIZE_STRING);
    $Branch = filter_var($_POST['Branch'], FILTER_SANITIZE_STRING);
    $Credit = filter_var($_POST['Credit'], FILTER_SANITIZE_STRING);
    $SpecializationId = filter_var($_POST['Specialization'], FILTER_SANITIZE_STRING);
    $CourseMentorName=$_SESSION['SESS_CourseMentorFirstName']." ".$_SESSION['SESS_CourseMentorLastName'];
     
	 $var='CourseTable';
	 $var2='Result';
     $CourseCode_Result=$CourseCode."_".$var2;
     
 $sql = "CREATE TABLE $CourseCode (questionid INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(200) NOT NULL, choice1 VARCHAR(150) NOT NULL, choice2 VARCHAR(150) NOT NULL, choice3 VARCHAR(150) NOT NULL, answer VARCHAR(150) NOT NULL, Image VARCHAR(100) NOT NULL, AssNo VARCHAR(10) NOT NULL)";
 if ($con->query($sql) === TRUE) {
    
    $sql1= "CREATE TABLE $CourseCode_Result (SrNo INT(10) UNSIGNED, RollNo INT(10) PRIMARY KEY, name VARCHAR(200) NOT NULL, DHA1 INT(50) NOT NULL,DHA2 INT(50) NOT NULL, DHA3 INT(50) NOT NULL, DHA4 INT(50) NOT NULL, DHA5 INT(50) NOT NULL, DHA6 INT(50) NOT NULL, DHA7 INT(50) NOT NULL, DHA8 INT(50) NOT NULL, DHA9 INT(50) NOT NULL, DHA10 INT(50) NOT NULL, DHA11 INT(50) NOT NULL,DHA12 INT(50) NOT NULL, DHA13 INT(50) NOT NULL, DHA14 INT(50) NOT NULL, DHA15 INT(50) NOT NULL, DHA16 INT(50) NOT NULL, DHA17 INT(50) NOT NULL, DHA18 INT(50) NOT NULL, DHA19 INT(50) NOT NULL, DHA20 INT(50) NOT NULL, CA1 INT(50) NOT NULL, CA2 INT(50) NOT NULL, CA3 INT(50) NOT NULL, CA4 INT(50) NOT NULL, CA5 INT(50) NOT NULL, CA6 INT(50) NOT NULL, CA7 INT(50) NOT NULL, CA8 INT(50) NOT NULL, CA9 INT(50) NOT NULL, CA10 INT(50) NOT NULL, CA11 INT(50) NOT NULL, CA12 INT(50) NOT NULL, CA13 INT(50) NOT NULL, CA14 INT(50) NOT NULL, CA15 INT(50) NOT NULL, CA16 INT(50) NOT NULL, CA17 INT(50) NOT NULL, CA18 INT(50) NOT NULL, CA19 INT(50) NOT NULL, CA20 INT(50) NOT NULL, CT1 INT(50) NOT NULL, CT2 INT(50) NOT NULL, HA INT(50) NOT NULL, ATT INT(50) NOT NULL, Total INT(50) NOT NULL)";
       if ($con->query($sql1) === TRUE) {
    $sql2= "INSERT INTO ActiveDHA (CourseCode, Year) VALUES ('$CourseCode', '$Year')";
    if ($con->query($sql2) === TRUE) {
    
    $sql3= "INSERT INTO CourseTable (CourseCode,CourseMentor, CourseName,Year,Department,SpecializationId,Credit) VALUES           ('$CourseCode','$CourseMentorName','$CourseName','$Year','$Branch','$SpecializationId','$Credit')";
    if ($con->query($sql3) === TRUE) {
    $errmsg_arr[] = 'Course successfully Add';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: AddCourse.php");
				exit();
			}
    
} else {
    echo "Error4 creating database: " . $con->error;
}

} else {
    echo "Error3 creating database: " . $con->error;
}

} else {
    echo "Error1 creating database: " . $con->error;
}


} else {
    echo "Error2 creating database: " . $con->error;
}

?>
<?php
 session_start();
if(isset($_POST['ScheduleDHA'])){
require 'db_info.php';
  /*$dbh = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/
    
$con=mysqli_connect("localhost","$username","$password","$database");
  
$CourseCode =mysqli_real_escape_string ($con, $_POST['CourseCode']);
$StartTime= mysqli_real_escape_string($con, $_POST['startdt']);
$EndTime= mysqli_real_escape_string($con, $_POST['enddt']);
$DHATime= mysqli_real_escape_string ($con, $_POST['Interval']);
$Year= mysqli_real_escape_string ($con, $_POST['Year']);
$AssNo= mysqli_real_escape_string ($con, $_POST['AssNo']);

$sql = "UPDATE ActiveDHA SET `DHATime`=$DHATime, StartTime='$StartTime', EndTime='$EndTime', AssNo='$AssNo' WHERE `CourseCode`='$CourseCode'";
 if ($con->query($sql) === TRUE) {
    $errmsg_arr[] = 'DHA Have Been Scheduled!';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header('Location: DHASchedule.php');
				//header("location: DHASchedule.php");
				exit();
			}
} else {
    echo "Error updating record: " . $con->error;
}
  //$sql = "UPDATE ActiveDHA SET Date='$DHASchedule' WHERE CourseCode='$CourseCode' AND Year='$Year'";
  
  

}
?>
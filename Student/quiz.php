<?php
session_start();
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
$Rollno=$_SESSION['SESS_RollNo'];
$CourseCode=$_SESSION['SESS_CourseCode'];
$AssNo=$_SESSION['SESS_AssNo'];
$Rollno=$_SESSION['SESS_RollNo'];
if(!isset($Rollno)){
//mysql_close($con); // Closing Connection
header('Location: DailyHomeAssingment.php'); // Redirecting To Home Page
}
else {

             if(!(isset($CourseCode)&&(isset($AssNo)))){

                    
 
//finally, let's store our posted values in the session variables
                  $CourseCode = $_POST['CourseCode'];
                  $sql="SELECT AssNo FROM ActiveDHA where CourseCode='$CourseCode'";
 foreach ($con->query($sql) as $row){//Array or records stored in $row
               $_SESSION['SESS_AssNo']=$row[AssNo]; 
             }
                 $_SESSION['SESS_CourseCode']=$CourseCode; 
                 $AssNo=$_SESSION['SESS_AssNo'];
                 
        $sql = "SELECT * FROM student_data WHERE RollNo='$Rollno'";
$query = mysqli_query($con, $sql) or die (mysqli_error()); 
while ($row = mysqli_fetch_array($query)) {  
    // Gather all $row values into local variables 
    $RollNo = $row["RollNo"];  
    $FullName = $row["FullName"];  
       
      
}



} 
}
require_once('includes/header.html');
/*
$var2='Result';
$CourseCode_Result=$CourseCode."_".$var2;
$query1 = "select * from $CourseCode_Result WHERE RollNo='$Rollno' AND $AssNo='0'";
              $query_result1 = $con->query($query1);
               if (!mysqli_query($con,$query1)) {
  die('Error2: ' . mysqli_error($con));
} 
              $num_row_returned = $query_result1->num_rows;
              if ($num_row_returned == 0){
                         ?>
                     <h2><?php echo $FullName;?> already completed <?php echo $AssNo ;?> of <?php echo $CourseCode;?> So No Submission Again.</h2>
                     <h2>Please <a href="logout.php" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-log-out"></span> Log out</a> This Session</h2>
                      <?php
                     }?>
        <?php
*/
require 'db_info.php'; 
$con=mysqli_connect("localhost","$username","$password","$database");


//Create a query to fetch all the questions
//$CourseCode =mysqli_real_escape_string ($con, $_POST['CourseCode']);
//$AssNo =mysqli_real_escape_string ($con, $_POST['AssNo']);

 

//$query = "select * from EEM701";
$query = "select * from $CourseCode WHERE AssNo='$AssNo'";
/*if ($con->query($query) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query. "<br>" . $con->error;
}*/
//Run the query
$query_result = $con->query($query);

//Count the number of returned items from the database
$num_questions_returned = $query_result->num_rows;

if ($num_questions_returned < 1){
     
    ?>
                                         <html>
                                            <body>
                                <h2><?php echo $AssNo ;?> of <?php echo $CourseCode;?> Do Not Have Any Question </h2>
                                <h2>Please <a href="logout.php" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-log-out"></span> Back</a> Select Another DHA</h2>
                                       </body>
                                          </html>
    <?php
                  unset($_SESSION['SESS_AssNo']);
                  unset($_SESSION['SESS_CourseCode']);
    exit();}

//Create an array to hold all the returned questions
$questionsArray = array();

//Add all the questions from the result to the questions array
while ($row = $query_result->fetch_assoc()){
    $questionsArray[] = $row;
}

//Create an array of Correct answers
$correctAnswerArray = array();
foreach($questionsArray as  $question){
    $correctAnswerArray[$question['questionid']] = $question['answer'];
}


//Build the questions array from query result
$questions = array();
foreach($questionsArray as $question) {
    $questions[$question['questionid']] = $question['name'];
 }

//Build the choices array from query result
$choices = array();
foreach ($questionsArray as $row) {
     if(($row['choice1']==NULL)&&($row['choice2']==NULL)&&($row['choice3']==NULL)){
     $choices[$row['questionid']] = array($row['answer']);
    }
       
  else{
            $choices[$row['questionid']] = array($row['choice1'], $row['choice2'], $row['choice3'], $row['answer']);
  }
  }
//Build the Images array from query result
$Images = array();
foreach($questionsArray as $question) {
    $Images[$question['questionid']] = $question['Image'];
 }  
  
  
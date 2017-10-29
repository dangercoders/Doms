<?php
session_start();
require_once('includes/functions_list.php');
require_once('quiz.php');
require 'db_info.php';

$con=mysqli_connect("localhost","$username","$password","$database");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
date_default_timezone_set("Asia/Kolkata");
$CourseCode=$_SESSION['SESS_CourseCode'];
$AssNo=$_SESSION['SESS_AssNo'];
//$Year=$_SESSION['SESS_Year'];
$current_date= date("Y/m/d");
$current_time= date("H:i:s");

$sql = "SELECT * FROM ActiveDHA WHERE CourseCode='$CourseCode'";
$query = mysqli_query($con, $sql) or die (mysqli_error()); 
/*if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}*/
while ($row = mysqli_fetch_array($query)) {  
    // Gather all $row values into local variables 
    $Date= $row["Date"];  
    $Time= $row["Time"];
    $Interval= $row["Interval"];
    $AssNodb= $row["AssNo"]; 
     
} 
?>
                         
<? require_once('includes/header.html');?>                        
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><span id="time">00:00:00</span></title>
</head>
<body>

<!--Display form-->
<form class="form-horizontal" role="form" id="quiz_form" method="post" action="view_result.php">
<h1> Timer : <span id="time" style="color:blue; background: inherit;">00:00:00</span> </h1>
    <?php
    $i=1;
    foreach(shuffle_assoc($questions) as $id => $question) {
        echo "<div class=\"form-group\">";
        echo "<h4> $i.$question</h4>"."<ol>";//display the question
        $i=$i+1;
         $Image=$Images[$id];
          if($Image!=NULL){
         echo '<img src="dhauploads/'.$Image.'">';
          }
        //Display multiple choices
        $randomChoices = $choices[$id];
        $randomChoices = shuffle_assoc($randomChoices);
        $count=count($randomChoices, COUNT_RECURSIVE);
         
        foreach ($randomChoices as $key => $values){
        if($count==1){
            echo '<li><input type="text" name="response['.$id.'] id="'.$id.'"/>';
        }
        else{
             if($values!=NULL)
            echo '<li><input type="radio" name="response['.$id.'] id="'.$id.'" value="' .$values.'"/>';?>
            <label for="question-<?php echo($id); ?>"><?php echo($values);?></label></li>
            <?php
            }
        ?>
            
    <?php

        } 
            $_SESSION['i']=$i;
            echo("</ul>");
            echo("</div>");
        }
       ?>
     <button id="submit" name="submit" class="next btn btn-success" type="submit">Finish</button></div>
    <!--<input type="submit" name="submit" class="btn btn-primary" value="submit" />-->
</form>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-48989039-2', 'valokafor.com');
    ga('send', 'pageview');

function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            timer = duration;
            alert("Your Time Is Over Please Submit !!");

            document.getElementById('submit').click();
        }
    }, 1000);
}

window.onload = function () {
    var fiveMinutes = 60 * 20,
        display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
};
</script>
</body>
</html>

 
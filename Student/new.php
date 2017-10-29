<?php
session_start();
require_once('includes/functions_list.php');
require_once('quiz.php');
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
$FullName= $_SESSION['SESS_FullName'];
$AssNo=$_SESSION['SESS_AssNo'];
$CourseCode=$_SESSION['SESS_CourseCode'];
$Rollno=$_SESSION['SESS_RollNo'];
$var2='Result';
$CourseCode_Result=$CourseCode."_".$var2;
 
        
         $query = "select * from $CourseCode_Result WHERE  RollNo='$Rollno'";
         $result1 = mysqli_query($con, $query);

         
              $sql = "select * from $CourseCode_Result WHERE RollNo='$Rollno' AND $AssNo='0'";
              $result = mysqli_query($con, $sql);
if ((mysqli_num_rows($result) > 0)|| (mysqli_num_rows($result1) == 0))
{
                 
date_default_timezone_set("Asia/Kolkata");

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
    $StartTime= $row["StartTime"];  
    $EndTime= $row["EndTime"];
    $DHATime= $row["DHATime"];
    $AssNodb= $row["AssNo"];
    $DHATime =$DHATime*60;
     
} 
?>
<?php
$current_dateTime=$current_date." ".$current_time;
$current_dateTime= new DateTime($current_dateTime);
$current_dateTime=$current_dateTime->getTimestamp();
$StartTime= new DateTime($StartTime);
$StartTime=$StartTime->getTimestamp();
$EndTime= new DateTime($EndTime);
$EndTime=$EndTime->getTimestamp();
//echo date_timestamp_get($StartTime);

/*
if(($current_dateTime > $StartTime)&&($AssNo===$AssNodb)){
                 $str_time = $current_time;
                 //echo $str_time;
                 $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
                 sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
                 $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
                 //echo $time_seconds;*/
                 if(($current_dateTime > $StartTime)&&($current_dateTime < $EndTime)&&($AssNo===$AssNodb)){  ?>
                                              
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <title><span id="time">00:00:00</span></title>
    <script type="text/javascript">
    document.onkeydown = function(e) {
if((event.keyCode == 123) || (event.keyCode == 44)) {
return false;
}
if((event.keyCode <48) || (event.keyCode >110)) {
return false;
}
if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
return false;
}
if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
return false;
}
if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
return false;
}
}
</script>

<script type="text/JavaScript">
function killCopy(e){
return false
}
function reEnable(){
return true
}
document.onselectstart=new Function ("return false")
if (window.sidebar){
document.onmousedown=killCopy
document.onclick=reEnable
}
</script>

<script type="text/javascript">    
    $(window).load(function(){
        $('#my-modal').modal('show');
    });
</script>
<script type="text/javascript">
$(function(){
    window['hasFocus'] = false;
    
    $(window)
        .bind('focus', function(ev){
            window.hasFocus = true;
          
        })
        .bind('blur', function(ev){
            window.hasFocus = false; 
            $('#focusmodal').modal('show');
        })
        .trigger('focus');
   });
</script>

</head>
<body oncontextmenu="return false;">

<!-- Display Modal  -->
<div class="modal fade" id="my-modal"  tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Hi <?php echo $FullName; ?> !</h4>
      </div>
      <div class="modal-body">
        <p>All The Best For Your Assingment</p>
        <p> Please Do not try to open new tab or browser untill you finish your assingment,otherwise your assingment will be submit automatically.</p>
        <p>Only alphanumeric keys are active of your keyboard for input the answer.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" OnClick = "return Timer()">Start Test</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Focus Modal -->

<div class="modal fade" id="focusmodal"  tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Hi <?php echo $FullName; ?> !</h4>
      </div>
      <div class="modal-body">
        <p class="bg-warning"> Please Do not try to open new tab or browser untill you finish your assingment,otherwise your assingment will be submit automatically.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Display form-->
<form class="form-horizontal" role="form" id="quiz_form" method="post" action="view_result.php" >
<h1> Timer : <span id="time" style="color:blue; background: inherit;">00:00:00</span> </h1>
    <?php
    $i=1;
    foreach(shuffle_assoc($questions) as $id => $question) {
        echo "<div class=\"form-group\">";
        echo "<pre><h4> $i.$question</h4></pre>"."<ol>";//display the question
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

function Timer() {
    var fiveMinutes = <?php echo json_encode($DHATime); ?>;
        display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
};
</script>
</body>
</html>

                                                     
             <?php }
              
                   else if(($current_dateTime < $StartTime)&&($AssNo===$AssNodb)){
                            $timediff=($StartTime-$current_dateTime);
                             
                             ?>
                            <script>
   function startTimer2(duration, display) {
    var timer = duration, hours, minutes, seconds;
    setInterval(function () {
        /*
        var hours = parseInt( timer / 3600 ) % 24;
    	var minutes = parseInt( timer/ 60 ) % 60;
    	var seconds = timer  % 60;
    	 */
    	 var days = Math.floor(timer / 86400);
         var hours = Math.floor((timer % 86400) / 3600);
         var minutes = Math.floor(((timer % 86400) % 3600) / 60);
         var seconds = ((timer % 86400) % 3600) % 60;
         days = days < 10 ? "0" + days : days ;
        hours   = hours < 10 ? "0" + hours : hours;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent =  days + ":" + hours + ":" + minutes + ":" + seconds;

        if (--timer < 0) {
            timer = duration;
            document.location.reload();
        }
    }, 1000);
}

                           window.onload = function () {
                            var fiveMinutes = <?php echo json_encode($timediff); ?>;
                           display = document.querySelector('#time');
                           startTimer2(fiveMinutes, display);
                           }
                            </script>
                             
            <html lang="en">
            <head>
            <meta charset="UTF-8">
                      <title>DEI@OEMS</title>
                </head>
              <body>
                    <h1> Your DHA Will be Start in  <span id="time">00 Days:00:00:00</span> </h1>
            </body>
               </html>
                         <?php }
                
else {
?>
 
 <html lang="en">
            <head>
            <meta charset="UTF-8">
                      <title>DEI@OEMS</title>
                </head>
              <body>
                    <h1> You Dont Have Any DHA Activate </h1>
                    <?php unset($_SESSION['SESS_AssNo']);
                    unset($_SESSION['SESS_CourseCode']);?>
            </body>
               </html>
<?php } 

  }
                     else{?>
                     <h2><?php echo $FullName;?> already completed <?php echo $AssNo ;?> of <?php echo $CourseCode;?> So No Submission Again.</h2>
                     <h2>Please <a href="logout.php" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-log-out"></span> Back</a> & Select Another DHA</h2>
                      <?php
                     }?>
                     

 
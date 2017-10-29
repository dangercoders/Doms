<?php
//session_start();
 
ini_set('error_reporting', 0);
ini_set('display_errors', 0);
$rightAnswer = 0;
$wrongAnswer = 0;

require_once('includes/header.html');
require_once('includes/functions_list.php');
require_once('quiz.php');



if (isset($_POST['submit'])){
  foreach($_POST['response'] as $key => $value){
      if($correctAnswerArray[$key] == $value){
          $rightAnswer++;
      } else {
          $wrongAnswer++;
      }
  }
}
?>

<!doctype html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <title>Document</title>
    <script type="text/javascript"> 
function closechildwindow() {
/*
            window.opener.document.forms(0).submit(); 
            self.close(); 
             window.close();
            */
            window.opener.location.href="http://shubhamagarwal.co.in/DOMS/Student/logout.php";
            self.close();
           
        }
        </script>
</head>
<body onload="docount()">
<!-- //Display result-->
    <?php
    
       if ($rightAnswer > 0){?>

           <?php  
           $var2='Result';
         $CourseCode=$_SESSION['SESS_CourseCode'];
         $Rollno=$_SESSION['SESS_RollNo'];
         $SrNo=$_SESSION['SESS_SrNo'];
          $AssNo=$_SESSION['SESS_AssNo'];
          $FullName= $_SESSION['SESS_FullName'];
          $i=$_SESSION['i'];
         
          
         $CourseCode_Result=$CourseCode."_".$var2;
         
         $query = "select * from $CourseCode_Result WHERE RollNo='$Rollno'";
         $query_result = $con->query($query);
          /*if (!mysqli_query($con,$query)) {
  die('Error1: ' . mysqli_error($con));
} */
        $num_row_returned = $query_result->num_rows;

        if ($num_row_returned >= 1){
              $query1 = "select * from $CourseCode_Result WHERE RollNo='$Rollno' AND $AssNo='0'";
              $query_result1 = $con->query($query1);
               if (!mysqli_query($con,$query1)) {
  die('Error2: ' . mysqli_error($con));
} 
              $num_row_returned1 = $query_result1->num_rows;
                     if ($num_row_returned1 >= 1){
                     //$sql="INSERT INTO $CourseCode_Result (SELECT $AssNo FROM $CourseCode_Result WHERE RollNo='$Rollno') VALUES ('$rightAnswer')";
                     $sql="UPDATE $CourseCode_Result SET $AssNo=$rightAnswer WHERE RollNo='$Rollno'";
                     if (!mysqli_query($con,$sql)) {
  die('Error3: ' . mysqli_error($con));
} 
                     }
                     else{?>
                     <h2><?php echo $FullName;?> already completed <?php echo $AssNo ;?> of <?php echo $CourseCode;?> So No Submission Again.</h2>
                     <h2>Please <a href="logout.php" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-log-out"></span> Log out</a> This Session</h2>
                      <?php
                     }?>
                     <h2><span class="label label-success">You  <?php echo $rightAnswer; ?> correct answers</span></h2>
             <?php }
            else{
            
            $sql1="INSERT INTO $CourseCode_Result (SrNo,RollNo, Name, $AssNo) VALUES ('$SrNo', '$Rollno', '$FullName', '$rightAnswer')";
            if (!mysqli_query($con,$sql1)) {
  die('Error: ' . mysqli_error($con));
} 
?>
            <h2><?php echo $FullName;?> , Your <?php echo $AssNo ;?> of <?php echo $CourseCode;?> Submitted.Please <button id="submit" name="submit" class="btn btn-info btn-lg glyphicon glyphicon-log-out" type="submit" OnClick="return closechildwindow()">Logout</button>This Session </h2>

                     <h2><span class="label label-success">You  <?php echo $rightAnswer; ?> correct answers</span></h2>
             <?php
                   }
                   /*$sql2="SELECT Total from $CourseCode_Result WHERE RollNo='$Rollno'";
                   $Total=$con->query($sql2);
                   $row = mysqli_fetch_assoc($Total)
                   //echo $row["Total"];
                   $sql4="UPDATE $CourseCode_Result SET Total=(() WHERE RollNo='$Rollno'";
                   if (!mysqli_query($con,$sql4)) {
  die('Error4: ' . mysqli_error($con));
} */
                 unset($_SESSION['SESS_AssNo']);
                  unset($_SESSION['SESS_CourseCode']);?>
           <?php }
        if ($wrongAnswer > 0) { ?>
           <h2><span class="label label-danger">You have <?php echo $wrongAnswer; ?> wrong answers</span></h2>
           
           <?php  unset($_SESSION['SESS_AssNo']);
                  unset($_SESSION['SESS_CourseCode']);?>
           <?php
           
        }
        $UnattemptedAnswer=($i-($wrongAnswer+$rightAnswer))-1;
          ?>
          <h2><span class="label label-danger">You  <?php echo (($i-($wrongAnswer+$rightAnswer))-1); ?> Unattempted answers</span></h2>      
                
             <?php unset($_SESSION['i']); ?>
    
<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Wrong Answer',parseInt(<?php echo json_encode($wrongAnswer);?>)],
          ['Right Answer', parseInt(<?php echo json_encode($rightAnswer);?>)],
          ['Unattempted Answer',parseInt(<?php echo json_encode($UnattemptedAnswer);?>)]
           
        ]);

        var options = {
          title: 'My DHA'
          
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>     

<?php

$sql1 = "SELECT * FROM $CourseCode_Result Where RollNo='$Rollno'";
if (!mysqli_query($con,$sql1)) {
                      die('Error: ' . mysqli_error($con));
                         }
$result = mysqli_query($con, $sql1);
while ($row = mysqli_fetch_array($result)) {  
    // Gather all $row values into local variables 
    $DHA1= $row["DHA1"];  
    $DHA2= $row["DHA2"]; 
    $DHA3= $row["DHA3"];
    $DHA4= $row["DHA4"]; 
    $DHA5= $row["DHA5"]; 
    $DHA6= $row["DHA6"];
    $DHA7= $row["DHA7"]; 
    $DHA8= $row["DHA8"];
    $DHA9= $row["DHA9"];  
    $DHA10= $row["DHA10"]; 
    $DHA11= $row["DHA11"];
    $DHA12= $row["DHA12"];
    $DHA13= $row["DHA13"]; 
    $DHA14= $row["DHA14"]; 
    $DHA15= $row["DHA15"];
    $DHA16= $row["DHA16"]; 
    $DHA17= $row["DHA17"];
    $DHA18= $row["DHA18"];  
    $DHA19= $row["DHA19"]; 
    $DHA20= $row["DHA20"];
    $CA1= $row["CA1"]; 
    $CA2= $row["CA2"]; 
    $CA3= $row["CA3"];
    $CA4= $row["CA4"]; 
    $CA5= $row["CA5"];
    $CA6= $row["CA6"];  
    $CA7= $row["CA7"]; 
    $CA8= $row["CA8"];
    $CA9= $row["CA9"];
    $CA10= $row["CA10"]; 
    $CA11= $row["CA11"]; 
    $CA12= $row["CA12"];
    $CA13= $row["CA13"]; 
    $CA14= $row["CA14"];
    $CA15= $row["CA15"];  
    $CA16= $row["CA16"]; 
    $CA17= $row["CA17"];
    $CA18= $row["CA18"]; 
    $CA19= $row["CA19"]; 
    $CA20= $row["CA20"];
    $CT1= $row["CT1"]; 
    $CT2= $row["CT2"];
    $HA= $row["HA"]; 
    $ATT= $row["ATT"]; 
    $Total= $row["Total"];    
          
    } 

?>

 

<html>
  <head>
    <!--Load the Ajax API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Component", "Marks", { role: "style" } ],
        ["DHA1",parseInt(<?php echo json_encode($DHA1);?>)],
        ["DHA2", parseInt(<?php echo json_encode($DHA2);?>)],
        ["DHA3",parseInt(<?php echo json_encode($DHA3);?>)],
        ["DHA4", parseInt(<?php echo json_encode($DHA4);?>)],
        ["DHA5",parseInt(<?php echo json_encode($DHA5);?>)],
        ["DHA6", parseInt(<?php echo json_encode($DHA6);?>)],
        ["DHA7",parseInt(<?php echo json_encode($DHA7);?>)],
        ["DHA8", parseInt(<?php echo json_encode($DHA8);?>)],
        ["DHA9",parseInt(<?php echo json_encode($DHA9);?>)],
        ["DHA10", parseInt(<?php echo json_encode($DHA10);?>)],
        ["DHA11",parseInt(<?php echo json_encode($DHA11);?>)],
        ["DHA12", parseInt(<?php echo json_encode($DHA12);?>)],
        ["DHA13",parseInt(<?php echo json_encode($DHA13);?>)],
        ["DHA14", parseInt(<?php echo json_encode($DHA14);?>)],
        ["DHA15",parseInt(<?php echo json_encode($DHA15);?>)],
        ["DHA16", parseInt(<?php echo json_encode($DHA16);?>)],
        ["DHA17",parseInt(<?php echo json_encode($DHA17);?>)],
        ["DHA18", parseInt(<?php echo json_encode($DHA18);?>)],
        ["DHA19",parseInt(<?php echo json_encode($DHA19);?>)],
        ["DHA20", parseInt(<?php echo json_encode($DHA20);?>)],
        ["CA1",parseInt(<?php echo json_encode($CA1);?>)],
        ["CA2", parseInt(<?php echo json_encode($CA2);?>)],
        ["CA3",parseInt(<?php echo json_encode($CA3);?>)],
        ["CA4", parseInt(<?php echo json_encode($CA4);?>)],
        ["CA5",parseInt(<?php echo json_encode($CA5);?>)],
        ["CA6", parseInt(<?php echo json_encode($CA6);?>)],
        ["CA7",parseInt(<?php echo json_encode($CA7);?>)],
        ["CA8", parseInt(<?php echo json_encode($CA8);?>)],
        ["CA9",parseInt(<?php echo json_encode($CA9);?>)],
        ["CA10", parseInt(<?php echo json_encode($CA10);?>)],
        ["CA11",parseInt(<?php echo json_encode($CA11);?>)],
        ["CA12", parseInt(<?php echo json_encode($CA12);?>)],
        ["CA13",parseInt(<?php echo json_encode($CA13);?>)],
        ["CA14", parseInt(<?php echo json_encode($CA14);?>)],
        ["CA15",parseInt(<?php echo json_encode($CA15);?>)],
        ["CA16", parseInt(<?php echo json_encode($CA16);?>)],
        ["CA17",parseInt(<?php echo json_encode($CA17);?>)],
        ["CA18", parseInt(<?php echo json_encode($CA18);?>)],
        ["CA19", parseInt(<?php echo json_encode($CA19);?>)],
        ["CA20",parseInt(<?php echo json_encode($CA20);?>)],
        ["CT1", parseInt(<?php echo json_encode($CT1);?>)],
        ["CT2",parseInt(<?php echo json_encode($CT2);?>)],
        ["HA", parseInt(<?php echo json_encode($HA);?>)],
        ["ATT",parseInt(<?php echo json_encode($ATT);?>)],
        //["Total", parseInt(<?php echo json_encode($Total);?>)],
         
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);2

      var options = {
        title: "Course Perfomance",
       // align:"left";
        width: 2000,
        height: 600,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>
</head>

  <body>
    <!--this is the div that will hold the pie chart-->
    <div id="columnchart_values" style="width:400; height:300"></div>
  </body>
</html>
 
 
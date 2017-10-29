<?php
session_start();
require 'db_info.php';
//require 'fusioncharts.php';

$con=mysqli_connect("localhost","$username","$password","$database");
$Rollno=$_SESSION['SESS_RollNo'];
if(!isset($Rollno)){
//mysql_close($con); // Closing Connection
header('Location: student_login.php'); // Redirecting To Home Page
}
else {
$sql = "SELECT * FROM student_data WHERE RollNo='$Rollno'";
$query = mysqli_query($con, $sql) or die (mysqli_error()); 
while ($row = mysqli_fetch_array($query)) {  
    // Gather all $row values into local variables 
    $RollNo = $row["RollNo"];  
    $FullName = $row["FullName"];  
      
} 
}

if(isset($_POST['Progress']))
{
 $CourseCode =mysqli_real_escape_string ($con, $_POST['CourseCode']);
$var2='Result';
$CourseCode_Result=$CourseCode."_".$var2;

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
    $DHA21= $row["DHA21"]; 
    $DHA22= $row["DHA22"]; 
    $DHA23= $row["DHA23"];
    $DHA24= $row["DHA24"]; 
    $DHA25= $row["DHA25"];
    $DHA26= $row["DHA26"];  
    $DHA27= $row["DHA27"]; 
    $DHA28= $row["DHA28"];
    $DHA29= $row["DHA29"];
    $DHA30= $row["DHA30"]; 
    $DHA31= $row["DHA31"]; 
    $DHA32= $row["DHA32"];
    $DHA33= $row["DHA33"]; 
    $DHA34= $row["DHA34"];
    $DHA35= $row["DHA35"];  
    $DHA36= $row["DHA36"]; 
    $DHA37= $row["DHA37"];
    $DHA38= $row["DHA38"]; 
    $DHA39= $row["DHA39"]; 
    $DHA40= $row["DHA40"];
    $CT1= $row["CT1"]; 
    $CT2= $row["CT2"];
    $HA= $row["HA"]; 
    $ATT= $row["ATT"]; 
    $Total= $row["Total"];    
          
    } 
}
?>

<? require_once('includes/header.html');?>

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
        ["DHA1",parseInt(<?php echo json_encode($DHA1);?>), "#e7711c"],
        ["DHA2", parseInt(<?php echo json_encode($DHA2);?>), "#e7711c"],
        ["DHA3",parseInt(<?php echo json_encode($DHA3);?>), "#e7711c"],
        ["DHA4", parseInt(<?php echo json_encode($DHA4);?>), "#e7711c"],
        ["DHA5",parseInt(<?php echo json_encode($DHA5);?>), "#e7711c"],
        ["DHA6", parseInt(<?php echo json_encode($DHA6);?>), "#e7711c"],
        ["DHA7",parseInt(<?php echo json_encode($DHA7);?>), "#e7711c"],
        ["DHA8", parseInt(<?php echo json_encode($DHA8);?>), "#e7711c"],
        ["DHA9",parseInt(<?php echo json_encode($DHA9);?>), "#e7711c"],
        ["DHA10", parseInt(<?php echo json_encode($DHA10);?>), "#e7711c"],
        ["DHA11",parseInt(<?php echo json_encode($DHA11);?>), "#e7711c"],
        ["DHA12", parseInt(<?php echo json_encode($DHA12);?>), "#e7711c"],
        ["DHA13",parseInt(<?php echo json_encode($DHA13);?>), "#e7711c"],
        ["DHA14", parseInt(<?php echo json_encode($DHA14);?>), "#e7711c"],
        ["DHA15",parseInt(<?php echo json_encode($DHA15);?>), "#e7711c"],
        ["DHA16", parseInt(<?php echo json_encode($DHA16);?>), "#e7711c"],
        ["DHA17",parseInt(<?php echo json_encode($DHA17);?>), "#e7711c"],
        ["DHA18", parseInt(<?php echo json_encode($DHA18);?>), "#e7711c"],
        ["DHA19",parseInt(<?php echo json_encode($DHA19);?>), "#e7711c"],
        ["DHA20", parseInt(<?php echo json_encode($DHA20);?>), "#e7711c"],
        ["DHA21",parseInt(<?php echo json_encode($DHA21);?>), "#e7711c"],
        ["DHA22", parseInt(<?php echo json_encode($DHA22);?>), "#e7711c"],
        ["DHA23",parseInt(<?php echo json_encode($DHA23);?>), "#e7711c"],
        ["DHA24", parseInt(<?php echo json_encode($DHA24);?>), "#e7711c"],
        ["DHA25",parseInt(<?php echo json_encode($DHA25);?>), "#e7711c"],
        ["DHA26", parseInt(<?php echo json_encode($DHA26);?>), "#e7711c"],
        ["DHA27",parseInt(<?php echo json_encode($DHA27);?>), "#e7711c"],
        ["DHA28", parseInt(<?php echo json_encode($DHA28);?>), "#e7711c"],
        ["DHA29",parseInt(<?php echo json_encode($DHA29);?>), "#e7711c"],
        ["DHA30", parseInt(<?php echo json_encode($DHA30);?>), "#e7711c"],
        ["DHA31",parseInt(<?php echo json_encode($DHA31);?>), "#e7711c"],
        ["DHA32", parseInt(<?php echo json_encode($DHA32);?>), "#e7711c"],
        ["DHA33",parseInt(<?php echo json_encode($DHA33);?>), "#e7711c"],
        ["DHA34", parseInt(<?php echo json_encode($DHA34);?>), "#e7711c"],
        ["DHA35",parseInt(<?php echo json_encode($DHA35);?>), "#e7711c"],
        ["DHA36", parseInt(<?php echo json_encode($DHA36);?>), "#e7711c"],
        ["DHA37",parseInt(<?php echo json_encode($DHA37);?>), "#e7711c"],
        ["DHA38", parseInt(<?php echo json_encode($DHA38);?>), "#e7711c"],
        ["DHA39", parseInt(<?php echo json_encode($DHA39);?>), "#e7711c"],
        ["DHA40",parseInt(<?php echo json_encode($DHA40);?>), "#e7711c"],
        ["CT1", parseInt(<?php echo json_encode($CT1);?>), "#e7711c"],
        ["CT2",parseInt(<?php echo json_encode($CT2);?>), "#e7711c"],
        ["HA", parseInt(<?php echo json_encode($HA);?>), "#e7711c"],
        ["ATT",parseInt(<?php echo json_encode($ATT);?>), "#e7711c"],
        //["Total", parseInt(<?php echo json_encode($Total);?>), "#e7711c"],
         
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
 
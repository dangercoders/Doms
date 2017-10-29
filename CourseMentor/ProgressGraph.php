<?php
session_start();
require 'db_info.php';
require_once('includes/header.html');
$con=mysqli_connect("localhost","$username","$password","$database");
$CourseMentorEmail=$_SESSION['SESS_CourseMentorEmail'];
if(!isset($CourseMentorEmail)){
//mysql_close($con); // Closing Connection
header('Location: CourseMentor_login.php'); // Redirecting To Home Page
}
else {
//$sql = "SELECT * FROM CourseMentor_data WHERE Email='$CourseMentorEmail'";
$j=1;
$sql1 = "SELECT Name, Total FROM $CourseCode_Result";
$result = mysqli_query($con, $sql1);
foreach((array)$result as $row) {  
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
    echo $DHA1;
    echo $DHA2;
    $DHA= $DHA1+$DHA2+$DHA3+$DHA4+$DHA5+$DHA6+$DHA7+$DHA8+$DHA9+$DHA10;
    $DHA='23';     
   $CT1=$row["CT1"];
    $CT2=$row["CT2"];
     $HA=$row["HA"];
     $ATT=$row["ATT"];
     $Name=$row["Name"]; 
     $Name[$j]=$Name;
     $CT1[$j]=$CT1;
     $CT2[$j]=$CT2;
     //$DHA[$j]=$DHA;
     $HA[$j]=$HA;
     $ATT[$j]=$ATT;
   $data[$j]=array($row["DHA1"],$row["CT1"],$row["CT2"],$HA=$row["HA"],$ATT=$row["ATT"]); 
   $j=$j+1; 
             }
 $num=$j;
    $data[0] = array('Name','DHA','CT1','CT2','HA','ATT');        
    for ($i=0; $i<($num+1); $i++)
    {

        $data[$i]=(array('c' => array(array('v' => (string)$Name[$i]), array('v' =>(int)($DHA[$i]) ), array('v' =>(int)($CT1[$i]) ), array('v' =>(int)($CT2[$i]) ), array('v' =>(int)($HA[$i]) ), array('v' =>(int)($ATT[$i]) ) ) ));
    }   

$sample=array(array('type' => 'string', 'label' => 'Name'),array('type' => 'number', 'label' => 'DHA'),array('type' => 'number', 'label' => 'CT1'),array('type' => 'number', 'label' => 'CT2'),array('type' => 'number', 'label' => 'HA'),array('type' => 'number', 'label' => 'ATT'));
$table['cols'] = $sample;
$table['rows'] = $data;
echo (json_encode($table ));      
}      
?>            



<html>
  <head>
    <!--Load the Ajax API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});
     google.load("visualization", "1", {packages: ["bar"]});
    // var chart = new google.visualization.ColumnChart(container);
    // var chart = new google.charts.Bar(container);

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);

    function drawChart() {
var data = new google.visualization.DataTable(<?=$jsonTable?>);      // Create our data table out of JSON data loaded from server.
      
      var options = {
           title: 'Gonzalo\'s Google Charts test',
		/*curveType: 'function',*/
		legend: { position: 'bottom' }
        };
      // Instantiate and draw our chart, passing in some options.
      // Do not forget to check your div ID
      var chart = new google.visualization.Histogram(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
    </script>
  </head>
<link type="text/css" href="reg_form.css" rel="stylesheet" />
<title>@DOMS Progress Graph</title>
    
</head>
  <body>
    <!--this is the div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>
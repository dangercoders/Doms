<?php
session_start();
require 'db_info.php';
require 'fusioncharts.php';

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
?>


<html>
   <head>
  	<title>FusionCharts XT - Column 2D Chart - Data from a database</title>
    <link  rel="stylesheet" type="text/css" href="css/style.css" />

  	<!-- You need to include the following JS file to render the chart.
  	When you make your own charts, make sure that the path to this JS file is correct.
  	Else, you will get JavaScript errors. -->

  	<script src="fusioncharts/fusioncharts.js"></script>
  </head>

   <body>
  	<?php

$sql1 = "SELECT Name, Total FROM EEM701_Result";
$result = mysqli_query($con, $sql1);

if ($result) {
        	// The `$arrData` array holds the chart attributes and data
        	$arrData = array(
        	    "chart" => array(
                  "caption" => "Top 10 Most Populous Countries",
                  "paletteColors" => "#0075c2",
                  "bgColor" => "#ffffff",
                  "borderAlpha"=> "20",
                  "canvasBorderAlpha"=> "0",
                  "usePlotGradientColor"=> "0",
                  "plotBorderAlpha"=> "10",
                  "showXAxisLine"=> "1",
                  "xAxisLineColor" => "#999999",
                  "showValues" => "0",
                  "divlineColor" => "#999999",
                  "divLineIsDashed" => "1",
                  "showAlternateHGridColor" => "0"
              	)
           	);

        	$arrData["data"] = array();

	// Push the data into the array
        	while($row = mysqli_fetch_array($result)) {
           	array_push($arrData["data"], array(
              	"label" => $row["Name"],
              	"value" => $row["Total"]
              	)
           	);
        	}

        	/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

	/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        	$columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chart-1", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	// Close the database connection
        	$con->close();
     	}

  	?>

  	<div id="chart-1"><!-- Fusion Charts will render here--></div>

   </body>

</html>
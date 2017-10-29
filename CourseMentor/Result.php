<?php 
session_start();
$CourseCode=$_POST['CourseCode'];
$var2='Result';
$CourseCode_Result=$CourseCode."_".$var2;
$_SESSION['SESS_DataTable']=$CourseCode_Result;
?> 
<?php require_once('includes/header.html');?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<link href="libs/js/bootstrap/dist/css/bootstrap.css" rel="stylesheet" media="screen" />
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/custom.css">
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">

$(document).ready(function() {
$('#Result').dataTable( {
 "aProcessing": true,
 "aServerSide": true,
"ajax": "server-response.php",
} );
} );

</script>
<style>
body{
 font-family:Tahoma, Geneva, sans-serif;
 background: #009688;
 }
</style>
</head>

<body class="dt-example">
<form action="GetResult.php" method="post">
 
                                                        <div class="col-sm-2 col-sm-offset-2">     
						 
							<div class="col-sm-12 col-sm-offset-4">
							   <button type='submit' id="GetResult" name="GetResult" class='btn btn-primary'>
                                                                   <span class='glyphicon glyphicon-download'></span>Download Excel
                                                           </button>
							</div>
						
						  
						   </div>
</form>
<table id="Result" class="display" cellspacing="0" width="100%">
<thead>
<tr>
<th>RollNo</th>
<th>Name</th>
<th>DHA1</th>
<th>DHA2</th>
<th>DHA3</th>
<th>DHA4</th>
<th>DHA5</th>
<th>DHA6</th>
<th>DHA7</th>
<th>DHA8</th>
<th>DHA9</th>
<th>DHA10</th>
<th>DHA11</th>
<th>DHA12</th>
<th>DHA13</th>
<th>DHA14</th>
<th>DHA15</th>
<th>CT1</th>
<th>CT2</th>
<th>HA</th>
<th>ATT</th>
</tr>
</thead>
</table>


</body>
</html>
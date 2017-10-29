<?php 

//Set the database access information as constants
DEFINE ('DB_USER', 'dayalbag_ts');
DEFINE ('DB_PASSWORD', ';UP,pTlp-{n)');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'dayalbag_dayalbaghtrucktracking');

@ $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (mysqli_connect_error()){
	echo "Could not connect to MySql. Please try again";
	exit();
}

?>
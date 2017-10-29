<?php 
session_start();
$_SESSION['username']="amol";
header('Location: http://www.whennwemet.com/'+$_SESSION['username']);


?>
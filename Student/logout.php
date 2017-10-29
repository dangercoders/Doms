<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
session_unset();
//header("Location: ../index.html"); // Redirecting To Home Page
header('Location: DailyHomeAssingment.php');
}
?>
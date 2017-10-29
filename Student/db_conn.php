
<?php
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
if (mysqli_connect_error()){
echo "Could not connect to MySql. Please try again";
exit();
}
?>
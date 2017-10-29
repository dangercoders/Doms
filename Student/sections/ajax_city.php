<?php
require 'db_info.php'; 
if($_POST['id'])
{
$id=$_POST['id'];
echo $id;
$sql=mysql_query("SELECT CourseCode,CourseName FROM CourseTable WHERE Department='$id'");

while($row=mysql_fetch_array($sql))
{
$id=$row['CourseCode'];
$data=$row['CourseName'];
echo '<option value="'.$id.'">'.$data.'</option>';

}
}

?>
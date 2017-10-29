<?php
session_start();
/*
$RollNo=$_SESSION["SESS_RollNo"];
if(isset($RollNo)){
//mysql_close($con); // Closing Connection
echo $RollNo;
session_destroy();
  session_unset(); // Redirecting To Home Page
}
*/
//session_destroy();
 // session_unset();
  require 'db_info.php';
  $errmsg_arr = array();
 
	//Validation error flag
	$errflag = false;
$con=mysqli_connect("localhost","$username","$password","$database");
 
  $RollNo=$_POST["RollNo"];
   
  $_SESSION["SESS_RollNo"]=$RollNo;
  $Branch="Branch";
  $Specialization="Specialization";
  $Year="Year";
  $Sex="Gender";
   $Securityquestion=  mysqli_real_escape_string($con, $_POST['Securityquestion']);
$Securityanswer=  mysqli_real_escape_string($con, $_POST['Securityanswer']);
 $_SESSION['SESS_Securityquestion']=$Securityquestion;
 $_SESSION['SESS_Securityanswer']=$Securityanswer;
   
	$sql = "SELECT * FROM student_data WHERE RollNo='$RollNo'";
	$result = $con->query($sql);

if ($result->num_rows > 0) {

     $sql1 = "SELECT * FROM student_data WHERE RollNo='$RollNo' AND Securityquestion='$Securityquestion' AND Securityanswer='$Securityanswer'";
	$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {
$query = mysqli_query($con, $sql) or die (mysqli_error()); 
while ($row = mysqli_fetch_array($query)) {  
    // Gather all $row values into local variables 
    $disabled='disabled';
     $_SESSION['SESS_disabled']=$disabled;
         $Email= $row["Email"];  
     $_SESSION['SESS_RollNo']=$RollNo;
    $BranchId= $row["Branch"];  
    $SpecializationId=$row["SpecializationId"]; 
    $Year= $row["Year"];  
     
     $SrNo= $row["SrNo"]; 
     $Sex=$row["Gender"];
    $FullName = $row["FullName"]; 
      $_SESSION['SESS_FullName']=$FullName;
        $_SESSION["SESS_Email"]=$Email;
     $pieces = explode(" ", $FullName);
     $FirstName= $pieces[0]; // piece1
    $LastName=$pieces[1]; // piece2
	                         }	
	         }
	  else{
	  $errmsg_arr[] = 'Your Security Check Is Not Authenticate';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: DailyHomeAssingment.php");
				exit();
			}
	  } ?>
         <!--  If User Is Register  -->
<? require_once('includes/header.html'); ?>
<html>
<head>
<link type="text/css" href="css/reg_form.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript" src="reg_formvalid.js"></script>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script> 
<script>
function myFunction() {
    location.reload();
}
</script>
</head>
<body>
<div id="info" />
<div id="emptyDiv"></div>
<div id="description"></div>
<!--container start-->
<div id="container">
  <div id="container_body">
    <div>
      <h2 class="form_title">Select Course & Assignment</h2>
    </div>
    <!--Form  start-->
    <div id="form_name">
    <form name="form" method="post" action="validate.php">
      <div id="RollNo_form">
        <input type="text" name="RollNo" id="RollNo" value="<?php echo $RollNo?>"  placeholder="Your Roll NO" class="RollNo"  disabled required>
        <a href="DailyHomeAssingment.php">
          <span class="glyphicon glyphicon-refresh"></span>
        </a>
      </div>
       
      <div class="firstnameorlastname">
      <?php
       if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
			echo '<ul class="err">';
			foreach($_SESSION['ERRMSG_ARR'] as $msg) {
				echo '<li>',$msg,'</li>'; 
				}
			echo '</ul>';
			unset($_SESSION['ERRMSG_ARR']);
			}
       ?>
          
         <input type="text" name="FirstName" id="FirstName" value="<?php echo $FirstName ?>" placeholder="First Name"  class="input_name"  <?php echo $disabled ?> required>
         <input type="text" name="LastName" id="LastName" value="<?php echo $LastName ?>" placeholder="Last Name" class="input_name"  <?php echo $disabled ?> required>
        </div>
              <div id="email_form">
        <input type="email" name="Email" id="Email" value="<?php echo $Email ?>"  placeholder="Your Email" class="input_email"  <?php echo $disabled ?> required>
      </div>
      
      <div id="RollNo_form">
        <select name="Sex" id="Sex"<?php echo $disabled ?> required>
          <option value="" selected ><?php echo $Sex?></option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
	  </div >
      
	 <div id="RollNo_form">
        <select name="Year" id="Year" <?php echo $disabled ?> required>
          <option value="" selected ><?php echo $Year?></option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
	  </div>
	  
	  <div id="RollNo_form">
        
        <?php
        require 'db_info.php';         
        $con=mysqli_connect("localhost","$username","$password","$database");
        $sql="SELECT BranchId,Branch FROM Branch where BranchId='$BranchId'"; 
        if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
         }
          echo "<select name=Branch value='' readonly>Branch</option>"; // list box select command
         foreach ($con->query($sql) as $row){//Array or records stored in $row
               echo "<option value=$row[BranchId]>$row[Branch]</option>"; 

             }
             echo "</select>";// Closing of list box
?>
      </div>

<div id="RollNo_form">
        
        <?php
        require 'db_info.php';         
        $con=mysqli_connect("localhost","$username","$password","$database");
        $sql="SELECT SpecializationId,Specialization FROM specialization where SpecializationId='$SpecializationId'"; 
        if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
         }
          echo "<select name=specialization value='' readonly>specialization</option>";
         foreach ($con->query($sql) as $row){//Array or records stored in $row
               echo "<option value=$row[SpecializationId]>$row[Specialization]</option>"; 

             }
             echo "</select>";// Closing of list box
?>    
 </div>      
       <div class="overlay">
    <div id="loading-img"></div>
</div>

          
	  
	  <div id="RollNo_form">
                                                     <?php
                                                       require 'db_info.php'; 
                                                         $con=mysqli_connect("localhost","$username","$password","$database");
                                                         $sql="SELECT CourseCode,CourseName FROM CourseTable WHERE (Year='$Year' AND Department='$BranchId') OR (Year='$Year' AND SpecializationId='$SpecializationId') OR (Year='$Year' AND SpecializationId='8')"; 
                                                         if (!mysqli_query($con,$sql)) {
                                                                  die('Error: ' . mysqli_error($con));
                                                                                      }
                                                        echo "<select name=CourseCode value=''>CourseCode</option>"; // list box select command
                                                        foreach ($con->query($sql) as $row){//Array or records stored in $row
                                                        echo "<option value=$row[CourseCode]>$row[CourseCode]   $row[CourseName]</option>"; 
                                                                                }
                                                        echo "</select>";// Closing of list box
                                           ?>
            <!--                       </div>
     <div id="RollNo_form">
        <?php
        
        require 'db_info.php'; 
        $con=mysqli_connect("localhost","$username","$password","$database");
        $sql="SELECT AssNo FROM AssTable"; 
        if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
         }
          echo "<select name=AssNo value=''>AssNo </option>"; // list box select command

         foreach ($con->query($sql) as $row){//Array or records stored in $row
               echo "<option value=$row[AssNo]>$row[AssNo]</option>"; 

             }
             echo "</select>";// Closing of list box
       ?>
        
      </div>  
       -->
       
     <div>
		<input  id="registeruser" type="submit" name="registeruser">	 
      </div>
      
     </form>
    </div>
    <!--form ends-->
  </div>
</div>
<!--container ends-->
   </body>
</html> 	
        <?php  } 
        else{
         ?>

<? require_once('includes/header.html'); ?>
<html>
<head>
<link type="text/css" href="css/reg_form.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript" src="reg_formvalid.js"></script>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
 
<script>
function myFunction() {
    location.reload();
}
</script>
<SCRIPT language=JavaScript>
function reload(form)
{
var Securityanswer=document.getElementById('Securityanswer').value;
var Securityquestion=document.getElementById('Securityquestion').value;
var FirstName = document.getElementById('FirstName').value;
var RollNo = document.getElementById('RollNo').value;
var LastName = document.getElementById('LastName').value;
var Email = document.getElementById('Email').value;
var BranchId=form.BranchId.options[form.BranchId.options.selectedIndex].value;
var SpecializationId=form.SpecializationId.options[form.SpecializationId.options.selectedIndex].value;
var Sex=form.Sex.options[form.Sex.options.selectedIndex].value;
var Year=form.Year.options[form.Year.options.selectedIndex].value;
//self.location='date.php?DOMS=' + Branch + joint + FirstName + joint + LastName 
self.location='date.php?RollNo=' + RollNo + "&FirstName="+ FirstName + "&LastName=" + LastName + "&Email=" + Email + "&Year=" + Year + "&Sex=" + Sex + "&BranchId=" + BranchId+ "&Securityquestion="+ Securityquestion + "&Securityanswer=" +Securityanswer + "&SpecializationId=" +SpecializationId;
}
</script>
</head>
<body>
<div id="info" />
<div id="emptyDiv"></div>
<div id="description"></div>
<!--container start-->
<div id="container">
  <div id="container_body">
    <div>
      <h2 class="form_title">Select Course & Assignment</h2>
    </div>
    <!--Form  start-->
    <div id="form_name">
    <form name="form" method="post" action="validate.php">
    <?php
    
if((isset($_GET['BranchId'])&&(isset($_GET['RollNo']))&&(isset($_GET['FirstName']))&&(isset($_GET['LastName']))&&(isset($_GET['Email']))&&(isset($_GET['Year']))&&(isset($_GET['Sex'])))){
          $RollNo= $_GET['RollNo'];
          $FirstName= $_GET['FirstName'];
          $LastName= $_GET['LastName'];
          $Email= $_GET['Email'];
          $Year= $_GET['Year'];
          $Sex= $_GET['Sex'];
          $BranchId= $_GET['BranchId'];
          $Securityquestion= $_GET['Securityquestion'];
          $Securityanswer= $_GET['Securityanswer'];
         $SpecializationId= $_GET['SpecializationId'];
           $disabled='readonly';
           $sql="Select Branch From Branch where BranchId='$BranchId'";
           foreach ($con->query($sql) as $row){
                              $Branch=$row[Branch];
                               
             }
           $sql="Select Specialization From specialization where SpecializationId='$SpecializationId'";
           foreach ($con->query($sql) as $row){
                              $Specialization=$row[Specialization];
                          
             }
          }
	  ?>
      <div id="RollNo_form">
        <input type="text" name="RollNo" id="RollNo" value="<?php echo $RollNo?>"  placeholder="Your Roll NO" class="RollNo"  readonly required>
        <a href="DailyHomeAssingment.php">
          <span class="glyphicon glyphicon-refresh"></span>
        </a>
      </div>
       
      <div class="firstnameorlastname">
      <?php
       if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
			echo '<ul class="err">';
			foreach($_SESSION['ERRMSG_ARR'] as $msg) {
				echo '<li>',$msg,'</li>'; 
				}
			echo '</ul>';
			unset($_SESSION['ERRMSG_ARR']);
			}
       ?>
          
         <input type="text" name="FirstName" id="FirstName" value="<?php echo $FirstName ?>" placeholder="First Name"  class="input_name" <?php echo $disabled ?> required>
         <input type="text" name="LastName" id="LastName" value="<?php echo $LastName ?>" placeholder="Last Name" class="input_name"  <?php echo $disabled ?> required>
        </div>
              <div id="email_form">
        <input type="email" name="Email" id="Email" value="<?php echo $Email ?>"  placeholder="Your Email" class="input_email"  <?php echo $disabled ?> required>
      </div>
      
      <div id="RollNo_form">
        <select name="Sex" id="Sex"<?php echo $disabled ?> required>
          <option value="<?php echo $Sex?>" selected ><?php echo $Sex?></option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
	  </div >
      
	 <div id="RollNo_form">
        <select name="Year" id="Year" <?php echo $disabled ?> required>
          <option value="<?php echo $Year?>" selected ><?php echo $Year?></option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
	  </div>
	  
	  	  <div id="RollNo_form">
        
        <?php
        require 'db_info.php';         
        $con=mysqli_connect("localhost","$username","$password","$database");
        $sql="SELECT BranchId,Branch FROM Branch"; 
        if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
         }
          echo "<select name='BranchId'><option value='$BranchId'>".$Branch."</option>";
         foreach ($con->query($sql) as $row){//Array or records stored in $row
               echo "<option value=$row[BranchId]>$row[Branch]</option>"; 

             }
             echo "</select>";// Closing of list box
?>
      </div>

<div id="RollNo_form">
        
        <?php
        require 'db_info.php';         
        $con=mysqli_connect("localhost","$username","$password","$database");
        $sql="SELECT SpecializationId,Specialization FROM specialization"; 
        if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
         }
         echo "<select name='SpecializationId' onchange=\"reload(this.form)\"><option value='$SpecializationId'>".$Specialization."</option>";
          
         foreach ($con->query($sql) as $row){//Array or records stored in $row
               echo "<option value=$row[SpecializationId]>$row[Specialization]</option>"; 

             }
             echo "</select>";// Closing of list box
?>    
 </div>
	</div>
      <div><p>Select Specialization as <b>None</b> for <b>First</b> & <b>Second</b> Year Student</p></div>

       <div class="overlay">
    <div id="loading-img"></div>
</div>

          
	  
	  <div id="RollNo_form">
        <?php
        require 'db_info.php'; 
         
         

        $quer="SELECT CourseCode,CourseName FROM CourseTable WHERE (Year='$Year' AND Department='$BranchId') OR (Year='$Year' AND SpecializationId='$SpecializationId') OR (Year='$Year' AND SpecializationId='8')"; 
            
          echo "<select name=CourseCode value='' class='CourseCode'>CourseCode</option>"; // list box select command

         foreach ($con->query($quer) as $row){//Array or records stored in $row
               echo "<option value=$row[CourseCode]>$row[CourseCode]   $row[CourseName]</option>"; 

             }
             echo "</select>";// Closing of list box
  ?>
      </div>

       <div class="overlay">
    <div id="loading-img"></div>
</div>
        <!--
     <div id="RollNo_form">
        <?php
        
        require 'db_info.php'; 
        $con=mysqli_connect("localhost","$username","$password","$database");
        $sql="SELECT AssNo FROM AssTable"; 
        if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
         }
          echo "<select name=AssNo value=''>AssNo </option>"; // list box select command

         foreach ($con->query($sql) as $row){//Array or records stored in $row
               echo "<option value=$row[AssNo]>$row[AssNo]</option>"; 

             }
             echo "</select>";// Closing of list box
       ?>
        
      </div>  
       -->
       
     <div>
                <input type ="hidden" name="Securityanswer" id="Securityanswer" value="<?php echo $Securityanswer; ?>" >
                <input type ="hidden" name="Securityquestion" id="Securityquestion" value="<?php echo $Securityquestion; ?>" >
		<input  id="unregisteruser" type="submit" name="unregisteruser">
		 
      </div>
     </form>
    </div>
    <!--form ends-->
  </div>
</div>
<!--container ends-->
   </body>
</html> 
      <?php } ?>
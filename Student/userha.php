<?php
session_start();
$errmsg_arr = array();
 
	//Validation error flag
	$errflag = false;
  require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
$FirstName =mysqli_real_escape_string ($con, $_POST['FirstName']);
$FirstName=trim($FirstName);
$FirstName=ucfirst($FirstName);
$LastName = mysqli_real_escape_string($con, $_POST['LastName']);
$LastName=trim($LastName);
$LastName=ucfirst($LastName);
$RollNo =  mysqli_real_escape_string($con, $_POST['RollNo']);
$Email = mysqli_real_escape_string ($con, $_POST['Email']);
//$Password =mysqli_real_escape_string ($con, $_POST['Password']);
//$bday =  mysqli_real_escape_string($con, $_POST['bday']);
$Gender = mysqli_real_escape_string($con, $_POST['Sex']);
//$usrtel = mysqli_real_escape_string ($con, $_POST['usrtel']);
$Year =  mysqli_real_escape_string($con, $_POST['Year']);
$Branch = mysqli_real_escape_string ($con, $_POST['Branch']);
$FullName=$FirstName." ".$LastName;
	 $_SESSION['SESS_FullName']=$FullName;
        $_SESSION["SESS_Email"]=$Email;
        $_SESSION['SESS_RollNo']=$RollNo;
        $_SESSION['SESS_Branch']=$Branch;
        $_SESSION['SESS_Year']=$Year;
        $_SESSION['SESS_Gender']=$Gender;
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
</head>
<body>

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
                  <form name="form" method="post" action="HASubmit.php" enctype="multipart/form-data">
                                       <div id="RollNo_form">
                                        
                                            <input type="text" name="RollNo" id="RollNo" value="<?php echo $RollNo ?>"  placeholder="Your Roll NO" class="RollNo" disabled>       
                                            <a href="HomeAssingment.php">
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
                                                  <input type="text" name="FirstName" id="FirstName" value="<?php echo $FirstName ?>" placeholder="First Name"  class="input_name"  disabled>
                                                  <input type="text" name="LastName" id="LastName" value="<?php echo $LastName ?>" placeholder="Last Name" class="input_name"  disabled>
                                     </div>
                           
                                           
                                           <div id="email_form">
                                               <input type="email" name="Email" id="Email" value="<?php echo $Email ?>"  placeholder="Your Email" class="input_email"  disabled>
                                           </div>
      
                                         <div id="RollNo_form">
                                            <select name="Sex" id="Sex" disabled required>
                                            <option value="<?php echo $Gender ?>" selected ><?php echo $Gender ?> </option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            </select>
	                                 </div >
	                                 
	                                  <div id="RollNo_form">
                                               <input type="number" name="year" id="Year" value="<?php echo $Year ?>" min="1" max="4" step="1" placeholder="Year" class="input_Year" disabled>
                                          </div>
	                          
	                                  <div id="RollNo_form">
                                               <select name="Branch" id="Branch" disabled>
                                                    <option value="<?php echo $Branch ?>" selected ><?php echo $Branch ?></option>
                                                    <option value="Mechnical">Mechnical</option>
                                                    <option value="Electrical">Electrical</option>
                                                    <option value="Civil">Civil</option>
                                                    <option value="Footwear">Footwear</option>
                                                    </select>
	                                 </div>
       
	                                 <div id="RollNo_form">
        
                                       <?php
                                                         require 'db_info.php'; 
                                                         $con=mysqli_connect("localhost","$username","$password","$database");
                                                         $sql="SELECT CourseCode,CourseName FROM CourseTable WHERE Year='$Year' AND Department='$Branch'"; 
                                                         if (!mysqli_query($con,$sql)) {
                                                                  die('Error: ' . mysqli_error($con));
                                                                                      }
                                                        echo "<select name=CourseCode value=''>CourseCode</option>"; // list box select command
                                                        foreach ($con->query($sql) as $row){//Array or records stored in $row
                                                        echo "<option value=$row[CourseCode]>$row[CourseCode]   $row[CourseName]</option>"; 
                                                                                }
                                                        echo "</select>";// Closing of list box
                                        ?>
                                       </div>
 
                                          <div id="RollNo_form">
        
                                                   <?php
                                                         require 'db_info.php'; 
                                                         $con=mysqli_connect("localhost","$username","$password","$database");
                                                         $sql="SELECT HANo FROM HATable"; 
                                                         if (!mysqli_query($con,$sql)) {
                                                             die('Error: ' . mysqli_error($con));
                                                                            }
                                                          echo "<select name=HANo value=''>HANo </option>"; // list box select command
                                                         foreach ($con->query($sql) as $row){//Array or records stored in $row
                                                         echo "<option value=$row[HANo]>$row[HANo]</option>"; 
                                                                                     }
                                                                    echo "</select>";// Closing of list box
                                                     ?>
                                          </div>  
                                                                  
                                                                   <div id="RollNo_form">
                                                                      <select name="QNo" id="QNo"  required>
                                                                      <option value="" selected >Question Numeber</option>
                                                                      <option value="1">1</option>
                                                                      <option value="2">2</option>
                                                                      <option value="3">3</option>
                                                                      <option value="4">4</option>
                                                                      <option value="5">5</option>
                                                                       </select>
	                                                        </div>
                                          <div id="Upload_file">
                 <input type="file" name="file" id="fileinput" value='choose File'/>
           </div>
                                  
                                          <div>
                                            <!--<p id="sign_user" onClick="Submit()">Sign Up </p> -->
		                                <input  id="sign_user" type="submit" name="btn-login">
		                                <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
                                         </div>
                              </form>
                           </div>
                          <!--form ends-->
                       </div>
                  </div>
<!--container ends-->
   </body>
</html> 
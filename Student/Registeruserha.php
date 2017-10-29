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
  $message=$_POST["message"];
  $_SESSION["SESS_RollNo"]=$RollNo;
  $Branch="Branch";
  $Year="Year";
  $Sex="Gender";
  $QNo="Question Number";
   
 
  // echo $name;
	$sql = "SELECT * FROM student_data WHERE RollNo='$RollNo'";
	$result = $con->query($sql);

if ($result->num_rows > 0) {
$query = mysqli_query($con, $sql) or die (mysqli_error()); 
while ($row = mysqli_fetch_array($query)) {  
    // Gather all $row values into local variables 
    $disabled='disabled';
     $_SESSION['SESS_disabled']=$disabled;
         $Email= $row["Email"];  
     $_SESSION['SESS_RollNo']=$RollNo;
    $Branch= $row["Branch"];  
     
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
<script type="text/javascript">
       
       ;(function($){
    $.fn.extend({
        donetyping: function(callback,timeout){
            timeout = timeout || 1e3; // 1 second default timeout
            var timeoutReference,
                doneTyping = function(el){
                    if (!timeoutReference) return;
                    timeoutReference = null;
                    callback.call(el);
                };
            return this.each(function(i,el){
                var $el = $(el);
                // Chrome Fix (Use keyup over keypress to detect backspace)
                // thank you @palerdot
                $el.is(':input') && $el.on('keyup keypress',function(e){
                    // This catches the backspace button in chrome, but also prevents
                    // the event from triggering too premptively. Without this line,
                    // using tab/shift+tab will make the focused element fire the callback.
                    if (e.type=='keyup' && e.keyCode!=8) return;
                    
                    // Check if timeout has been set. If it has, "reset" the clock and
                    // start over again.
                    if (timeoutReference) clearTimeout(timeoutReference);
                    timeoutReference = setTimeout(function(){
                        // if we made it here, our timeout has elapsed. Fire the
                        // callback
                        doneTyping(el);
                    }, timeout);
                }).on('blur',function(){
                    // If we can, fire the event since we're leaving the field
                    doneTyping(el);
                });
            });
        }
    });
})(jQuery);
   
               $(document).ready(function(){
                    $('#Branch').change(function(){
 
                          var Branch=$("#Branch").val();
                          var Year=$("#Year").val();
                          var FirstName=$("#FirstName").val();
                          var LastName=$("#LastName").val();
                          var Email=$("#Email").val();
                          var RollNo=$("#RollNo").val();
                          var Sex=$("#Sex").val();
                            
                           // $('#loadingmessage').show();
                             $('.overlay').show();
                            
                          $.ajax({
                              type:"post",
                              url:"userha.php",
                              data:"Branch="+Branch+"&Year="+Year+"&FirstName="+FirstName+"&LastName="+LastName+"&Email="+Email+"&RollNo="+RollNo+"&Sex="+Sex,
                              success:function(data){
                                $("#info").html(data);
                                 $('.overlay').hide();
                               // $('#loadingmessage').hide();
                                 
                              }
 
                          });
                    });
               });
       </script>
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
    <form name="form" method="post" action="HASubmit.php" enctype="multipart/form-data">
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
        <select name="Branch" id="Branch" <?php echo $disabled ?> required>
          <option value="" selected ><?php echo $Branch ?></option>
          <option value="Mechnical">Mechnical</option>
          <option value="Electrical">Electrical</option>
          <option value="Civil">Civil</option>
          <option value="Footwear">Footwear</option>
        </select>
	  </div>
       <div class="overlay">
    <div id="loading-img"></div>
</div>
	  <div id="RollNo_form">
        
        <?php
        require 'db_info.php'; 
        //$CourseTable='CourseTable';
        //$TableName= $CourseTable. "_" .$Branch;
         
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
          <option value="" selected ><?php echo $QNo?></option>
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
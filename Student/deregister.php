<?php 
session_start();


/*** begin our session ***/
if(isset($_POST['deregisteruser']))
{
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
$deregisterRollNo =mysqli_real_escape_string ($con, $_POST['deregisterRollNo']);
$sql="SELECT * From student_data where RollNo='$deregisterRollNo'";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) 
{
while($row = mysqli_fetch_assoc($result)) { 
    // Gather all $row values into local variables 
    $Email= $row["Email"];  
    $FullName= $row["FullName"];
    }
    $code=rand(1000,999999);
    $code1='@$vc';
    $code2='r42sw';
    $deregistrationcode=$code1."".$code."".$code2;
    $user_email='doms@shubhamagarwal.co.in';
    $to = $Email;
    // $to = 'shiksha000@gmail.com';
$subject = 'Deregistration Mail';
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//$headers .= 'From: <shubhamagarwal.co.in>' . "\r\n"; 
// Create email headers
$headers .= 'From: '.$user_email."\r\n".
    'Reply-To: '.$user_email."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message

$message =  '<html xmlns="http://www.w3.org/1999/xhtml">';
$message .= '<head>';
$message .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
$message .= '</head>';
$message .= '<body>';
$message .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
$message .= ' <tr>';
$message .=  '<td align="center" valign="top" bgcolor="#f6f3e4" style="background-color:#f6f3e4;"><br>';
$message .= ' <br>';
$message .= ' <table width="800" border="0" cellspacing="0" cellpadding="0">';
$message .= '  <tr>';
$message .= '<td align="center" valign="top" style="padding-left:13px; padding-right:13px; background-color:#ffffff;"><table width="100%" border="0"            cellspacing="0" cellpadding="0">';
$message .= '          <tr>';
$message .= ' <td><table width="84" border="0" cellspacing="0" cellpadding="0">';
$message .= '<tr>';
$message .= '<td align="left" valign="middle" style="padding-top:15px;"><img src="http://shubhamagarwal.co.in/DOMS/Student/images/engineeringLogo.png" width="300" height="100"></td>';
$message .='        </tr>';
$message .='         </table></td>';
$message .=' </tr>';
$message .='          <tr>';
$message .='             <div><br>';
$message .='             </div>';
$message .='<td align="center" valign="middle" style="font-family:Georgia, Times New Roman, Times, serif; font-size:40px;"><i> WelCome To D@MS</i></td>';
$message .='  </tr>';
$message .='     <tr>';
$message .=' <td align="center" valign="middle" style="padding-top:7px;"><table width="240" border="0" cellspacing="0" cellpadding="0"> <tr>';
$message .='<td align="center" valign="middle" style="padding-bottom:15px; padding-top:15px;"><img src="http://shubhamagarwal.co.in/DOMS/Student/images/divider.gif" width="800" height="28"></td>';
$message .=' </tr>';
$message .=' </table></td>';
$message .=' </tr>';

$message .=' <tr>';
$message .='<td align="center" valign="middle" style="padding-top:15px;"><img src="http://shubhamagarwal.co.in/DOMS/Student/images/header.jpg" width="800" height="243" style="display:block;"></td>';
$message .=' </tr>';

$message .=' <tr>';
$message .='<td align="center" valign="middle" style="padding-bottom:15px; padding-top:15px;"><img src="http://shubhamagarwal.co.in/DOMS/Student/images/divider.gif" width="800" height="28"></td>';
$message .=' </tr>';
$message .='  <tr>';
$message .='<td align="center" valign="middle" style="font-family: CinzelDecorative-Regular.ttf,Georgia, Times New Roman, Times, serif; color:#000000; font-size:24px; padding-bottom:5px;"><i>Hello ,'.$FullName.'</i>';
$message .='  <tr>';
$message .='<td align="left" valign="middle" style="font-family:Georgia, Times New Roman, Times, serif; color:#000000; font-size:15px;">You deregistration link is: http://shubhamagarwal.co.in/DOMS/Student/forgot.php?deregistrationcode='.$deregistrationcode.'</div>';
$message .='  <tr>';
$message .='<td align="center" valign="middle" style="padding-bottom:15px; padding-top:15px;"><img src="http://shubhamagarwal.co.in/DOMS/Student/images/divider.gif" width="800" height="28"></td>';
$message .='  </tr>';
$message .='         <tr>';
$message .='<td align="left" valign="middle" style="font-family:Georgia, Times New Roman, Times, serif; font-size:12px; color:#000000;">';
$message .='<div style="color:#b30467; font-size:15px;"><b>Contact Us</b></div>';
$message .='               <br>';
             
              
$message .='               <div><br>';
 $message .='               Faculty Of Engineering<br>';
$message .='DayalBagh Educational Institute,   <br>';
$message .='DayalBagh,<br>';
$message .='Agra ';
$message .='282005<br>';
$message .='<br>';
$message .='<br>';
$message .='<br>';
$message .='              </div></td>';
$message .='          </tr>';
$message .='        </table></td>';
$message .='      </tr>';
$message .='    </table>';
$message .='    <br>';
$message .='    <br></td>';
$message .='  </tr>';
$message .='  <tr>';
$message .='    <td align="center" valign="top">&nbsp;</td>';
$message .='  </tr>';
$message .='</table> ';
$message .='</body>';
$message .='</html>';
            
// Sending email
mail($to, $subject, $message, $headers);
$sql="INSERT INTO deregistruser (deregistrationcode,RollNo)
  VALUES ('$deregistrationcode', '$deregisterRollNo')";
  if (mysqli_query($con, $sql)) {
    $errmsg_arr[] = 'Deregistration Link Has Been Send To '.$Email.'';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: deregister.php");
				exit();
			}
                               

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}


                       } 
  
else
{
echo "No user exist with this email id";
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
</head>
<body>
<div id="info" />
<div id="emptyDiv"></div>
<div id="description"></div>
<!--container start-->
<div id="container">
  <div id="container_body">
    <div>
      <h2 class="form_title">Welcome To D@MS</h2>
    </div>
    <!--Form  start-->
    <div id="form_name">
        <form name="form" action="deregister.php" method="post">
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
        <div id="RollNo_form">
        <input type="text" name="deregisterRollNo" id="deregisterRollNo" value=""  placeholder="Your Roll NO" class="RollNo" required>
      </div> 
      
       <div>
          
		  <input  id="deregisteruser" type="submit" name="deregisteruser">
		<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
      </div>
         
    <div id="info" />
       
     </form>
    </div>
    <!--form ends-->
  </div>
</div>
<!--container ends-->
 
 </body>
 </html>
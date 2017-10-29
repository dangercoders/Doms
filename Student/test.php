<?php
/*
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
 $user_email='dangercoders@gmail.com';
$sql = "SELECT Email, FullName FROM CourseMentor_data";
$query = mysqli_query($con, $sql) or die (mysqli_error()); 
if (!mysqli_query($con,$sql)) {
  die('Error1: ' . mysqli_error($con));
             }
$Email=array();
$FullName=array();
while ($row = mysqli_fetch_assoc($query)) {  
    // Gather all $row values into local variables 
    $Email[]= $row["Email"];  
    $FullName[]= $row["FullName"];
    }
    $Email=array_filter($Email);
    $FullName=array_filter($FullName);
    for($i=0;$i<count($Email);$i++){
     
   //$to = $Email[$i];
     $to = 'shiksha000@gmail.com';
$subject = 'Sample MAIL';
 
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
$message .='<td align="center" valign="middle" style="font-family: CinzelDecorative-Regular.ttf,Georgia, Times New Roman, Times, serif; color:#000000; font-size:24px; padding-bottom:5px;"><i>Hello ,'.$FullName[$i].'</i>';
$message .='  <tr>';
$message .='<td align="left" valign="middle" style="font-family:Georgia, Times New Roman, Times, serif; color:#000000; font-size:15px;">Thank You For Register. Please ignore It is Test Mail.</div>';
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
if(mail($to, $subject, $message, $headers)){
    echo 'Your mail has been sent successfully.';
} else{
    echo 'Unable to send email. Please try again.';
}
     
                       } 
               */         
?>

<html>
<head>
<script type="text/javascript">

var popupWindow=null;

function child_open()
{ 

popupWindow =window.open('new.php',"_blank","directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,width=600, height=280,top=200,left=200");

}
function parent_disable() {
if(popupWindow && !popupWindow.closed)
popupWindow.focus();
}
</script>
</head>
<body onFocus="parent_disable();" onclick="parent_disable();">
    <a href="javascript:child_open()">Click me</a>
</body>    
</html>
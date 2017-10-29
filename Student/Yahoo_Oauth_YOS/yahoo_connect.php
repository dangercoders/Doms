<?php
session_start();
// Include the YOS library.
require 'lib/Yahoo.inc';
include 'db_info.php';



define('OAUTH_CONSUMER_KEY', 'dj0yJmk9aE5tSlpvaVZINldoJmQ9WVdrOWJtOXBjSEpVTnpnbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD0zYQ--'); // Place Yoru Consumer Key here
define('OAUTH_CONSUMER_SECRET', 'c0ec2c092a9ca63558968801666bc1611bfd23dd'); // Place your Consumer Secret
define('OAUTH_APP_ID', 'noiprT78'); // Place Your App ID here

if (array_key_exists("login", $_GET)) {
    $session = YahooSession::requireSession(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, OAUTH_APP_ID);
    if (is_object($session)) {
        $user = $session->getSessionedUser();
        $profile = $user->getProfile();
        $name = $profile->nickname; // Getting user name
        $guid = $profile->guid; // Getting Yahoo ID
         
$sql = "SELECT * from student_data where Email = :email_id";
  try {
    $stmt = $DB->prepare($sql);
    $stmt->bindValue(":email_id", $profile->guid);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if ($result[0] > 0) {
      // User Exist 

      //$_SESSION["SESS_RollNo"] = $user->RollNo;
      $_SESSION["SESS_Email"] = $profile->guid;
       
    } else {
       $errmsg_arr[] = 'You Are Not Registered!!';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: student_login.php");
				exit();
			}
    }
  } catch (Exception $ex) {
    $_SESSION["e_msg"] = $ex->getMessage();
  }
          }
          header("location:student_home.php");
exit;
          }

?>
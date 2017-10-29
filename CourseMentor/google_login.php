<?php
require('http.php');
require('oauth_client.php');
require('config.php');
$errmsg_arr = array();
 
	//Validation error flag
	$errflag = false;

$client = new oauth_client_class;

// set the offline access only if you need to call an API
// when the user is not present and the token may expire
$client->offline = FALSE;

$client->debug = false;
$client->debug_http = true;
$client->redirect_uri = REDIRECT_URL;

$client->client_id = CLIENT_ID;
$application_line = __LINE__;
$client->client_secret = CLIENT_SECRET;

if (strlen($client->client_id) == 0 || strlen($client->client_secret) == 0)
  die('Please go to Google APIs console page ' .
          'http://code.google.com/apis/console in the API access tab, ' .
          'create a new client ID, and in the line ' . $application_line .
          ' set the client_id to Client ID and client_secret with Client Secret. ' .
          'The callback URL must be ' . $client->redirect_uri . ' but make sure ' .
          'the domain is valid and can be resolved by a public DNS.');

/* API permissions
 */
$client->scope = SCOPE;
if (($success = $client->Initialize())) {
  if (($success = $client->Process())) {
    if (strlen($client->authorization_error)) {
      $client->error = $client->authorization_error;
      $success = false;
    } elseif (strlen($client->access_token)) {
      $success = $client->CallAPI(
              'https://www.googleapis.com/oauth2/v1/userinfo', 'GET', array(), array('FailOnAccessError' => true), $user);
    }
  }
  $success = $client->Finalize($success);
}
if ($client->exit)
  exit;
if ($success) {
  // Now check if user exist with same email ID
 // $sql = "SELECT * from CourseMentor_data where Email = :email_id";
 $sql = "SELECT * from MetroUser where Email = :email_id";
  try {
    $stmt = $DB->prepare($sql);
    $stmt->bindValue(":email_id", $user->email);
    $stmt->execute();
    $result = $stmt->fetchAll();
$email=$user->email;
    $name=$user->name;
    $id=$user->id;
    if ($result[0] > 0) {
    
      // User Exist
      $response = array();
      $response["user"] = array();
       $user= array();
        $user["email"] = $email;
        $user["name"] = $name;
        $user["userid"] = $id;
        $user["Source"] = "NULL";
        $user["Dest"] = "NULL";
        array_push($response["user"], $user);
        $response["success"] = 1;
        echo json_encode($response);
       
    } else {
    /*
       $errmsg_arr[] = 'user name and password not found';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: CourseMentor_login.php");
				exit();
			}*/
			
			require 'db_info.php';
   
    
$con=mysqli_connect("localhost","$username","$password","$database");
			$sql="INSERT INTO MetroUser (FullName, Email,UserId)
  VALUES ('$name','$email','$id')";
  mysqli_query($con,$sql);
			//$_SESSION["SESS_CourseMentorEmail"] = $user->email;
			$response = array();
      $response["user"] = array();
       $user= array();
        $user["email"] = $email;
        $user["name"] = $name;
        $user["userid"] = $id;
        $user["Source"] = "NULL";
        $user["Dest"] = "NULL";
        array_push($response["user"], $user); 
        $response["success"] = 1;
        echo json_encode($response); 
       
     
        
    }
  } catch (Exception $ex) {
    $_SESSION["e_msg"] = $ex->getMessage();
  }

  $_SESSION["user_id"] = $user->id;
} else {
  $_SESSION["e_msg"] = $client->error;
}


//header("location:CourseMentor_home.php");

exit;
?>
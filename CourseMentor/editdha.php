<?php
session_start();
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
$CourseMentorEmail=$_SESSION['SESS_CourseMentorEmail'];
if(!isset($CourseMentorEmail)){
//mysql_close($con); // Closing Connection
header('Location: CourseMentor_login.php'); // Redirecting To Home Page
}
if(!isset($_SESSION['SESS_CourseCode'])&&(!isset($_SESSION['SESS_AssNo']))){
 
$CourseCode =mysqli_real_escape_string ($con, $_POST['CourseCode']);
$AssNo =mysqli_real_escape_string ($con, $_POST['AssNo']);
$_SESSION['SESS_CourseCode']=$CourseCode;
$_SESSION['SESS_AssNo']=$AssNo;
}
?>	
<? require_once('includes/header.html');?>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>D@MS ADD DHA</title>
<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="img/favicon.ico">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<link href="libs/js/bootstrap/dist/css/bootstrap.css" rel="stylesheet" media="screen" />
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/custom.css">
<script src="libs/js/bootstrap/docs-assets/js/holder.js"></script>
<script src="libs/js/jquery.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="js/add_new.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
   
   // view products on load of the page
//$('#loader-image').show();
showQuestion();
 
// clicking the 'read products' button
$('#ShowDhaQuestion').click(function(){
     
    // show a loader img
    $('#loader-image').show();
     
    // show create product button
   // $('#AddDhaQuestion').show();
     
    // hide read products button
    $('#ShowDhaQuestion').show();
     
    //show Question
    showQuestion();
});
 
// show Question
function showQuestion(){
         
    // change page title
    //changePageTitle('Read Products');
     
    // fade out effect first
    $('#page-content').fadeOut('fast', function(){
        $('#page-content').load('ShowDhaQuestion.php', function(){
            // hide loader image
            $('#loader-image').hide(); 
             
            // fade in effect
            $('#page-content').fadeIn('fast');
        });
    });
}
   
   
     
    // will show the create product form
    $('#AddDha').click(function(){
        // change page title
       // changePageTitle('Create Product');
           $(location).attr('href','http://shubhamagarwal.co.in/DOMS/CourseMentor/AddQuiz.php');
  //  document.location.href = "http://www.shubhamagarwal.co.in/DOMS/CourseMentor/editdha.php";
     
        // show create product form
        // show a loader image
        $('#loader-image').show();
         
        // hide create product button
      //  $('#AddDhaQuestion').hide();
         
        // show read products button
        $('#ShowDhaQuestion').show();
         
        // fade out effect first
        $('#page-content').fadeOut('fast', function(){
            $('#page-content').load('create_form.php', function(){ 
             
                // hide loader image
                $('#loader-image').hide(); 
                 
                // fade in effect
                $('#page-content').fadeIn('fast');
            });
        });
    });
});

 /*
// will run if create product form was submitted
$(document).on('submit', '#AddDhaQuestion_form', function() {
 
   var formData = new FormData($('form')[0]);
    $.ajax({
        url: 'ShowDhaQuestion.php',  //Server script to process data
        type: 'POST',
        xhr: function() {  // Custom XMLHttpRequest
            var myXhr = $.ajaxSettings.xhr();
            if(myXhr.upload){ // Check if upload property exists
                myXhr.upload.addEventListener('progress',progressHandlingFunction, false); // For handling the progress of the upload
            }
            return myXhr;
        },
        //Ajax events
        beforeSend: beforeSendHandler,
        success: completeHandler,
        error: errorHandler,
        // Form data
        data: formData,
        //Options to tell jQuery not to process data or worry about content-type.
        cache: false,
        contentType: false,
        processData: false
    });
    return false;
});
*/
// clicking the edit button
$(document).on('click', '.edit-btn', function(){ 
 
    // change page title
   // changePageTitle('Update Product');
 
    var questionid = $(this).closest('td').find('.questionid').text();
     
    // show a loader image
    $('#loader-image').show();
     
    // hide create product button
   // $('#AddDhaQuestion').hide();
     
    // show read products button
    $('#ShowDhaQuestion').show();
 
    // fade out effect first
    $('#page-content').fadeOut('fast', function(){
        $('#page-content').load('UpdateDhaForm.php?questionid=' + questionid, function(){
            // hide loader image
            $('#loader-image').hide(); 
             
            // fade in effect
            $('#page-content').fadeIn('fast');
        });
    });
}); 
/*
// will run if update product form was submitted
$(document).on('submit', '#UpdateDhaQuestion_form', function() {
 
    // show a loader img
    $('#loader-image').show();
     
    // post the data from the form
    $.post("UpdateDhaQuestion.php", $(this).serialize())
        .done(function(data) {
             
            // show create product button
          //  $('#AddDhaQuestion').show();
             
            // hide read products button
            $('#ShowDhaQuestion').show();
         
            // 'data' is the text returned, you can do any conditions based on that
            $('#page-content').fadeOut('fast', function(){
        $('#page-content').load('ShowDhaQuestion.php', function(){
            // hide loader image
            $('#loader-image').hide(); 
             
            // fade in effect
            $('#page-content').fadeIn('fast');
        });
    });
        });
             
    return false;
});
*/
$(document).on('click', '.delete-btn', function(){ 
    if(confirm('Are you sure?')){
     
        // get the id
        var questionid = $(this).closest('td').find('.questionid').text();
         
        // trigger the delete file
        $.post("delete.php", { questionid: questionid})
            .done(function(data){
                console.log(data);
                 
                // show loader image
                $('#loader-image').show();
                 
                // reload the product list
                $('#page-content').fadeOut('fast', function(){
        $('#page-content').load('ShowDhaQuestion.php', function(){
            // hide loader image
            $('#loader-image').hide(); 
             
            // fade in effect
            $('#page-content').fadeIn('fast');
        });
    });
                 
            });
    }
});

</script>
<style>
body{
 font-family:Tahoma, Geneva, sans-serif;
 background: #009688;
 }
 
</style>          
</head>
<body>
<div id="info" />
<div class="col-sm-14 contentBody">
			<!-- BEGIN Content -->
				<div class="container-fluid">
					
					<div class="row">
						<div class="col-xs-12">
							<div>
								<h4>
									
								</h4>
								<h4>
									
								</h4>
							</div>
							<div class='margin-bottom-1em overflow-hidden'>
                                                      <!-- when clicked, it will show the products list -->
                                                        <div id='ShowDhaQuestion' class='btn btn-primary pull-right display-none'>
                                                           <span class='glyphicon glyphicon-list'></span> Show Question
                                                        </div>
                                                        
                                                      <!-- when clicked, it will load the create product form -->
                                                            <div id='AddDha' class='btn btn-success pull-right'>
                                                                <span class='glyphicon glyphicon-ok'></span> Finish
                                                            </div>
     
                                                    <!-- this is the loader image, hidden at first -->
                                                            <div id='loader-image'><img src='images/ajax-loader.gif' /></div>
                                                            </div>
							<br>
							<br>
							<!-- this is where the contents will be shown. -->
                                                                 <div id='page-content'></div>
							 </div>
							 </div>
				<!-- END Content -->
<!--
			</div>
		</div>
		 END Content Body -->
		 
</body>
</html>
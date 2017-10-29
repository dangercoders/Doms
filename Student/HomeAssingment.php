<?php 
session_start();
$errmsg_arr = array();
 
	//Validation error flag
	$errflag = false;
	        unset($_SESSION['SESS_RollNo']);
                unset($_SESSION['SESS_FullName']);
		unset($_SESSION['SESS_Email']);
		unset($_SESSION['SESS_Gender']);
		unset($_SESSION['SESS_Year']);
		unset($_SESSION['SESS_Branch']);
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
                    $('#RollNo').donetyping(function(){
 
                          var RollNo=$("#RollNo").val();
                          var message=$("#message").val();
                          $('.overlay').show();
                          $.ajax({
                              type:"post",
                              url:"Registeruserha.php",
                              data:"RollNo="+RollNo+"&message="+message,
                              success:function(data){
                                $("#info").html(data);
                                 
                                 $('.overlay').hide();
                                 
                              }
 
                          });
 
                    });
                  
			      	   
		 
               });
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
      <h2 class="form_title">Welcome To D@MS</h2>
    </div>
    <!--Form  start-->
    <div id="form_name">
        
        <div id="RollNo_form">
        <input type="text" name="RollNo" id="RollNo" value=""  placeholder="Your Roll NO" class="RollNo" required>
      </div> 
      <div class="overlay">
    <div id="loading-img"></div>
</div>
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
      <div id='loadingmessage' style='display:none'>
                   <img src='ajax-loader.gif'/>
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
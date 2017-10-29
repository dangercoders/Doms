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
                    $('#sign_user').click(function(){
 
                          var RollNo=$("#RollNo").val();
                          var Securityanswer=$("#Securityanswer").val();
                           var Securityquestion=$("#Securityquestion").val();
                          $('.overlay').show();
                          $.ajax({
                              type:"post",
                              url:"date.php",
                              data:"RollNo="+RollNo+"&Securityanswer="+Securityanswer+"&Securityquestion="+Securityquestion,
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
      
      <div id="RollNo_form">
        <select name="Securityquestion" id="Securityquestion" required>
          <option value="" selected >Select Security Question </option>
          <option value="What was your childhood nickname?">What was your childhood nickname?</option>
          <option value="What was your favorite place to visit as a child?">What was your favorite place to visit as a child?</option>
          <option value="What is your favorite movie?">What is your favorite movie?</option>
          <option value="What is your favorite color?">What is your favorite color?</option>
          <option value="Which phone number do you remember most from your childhood?">Which phone number do you remember most from your childhood?</option>
          <option value="What is the name of a college you applied to but didnt attend?">What is the name of a college you applied to but didnt attend?</option>
          <option value="What is the name of your favorite childhood friend?"> What is the name of your favorite childhood friend?</option>
          <option value="What was the second best birthday present you ever got?">What was the second best birthday present you ever got?</option>
          
        </select>
	  </div>
	  
	  <div id="email_form">
        <input type="text" name="Securityanswer" id="Securityanswer" value=""  placeholder="Your Security Answer" class="input_email" required>
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
         <div>
          
		  <input  id="sign_user" type="submit" name="btn-signup">
		<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
      </div>
      <div>
      <h1> For Deregistration Please <a href="deregister.php">Click Here</a></h1>
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
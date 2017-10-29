<?php
session_start();
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
<link href="css/jasny-bootstrap.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="js/jasny-bootstrap.min.js"></script>
<script src="js/add_new.js"></script>           
 </head>                                                           
                   <body>                                         
                                                            
                                                            
                                                            
                                                            
                                                            <form class="form-horizontal" id='AddDhaQuestion_form1' method="post" enctype="multipart/form-data">
				<div class="form-group">
														 
						<textarea rows="8" cols="120" class="question form-control" name="question" id="question" placeholder="Question" value="" required></textarea>
				</div>
													         
			        <div class="form-inline">                                                                                       
					<div class="form-group">
			         	      <div class="col-sm-offset-1">
											<textarea rows="5" cols="30" class="form-control" name="answer" id="answer" placeholder="Correct Answer" value="" required></textarea>
													</div>
													        </div>
													<div class="form-group">
													        <div class="col-sm-offset-3">
														<textarea rows="5" cols="30" class="form-control" id="choice1" placeholder="Wrong Answer 1" value=""></textarea>
													</div>
													         </div>
													           
													<div class="form-group">
													     <div class="col-sm-offset-5">
														<textarea rows="5" cols="30" class="form-control" name="choice2" id="choice2" placeholder="Wrong Answer 2" value=""></textarea>
													</div>
													      </div>
													        
													<div class="form-group">
													    <div class="col-sm-offset-7">
														<textarea rows="5" cols="30" class="form-control" name ="choice3" id="choice3" placeholder="Wrong Answer 3" value=""></textarea>
													</div>
													    </div>
													     </div>
													   <p><?php echo $_SESSION['SESS_File']; ?></p>
						
						 <br>	
					<div class="row-inline">	 					    
						 
						<div class="form-group">
						<div class="col-sm-12 col-sm-offset-8">
							<div class="fileinput fileinput-new" data-provides="fileinput">
  <span class="btn btn-default btn-file"><span class="fileinput-new">Select file</span>
  <span class="fileinput-exists">Change</span><input type="file" class="file" name="file" id="file"></span>
  <span class="fileinput-filename"></span>
  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
</div>
						</div>
						
						 </div>
						 
						 <div class="form-group">
							<div class="col-sm-12 col-sm-offset-8">
							  <button class="btn btn-primary" type="submit" name="button">
								<span class='glyphicon glyphicon-plus'></span> Save Question</button>
							</div>
						</div>
						
				</div>
							</form>
							<!-- this is where the contents will be shown. -->
                                                             <div id='page-content'></div>
</body>
</html>							
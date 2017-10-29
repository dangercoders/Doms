<?php
session_start();
$CourseCode=$_SESSION['SESS_CourseCode'];
$AssNo=$_SESSION['SESS_AssNo'];
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
$questionid=isset($_GET['questionid']) ? $_GET['questionid'] : die('ERROR: question ID not found.');
$sql = "SELECT * FROM $CourseCode WHERE questionid= '$questionid'";
 if (!mysqli_query($con,$sql)) {
                           die('Error: ' . mysqli_error($con));
                       }
 $query = mysqli_query($con, $sql); 
while ($row = mysqli_fetch_array($query)) {  
          $questionid=$row["questionid"];
          $question=$row["name"];
          $_SESSION['SESS_questionid']=$questionid;
          $choice1=$row["choice1"];
          $choice2=$row["choice2"];
          $choice3=$row["choice3"];
          $answer=$row["answer"]; 
         $Image=$row["Image"];
  }
 ?>
 
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
<script src="js/jasny-bootstrap.min.js"></script>
<link href="css/jasny-bootstrap.min.css" rel="stylesheet" media="screen">
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="js/add_new.js"></script>  
<style>
body{
 font-family:Tahoma, Geneva, sans-serif;
 background: #009688;
 }
 
 </style>
</head>         
<body> 
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
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h4 class="panel-title"><?php echo $_SESSION['SESS_CourseCode']." ".$_SESSION['SESS_AssNo']; ?>  </h4>
								</div>
								<div class="panel-body text-left row">
									<div class="col-sm-12 col-md-12 col-xs-12">
									
									<!-- Form For ADD DHA Question -->				
				
		
                                                            <form class="form-horizontal" action="UpdateDhaQuestion.php" id='UpdateDhaQuestion_form' method="post" enctype="multipart/form-data">
				<div class="form-group">
							<div class="col-sm-12 col-md-12 col-xs-12">							 
						<textarea rows="8" cols="120" class="question form-control" name="question" id="question" placeholder="Question" value="" required><?php echo $question; ?></textarea>
				</div>
				       </div>									         
			        <div class="form-inline">                                                                                       
					<div class="form-group">
			         	      <div class="col-sm-12 col-md-10 col-xs-12 col-sm-offset-1">
											<textarea rows="5" cols="30" class="form-control" name="answer" id="answer" placeholder="Correct Answer" value="" required><?php echo $answer; ?></textarea>
													</div>
													        </div>
													<div class="form-group">
													        <div class="col-sm-12 col-md-10 col-xs-12 col-sm-offset-1">
														<textarea rows="5" cols="30" class="form-control" name="choice1" id="choice1" placeholder="Wrong Answer 1" value=""><?php echo $choice1; ?></textarea>
													</div>
													         </div>
													           
													<div class="form-group">
													     <div class="col-sm-12 col-md-10 col-xs-12 col-sm-offset-1">
														<textarea rows="5" cols="30" class="form-control" name="choice2" id="choice2" placeholder="Wrong Answer 2" value=""><?php echo $choice2; ?></textarea>
													</div>
													      </div>
													        
													<div class="form-group">
													    <div class="col-sm-12 col-md-10 col-xs-12 col-sm-offset-1">
														<textarea rows="5" cols="30" class="form-control" name="choice3" id="choice3" placeholder="Wrong Answer 3" value=""><?php echo $choice3; ?></textarea>
													</div>
													    </div>
													     </div>
											 
                                                                                <!-- hidden ID field so that we could identify what record is to be updated -->
                                                                                         <input type='hidden' name='questionid' value='<?php echo $questionid ?>' /> 	   
						
						 <br>	
						<div class="form-inline">
							<div class="col-sm-2 col-sm-offset-2">  
	                                                  
	                                             <div class="form-group">
							<div class="col-sm-12 col-sm-offset-2">
							   <?php
						                             if($Image!=NULL){
		                                                          ?>
		                                     <div>			       								     
                                                        <img src="../Student/dhauploads/<?php echo $Image; ?>" class="img-rounded" height="200" width="200">
                                                     </div>
                                                                    <?php
                                                                               }
                                                                     ?>	
							 
						</div>	
						  </div>
						   </div>	
						<div class="col-sm-2 col-sm-offset-4"> 
						<div class="form-group">
							<div class="col-sm-12 col-sm-offset-4">
							   <div class="fileinput fileinput-new" data-provides="fileinput">
  <span class="btn btn-default btn-file"><span class="fileinput-new">Select file</span>
  <span class="fileinput-exists">Change</span><input type="file" name="file" id="file"></span>
  <span class="fileinput-filename"></span>
  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
</div>
							</div>
						</div>
						</div>
							<div class="col-sm-2 col-sm-offset-2">     
						<div class="form-group">
							<div class="col-sm-12 col-sm-offset-4">
							   <button type='submit' class='btn btn-primary'>
                                                                   <span class='glyphicon glyphicon-saved'></span> Save Changes
                                                           </button>
							</div>
						</div>
						   </div>
						   </div>
							</form>
							<!-- this is where the contents will be shown. -->
                                                             <div id='page-content'></div>
                                                             
                                                             </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END Content -->
<!--
			</div>
		</div>
		 END Content Body -->
</body>
</html>						  
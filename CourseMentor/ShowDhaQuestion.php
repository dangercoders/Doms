<?php
session_start();
require 'db_info.php';
$con=mysqli_connect("localhost","$username","$password","$database");
$CourseCode=$_SESSION['SESS_CourseCode'];
$AssNo=$_SESSION['SESS_AssNo'];  	 
?>	
<? require_once('includes/header.html');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 //EN">
<html>
<head>
<!-- custom CSS -->
<style>
.display-none{
    display:none;
}
</style>
<title>D@MS Show Question</title>
<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="img/favicon.ico">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/custom.css">
<link href="css/jasny-bootstrap.min.css" rel="stylesheet" media="screen">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src="js/jasny-bootstrap.min.js"></script>
<script src='jquery.autosize.js'></script>
<script>
$(function(){
$('#question').autosize({append: "\n"});
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
									<h4 class="panel-title"><?php echo $CourseCode." ".$AssNo; ?>  </h4>
								</div>
								<div class="panel-body text-left row">
									<div class="col-sm-12 col-md-12 col-xs-12">
									
									<!-- Form For ADD DHA Question -->				
				
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">

        <a class="btn btn-primary btn-lg btn-block" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         ADD DHA QUESTION 
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
				<!-- start here -->
				
				<form class="form-horizontal" action="AddDhaQuestion.php" id='AddDhaQuestion_form' method="post" enctype="multipart/form-data">
				<div class="form-group">
							<div class="col-sm-12 col-md-12 col-xs-12">							 
						<textarea rows="8" cols="100" class="question form-control" name="question" id="question" placeholder="Question" value="" required> </textarea>
				</div>
					</div>								         
			        <div class="form-inline">                                                                                       
					<div class="form-group">
			         	      <div class="col-sm-12 col-md-10 col-xs-12 col-sm-offset-1">
											<textarea rows="5" cols="30" class="form-control" name="answer" id="answer" placeholder="Correct Answer" value="" required></textarea>
													</div>
													        </div>
													<div class="form-group">
													        <div class="col-sm-12 col-md-10 col-xs-12 col-sm-offset-1">
														<textarea rows="5" cols="30" class="form-control" name="choice1" id="choice1" placeholder="Wrong Answer 1" value=""></textarea>
													</div>
													         </div>
													           
													<div class="form-group">
													     <div class="col-sm-12 col-md-10 col-xs-12 col-sm-offset-1">
														<textarea rows="5" cols="30" class="form-control" name="choice2" id="choice2" placeholder="Wrong Answer 2" value=""></textarea>
													</div>
													      </div>
													        
													<div class="form-group">
													    <div class="col-sm-12 col-md-10 col-xs-12 col-sm-offset-1">
														<textarea rows="5" cols="30" class="form-control" name ="choice3" id="choice3" placeholder="Wrong Answer 3" value=""></textarea>
													</div>
													    </div>
													     </div>
													   <p><?php echo $_SESSION['SESS_File']; ?></p>
						
						 <br>	
					<div class="form-inline">	 					    
						 <div class="col-sm-2 col-sm-offset-4"> 
						<div class="form-group">
						<div class="col-sm-12 col-sm-offset-4">
							<div class="fileinput fileinput-new" data-provides="fileinput">
  <span class="btn btn-default btn-file"><span class="fileinput-new">Select file</span>
  <span class="fileinput-exists">Change</span><input type="file" class="file" name="file" id="file"></span>
  <span class="fileinput-filename"></span>
  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
</div>
						</div>
						     </div>
						 </div>
						 <div class="col-sm-2 col-sm-offset-2"> 
						 <div class="form-group">
							<div class="col-sm-12 col-sm-offset-4">
							  <button class="btn btn-primary" type="submit" name="button">
								<span class='glyphicon glyphicon-plus'></span> Save Question</button>
							</div>
						</div>
						
				</div>
				</div>
							</form>
								</div>
    </div>
  </div>
</div>	
									
											<?php
											require 'db_info.php';
                                                                                        $con=mysqli_connect("localhost","$username","$password","$database");
											$sql = "SELECT * FROM $CourseCode WHERE AssNo='$AssNo'";
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
                                                                                                       ?>
																
				
				
				
				
				
				
				
				
				<!-- Form For DHA Question -->
				
				
								
												
												
												<form class="form-horizontal" method="post">
													<div class="form-group">
														 <div class="col-sm-12 col-md-12 col-xs-12">            
														<textarea rows="8" cols="70" class="form-control" id="question" placeholder="Question" value="" disabled><?php echo $question; ?></textarea> 
													</div>
													       </div>  
													       
													       <div class="form-group">
							<div class="col-sm-12 col-sm-offset-6">
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
													       
													            <div class="form-inline">
	                                                                                                              
													<div class="form-group">
													      <div class="col-sm-12 col-md-10 col-xs-12 col-sm-offset-1">
														<textarea rows="5" cols="30" class="form-control" id="answer" placeholder="Correct Answer" value="" disabled><?php echo $answer; ?></textarea>
													</div>
													        </div>
													<div class="form-group">
													        <div class="col-sm-12 col-md-10 col-xs-12 col-sm-offset-1">
														<textarea rows="5" cols="30" class="form-control" id="choice1" placeholder="Wrong Answer 1" value="" disabled><?php echo $choice1; ?></textarea>
													</div>
													         </div>
													           
													<div class="form-group">
													     <div class="col-sm-12 col-md-10 col-xs-12 col-sm-offset-1">
														<textarea rows="5" cols="30" class="form-control" id="choice2" placeholder="Wrong Answer 2" value="" disabled><?php echo $choice2; ?></textarea>
													</div>
													      </div>
													        
													<div class="form-group">
													    <div class="col-sm-12 col-md-10 col-xs-12 col-sm-offset-1">
														<textarea rows="5" cols="30" class="form-control" id="choice3" placeholder="Wrong Answer 3" value="" disabled><?php echo $choice3; ?></textarea>
													</div>
													    </div>
													     </div>
										 		     <br>
						<div class="col-sm-offset-8">
						  	
						 <table>					    
			                         
	                                            <tr>                
	                                         <td>
                                                 <div class='questionid display-none'><?php echo $questionid; ?></div>
                                                 <!--
                                                 <div class="form-inline">
	                                                  <div class="col-sm-2 col-sm-offset-2">  
	                                                  
	                                             <div class="form-group">
							<div class="col-sm-12 col-sm-offset-6">
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
                                                             -->
                                                       <div class="col-sm-2 col-sm-offset-4"> 
                                                           					 					     
						<div class="form-group">
							<div class="col-sm-12 col-sm-offset-4">
							       <div class='btn btn-info edit-btn'>
                                                                 <span class='glyphicon glyphicon-edit'></span> Edit
                                                             </div>
								 
							</div>
						</div>
							</div>
							
							<div class="col-sm-2 col-sm-offset-2">


						<div class="form-group">
							<div class="col-sm-12 col-sm-offset-4">
							         
								<div class='btn btn-danger delete-btn'>
                                                                   <span class='glyphicon glyphicon-remove'></span> Delete
                                                                </div>
							</div>
					</div>
						</div> 
						
                                        </div>
						</td>
						</tr>
							
						</table>						
									</div>			
												</form>
										<?php		
											}
											   ?>
										
										 
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
$(document).ready(function(){
                    $('#Delete').click(function(){
 
                          var questionid=$("#questionid").val();
                          var question=$("#question").val();
 
                          var answer=$("#answer").val();
                          var choice1=$("#choice1").val();
                          var choice2=$("#choice2").val();
                          var choice3=$("#choice3").val();
                          $('.overlay').show();
                          $.ajax({
                              type:"post",
                              url:"delete.php",
                              data:"question="+question+"&answer="+answer+"&choice1="+choice1+"&choice2="+choice2+"&choice3="+choice3+"&choice3="+choice3,
                              success:function(data){
                                $("#info").html(data);
                                 
                                 $('.overlay').hide();
                                 
                              }
 
                          });
 
                    });
                  
			      	   
		 
               });
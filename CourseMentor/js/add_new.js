$(document).ready( function(){
	$("form button.delete").click(function(){
		var name = $(this).parent().find("#locdel").val();
		var form = '<input type="hidden" name="locdel" value="'+name+'">';
		$("#append3").append(form);
		document.getElementById("myForm3").submit();
	});
	
	
	$("#addNew").click(function(){
		var add =	'</br>'+
		'<form class="form-horizontal, main-form" action="location_edit.php" method="post">'+
						'<div class="form-group">'+
							'<textarea rows="8" cols="120" class="form-control" id="dhaq" placeholder="Question" value=""> </textarea>'+
							'</div>'+
							'<div class="form-inline">'+
							'<div class="form-group">'+
							'<div class="col-sm-offset-1">'+
					'<textarea rows="5" cols="30" class="form-control" id="correct_answer" placeholder="Correct Answer" value=""></textarea>'+
							'</div>'+
							'</div>'+
							'<div class="form-group">'+
							'<div class="col-sm-offset-3">'+
							'<textarea rows="5" cols="30" class="form-control" id="wrong_answer1" placeholder="Wrong Answer" value=""> </textarea>'+
							'</div>'+
							'</div>'+
							'<div class="form-group">'+
							'<div class="col-sm-offset-5">'+
			'<textarea rows="5" cols="30" class="form-control" id="wrong_answer2" placeholder="Wrong Answer" value=""> </textarea>'+
							'</div>'+
							'</div>'+
							'<div class="form-group">'+
							'<div class="col-sm-offset-7">'+
		     '<textarea rows="5" cols="30" class="form-control" id="wrong_answer3" placeholder="Wrong Answer" value=""> </textarea>'+
							'</div>'+
							'</div>'+ 
							'</div>'+
							'<div class="row-inline">'+
							'<div class="col-sm-2 col-sm-offset-2">'+
							'<div class="form-group">'+
							'<div class="col-sm-12 col-sm-offset-12">'+
								'<button class="btn btn-primary" type="button" name="button">Edit</button>'+
							'</div>'+
						'</div>'+
							'</div>'+
							
							'<div class="col-sm-2 col-sm-offset-2">'+


						'<div class="form-group">'+
							'<div class="col-sm-12 col-sm-offset-12">'+
								'<button class="btn btn-primary" type="button" name="button">Save</button>'+
							'</div>'+
						'</div>'+
							'</div>'+
							
							'<div class="col-sm-1 col-sm-offset-1">'+


						'<div class="form-group">'+
							'<div class="col-sm-3 col-sm-offset-9">'+
								'<button class="btn btn-primary" type="button" name="button">Delete</button>'+
							'</div>'+
						'</div>'+
							'</div>'+
                                        '</div>'
                       	'</form>';
		$("#addition").before(add);
	});
	$("form button.update").click(function(){
		var name = $(this).parent().find("#locdel").val();
		var capacity = $(this).parent().find("#capdel").val();
		var form = '<input type="hidden" name="locupdate" value="'+name+'"> <input type="hidden" name="capacity" value="'+capacity+'">';
		$("#append3").append(form);
		document.getElementById("myForm3").submit();
	});
});
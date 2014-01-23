$(document).ready(function(){
	var jsonArray = new Object();
	$('#signup-form').submit(function(e){
		jsonArray.firstname = $('#firstname').val();
		jsonArray.lastname = $('#lastname').val();
		jsonArray.city = $('#city').val();
		jsonArray.state = $('#state').val();
		jsonArray.email = $('#emailInput').val();
		jsonArray.password = $('#password').val();
		
		$.ajax({
			type: 'POST',
			url: 'php/signup.php',
			dataType: 'text',
			data: {json: JSON.stringify(jsonArray)},
			success: function(response){
				var fireserver = new Firebase('https://anilum.firebaseio.com/PROD/Users/'+response+'/Data');
				var fireserver2 = new Firebase('https://anilum.firebaseio.com/PROD/MessagingSystem/'+response+'/Data');
				var fireserver3 = new Firebase('https://anilum.firebaseio.com/PROD/Post_Commented_On/'+response+'/Data');
				
				var newloc = fireserver.push();
				newloc.set({
					Parent_Loc: newloc.name(),
					Type: 'Placeholder'
				});		
				var newloc2 = fireserver2.push();
				newloc2.set({
					Parent_Loc: newloc2.name(),
					Type: 'Placeholder'
				});	
				var newloc3 = fireserver3.push();
				newloc3.set({
					Parent_Loc: newloc3.name(),
					Type: 'Placeholder'
				});		
				
			}
		});
		e.preventDefault();
	});
});

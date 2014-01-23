$(document).ready(function(){
	
	$('#resend-button').click(function(){
	
		$.ajax({
			
			type: 'GET',
			url: '../login/php/resend_email.php',
			
		})
		
	});
	
	
	
	
	
});



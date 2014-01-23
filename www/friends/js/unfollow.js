$(document).ready(function(){
 	$("#unfollow-button").live('click', function(){
		var user_id = $(this).attr('name'); //select_name is the same as the CURRENT post ID
		$("#following-" + user_id).hide();
		
     	$.ajax({
     		type: 'GET',
     		url: 'php/follow.php',
     		data: ({'userid': user_id}),
     		success: function(response)
     		{
     			if(response.Status == "Unfollow")
     			{
     				alert("Unfollowed");
     				//$('#followButton').html('Follow');
			
     				//New Firebase ref
     				var fireserver1 = new Firebase('https://anilum.firebaseio.com/PROD/Users/'+response.User_FK+'/Data/'+response.FireLoc);
	     			//Remove the like notification in the Firebase
	     			fireserver1.remove();
 
     			}
     			
     		}
     	});
     });
	         
});
$(document).ready(function(){
			$('#follow-button').live('click',function(){
				var user_id = $(this).attr('name');
	         	$.ajax({
	         		type: 'GET',
	         		url: 'php/follow.php',
	         		dataType: 'json',
	         		data: ({'userid': user_id}),
	         		success: function(response)
	         		{
	         			if(response.Status == "Unfollow")
	         			{
	         				alert("success");
	         				$('#follow-button').html('Follow');
     				
		     				//New Firebase ref
		     				var fireserver1 = new Firebase('https://anilum.firebaseio.com/PROD/Users/'+response.User_FK+'/Data/'+response.FireLoc);
			     			//Remove the like notification in the Firebase
			     			fireserver1.remove();
		 
	         			}
	         			else if(response.Status == "Follow")
	         			{
	         				$('#follow-button').html('Unfollow');
	         				
	         				//New Firebase ref
		     				var fireserver3 = new Firebase('https://anilum.firebaseio.com/PROD/Users/'+response.User_FK+'/Data');
				   			//AutoIncr a new ref location for data
				   			var newloc = fireserver3.push();
				   			//Insert data into the new ref location
				   			newloc.set({
				   				FromUser_FK: response.fromUserFK,
				   				fromName: response.fromName,
				   				DateTime: response.DateTime,
				   				Notifications_PK: response.Notifications_PK,
				   				Parent_Loc: newloc.name(),
				   				ProfilePic: response.ProfilePic,
				   				Type: response.Status,
				   				Last_Read: '0'
				   			});		
				   			
				   			//Insert Firebase Location into Notifications Table
				   			followingArray.notificationpk = response.Notifications_PK;
				   			followingArray.fireloc = newloc.name();
				   			$.ajax({
								type: 'POST',
								url: 'php/insertfireloc.php',
						   		data: {json: JSON.stringify(followingArray)}
				   			});
				   			
		     			}
	         		}
	         	});
	         });
			
});
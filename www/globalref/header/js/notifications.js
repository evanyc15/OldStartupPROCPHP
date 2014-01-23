$(document).ready(function(){
	var $notification_box = $('#notification-insert-box').clone(true,true);
	//var current_num_notifications;
	var num_notifications = 0;
	$('#notification-insert-box').remove();
	//Create new firebase reference
	var fireserver = new Firebase('https://anilum.firebaseio.com/PROD/Users/'+iduser+'/Data');
	var fireserver2 = new Firebase('https://anilum.firebaseio.com/PROD/Post_Commented_On/'+iduser+'/Data');
	
	var jsonObject;
	var timeago;
	var name;
	var user_data;
	var user_data2;
	var user_data3;
	var $new_notification
	fireserver.on('child_added',function(snapshot){
		//Create javascript Object with snapshot data
		user_data = snapshot.val();
		$new_notification = $notification_box.clone(true,true);
		//current_num_notifications = $('.badge').text();
		
		//Checking for new notifications
		if(user_data.Last_Read == "0" && user_data.Type != "Placeholder"){
			//num_notifications = parseInt(current_num_notifications) + 1;
			num_notifications = num_notifications + 1;
			$('#notification-badge').html(num_notifications);
		}
		//Insert the snapshot data to a notification box
		if(user_data.Type == "Comment"){
			$new_notification.find('#notification-pfpic').attr('src','php/image_proxy.php?image=' + user_data.ProfilePic);
			$new_notification.find('#notification-message').html("has commented on your post "+user_data.Post_Title+" : "+user_data.Comment);
			$new_notification.find('a').attr('href','/merch/?pid='+user_data.Post_FK);
			$new_notification.find('#notification-name').html(user_data.fromName);
			/*$new_notification.css({
				'background-color': 'gray',
				'opacity': '0.8'
			})*/
			$new_notification.prependTo('#header_notification_box');
		}
		else if(user_data.Type == "Like"){
			$new_notification.find('#notification-pfpic').attr('src','php/image_proxy.php?image=' + user_data.ProfilePic);
			$new_notification.find('#notification-message').html("has liked your post "+user_data.Post_Title);
			$new_notification.find('a').attr('href','/merch/?pid='+user_data.Post_FK);
			$new_notification.find('#notification-name').html(user_data.fromName);
			$new_notification.prependTo('#header_notification_box');
		}
		else if(user_data.Type == "Follow"){
			$new_notification.find('#notification-pfpic').attr('src','php/image_proxy.php?image=' + user_data.ProfilePic);
			$new_notification.find('#notification-message').html("has begun to follow you!");
			$new_notification.find('a').attr('href','/profile/?user='+user_data.FromUser_FK);
			$new_notification.find('#notification-name').html(user_data.fromName);
			$new_notification.prependTo('#header_notification_box');
		}
		else if(user_data.Type == "Offer"){
			$new_notification.find('#notification-pfpic').attr('src','php/image_proxy.php?image=' + user_data.ProfilePic);
			$new_notification.find('#notification-message').html("has offered on your post "+user_data.Post_Title+": "+user_data.Comment);
			$new_notification.find('a').attr('href','/merch/?pid='+user_data.Post_FK);
			$new_notification.find('#notification-name').html(user_data.fromName);
			$new_notification.prependTo('#header_notification_box');
		}
		else if(user_data.Type == "OfferResponse")
		{
			$new_notification.find('#notification-pfpic').attr('src','php/image_proxy.php?image=' + user_data.ProfilePic);
			if(user_data.Status == 'accepted')
				$new_notification.find('#notification-message').html("has " + "<b style='color:green;'>" + user_data.Status + "</b>" + " your offer of $" + user_data.OfferPrice + " on the post: " + user_data.Post_Subject);
			else
				$new_notification.find('#notification-message').html("has " + "<b>" + user_data.Status + "</b>" + " your offer of $" + user_data.OfferPrice + " on the post: " + user_data.Post_Subject);
			$new_notification.find('a').attr('href','/merch/?pid='+user_data.Post_FK);
			$new_notification.find('#notification-name').html(user_data.fromName);
			$new_notification.prependTo('#header_notification_box');
		}
	});

	//This fireserver listener is to listen for notifications on any posts that the session user has posted on and
	//has been commented on by any other user
	fireserver2.on('child_added',function(snapshot2){
		user_data2 = snapshot2.val();
		if(user_data2.Type != "Placeholder"){
			$new_notification = $notification_box.clone(true,true);
			
			//This fireserver listener is to now listen to any changes IN the posts that the user is related to
			var fireserverpost = new Firebase('https://anilum.firebaseio.com/PROD/Comment_Reply/'+user_data2.Post_FK+'/Data');
			fireserverpost.on('child_added',function(snapshot3){
				user_data3 = snapshot3.val();
				
				//Make sure the user doesn't receive his own comments' notifications
				if(user_data3.Type != "Placeholder" && user_data3.FromUser_FK != iduser){
					if(user_data3.Last_Read == "0"){
						//num_notifications = parseInt(current_num_notifications) + 1;
						num_notifications = num_notifications + 1;
						$('#notification-badge').html(num_notifications);
					}
					$new_notification = $notification_box.clone(true,true);
					$new_notification.find('#notification-pfpic').attr('src',user_data3.ProfilePic);
					$new_notification.find('#notification-message').html("has replied to the post "+user_data3.Post_Title+" : "+user_data3.Comment);
					$new_notification.find('a').attr('href','/merch/?pid='+user_data3.Post_FK);
					$new_notification.find('#notification-name').html(user_data3.fromName);
					$new_notification.prependTo('#header_notification_box');
				}
			});		
		}	
	});

//Upon clicking on the notification icon on header
$('#notification-dropdown').click(function(){
	//Update the notification table to set respective user's notifications to read
	$.ajax({
		type: 'GET',
		url: '/globalref/header/php/notification_read.php',
		dataType: 'json',
		success: function(response){
			for(var i = 0; i<response.length; i++){
				//Set the notifications to read in the firebase as well
				if(response[i].FireLoc != null){
					var fireserver = new Firebase('https://anilum.firebaseio.com/PROD/Users/'+iduser+'/Data/'+response[i].FireLoc);
					fireserver.update({Last_Read: '1'});
				}
			}
		}
	});
	//Notifications icon on header is now not numbered
	$('#notification-badge').empty();
});

});
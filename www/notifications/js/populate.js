$(document).ready(function(){
	var $temp_box = $('#notification-box').clone(true,true);
	$('#notification-box').remove();
	var jsonObject;
	
	var noticount = new Object();
	noticount.currentcount = 0;
	noticount.increment = 8;
	
	
	$temp_box.click(function(){
		var url = $(this).find('#to-post').val();
		window.location = url;
	});
	$temp_box.mouseover(function(){
		$(this).addClass('hover');
	});
	$temp_box.mouseout(function(){
		$(this).removeClass('hover');
	});
	
	$.ajax({
		type: 'GET',
		url: 'php/retrieve_notifications.php',
		dataType: 'json',
		data: ({'currcount': noticount.currentcount, 'increment': noticount.increment}),
		success: function(response){
			for(var i = 0; i<response.length;i++){
				//Clone the notification box
				var $new_notification_box = $temp_box.clone(true,true);
				noticount.currentcount++;
				
				//Parse the json to get the json containing Notification Data
				jsonObject = $.parseJSON(response[i].Notifications_Data);
				
					var splitTimes = response[i].TimeDiff.split(' ');
					var latestTime; //Time that will be displayed
					var timeChosen = false;

					for(var j=0;j<splitTimes.length && !timeChosen;j++)
					{
						if(splitTimes[j] != '00') //First valid time difference
						{
							switch(j)
							{
								case 0: //Years
									if(splitTimes[j][0] == '0')
										latestTime = splitTimes[j][1] + " years ago";
									else
										latestTime = splitTimes[j] + " years ago";
									timeChosen = true;
									break; 
								case 1: //Months
									if(splitTimes[j][0] == '0')
										latestTime = splitTimes[j][1] + " months ago";
									else
										latestTime = splitTimes[j] + " months ago";
									timeChosen = true;
									break;
								case 2: //Day
									if(splitTimes[j][0] == '0')
										latestTime = splitTimes[j][1] + " days ago";
									else
										latestTime = splitTimes[j] + " days ago";
									timeChosen = true;
									break;
								case 3: //Hour
									if(splitTimes[j][0] == '0')
										latestTime = splitTimes[j][1] + " hours ago";
									else
										latestTime = splitTimes[j] + " hours ago";
									timeChosen = true;
									break;
								case 4: //Minutes
									if(splitTimes[j][0] == '0')
										latestTime = splitTimes[j][1] + " minutes ago";
									else
										latestTime = splitTimes[j] + " minutes ago";
									timeChosen = true;
									break;
								case 5: //Seconds
									if(splitTimes[j][0] == '0')
										latestTime = splitTimes[j][1] + " seconds ago";
									else
										latestTime = splitTimes[j] + " seconds ago";
									timeChosen = true;
									break;
							}
						}
					}
				
				//Start putting the notifications on to screen in formats
				//depending on if its Follow, Like, or Comment
				if(response[i].Notifications_Type == "Follow"){
		
					//fromUser's pf pic
					$new_notification_box.find('#notification-user').find('a').attr('href','../profile/?user='+jsonObject.User_FK);
					$new_notification_box.find('#notification-date').find('a').html(latestTime);
					//Notification comment/alert
					$new_notification_box.find('#notification-comment').html(jsonObject.Name+' has begun to follow you');
					$new_notification_box.insertAfter('#notification-title');
					//Insert a bottom-border line
					$('<hr>').insertAfter($new_notification_box);
				}
				else if(response[i].Notifications_Type == "Comment"){
					//Allows user to click on the Notifications to go to their post
					$new_notification_box.find('#to-post').val('../merch/?pid='+jsonObject.Post_FK);
					$new_notification_box.find('#notification-user').find('a').attr('href','../profile/?user='+jsonObject.User_FK);
					$new_notification_box.find('#notification-date').find('a').html(latestTime);
					$new_notification_box.find('#notification-comment').html(jsonObject.Name+' has commented on your post:    '+jsonObject.Comment);
					$new_notification_box.insertAfter('#notification-title');
					$('<hr>').insertAfter($new_notification_box);
				}
				else if(response[i].Notifications_Type == "Like"){
					$new_notification_box.find('#to-post').val('../merch/?pid='+jsonObject.Post_FK);
					$new_notification_box.find('#notification-user').find('a').attr('href','../profile/?user='+jsonObject.User_FK);
					$new_notification_box.find('#notification-date').find('a').html(latestTime);
					$new_notification_box.find('#notification-comment').html(jsonObject.Name+' has liked your post!');
					$new_notification_box.insertAfter('#notification-title');
					$('<hr>').insertAfter($new_notification_box);
				}
				else if(response[i].Notifications_Type == "Offer"){
					$new_notification_box.find('#to-post').val('../merch/?pid='+jsonObject.Post_FK);
					$new_notification_box.find('#notification-user').find('a').attr('href','../profile/?user='+jsonObject.User_FK);
					$new_notification_box.find('#notification-date').find('a').html(latestTime);
					$new_notification_box.find('#notification-comment').html(jsonObject.Name+' has made an offer for your post!');
					$new_notification_box.insertAfter('#notification-title');
					$('<hr>').insertAfter($new_notification_box);
				}
			}
		}
	});

	//This function is activated when the bottom of page is hit
	$(window).scroll(function() {
	   if($(window).scrollTop() + $(window).height() == $(document).height()) {
	   		$.ajax({
				type: 'GET',
				url: 'php/retrieve_notifications.php',
				dataType: 'json',
				data: ({'currcount': noticount.currentcount, 'increment': noticount.increment}),
				success: function(response){
					if(response.length != 0){
						for(var i = 0; i<response.length;i++){
							noticount.currentcount++;
							//Clone the notification box
							if(response[i].User_FK != null && response[i].Name != null && response[i].Notifications_Type != null){
								var $new_notification_box = $temp_box.clone(true,true);
								
								//Parse the json to get the json containing Notification Data
								jsonObject = $.parseJSON(response[i].Notifications_Data);
								
								
									var splitTimes = response[i].TimeDiff.split(' ');
									var latestTime; //Time that will be displayed
									var timeChosen = false;
				
									for(var j=0;j<splitTimes.length && !timeChosen;j++)
									{
										if(splitTimes[j] != '00') //First valid time difference
										{
											switch(j)
											{
												case 0: //Years
													if(splitTimes[j][0] == '0')
														latestTime = splitTimes[j][1] + " years ago";
													else
														latestTime = splitTimes[j] + " years ago";
													timeChosen = true;
													break; 
												case 1: //Months
													if(splitTimes[j][0] == '0')
														latestTime = splitTimes[j][1] + " months ago";
													else
														latestTime = splitTimes[j] + " months ago";
													timeChosen = true;
													break;
												case 2: //Day
													if(splitTimes[j][0] == '0')
														latestTime = splitTimes[j][1] + " days ago";
													else
														latestTime = splitTimes[j] + " days ago";
													timeChosen = true;
													break;
												case 3: //Hour
													if(splitTimes[j][0] == '0')
														latestTime = splitTimes[j][1] + " hours ago";
													else
														latestTime = splitTimes[j] + " hours ago";
													timeChosen = true;
													break;
												case 4: //Minutes
													if(splitTimes[j][0] == '0')
														latestTime = splitTimes[j][1] + " minutes ago";
													else
														latestTime = splitTimes[j] + " minutes ago";
													timeChosen = true;
													break;
												case 5: //Seconds
													if(splitTimes[j][0] == '0')
														latestTime = splitTimes[j][1] + " seconds ago";
													else
														latestTime = splitTimes[j] + " seconds ago";
													timeChosen = true;
													break;
											}
										}
									}
								
								//Start putting the notifications on to screen in formats
								//depending on if its Follow, Like, or Comment
								if(response[i].Notifications_Type == "Follow"){
						
									//fromUser's pf pic
									$new_notification_box.find('#notification-user').find('a').attr('href','../profile/?user='+jsonObject.User_FK);
									$new_notification_box.find('#notification-date').find('a').html(latestTime);
									//Notification comment/alert
									$new_notification_box.find('#notification-comment').html(jsonObject.Name+' has begun to follow you');
									$new_notification_box.insertAfter('#notification-title');
									//Insert a bottom-border line
									$('<hr>').insertAfter($new_notification_box);
								}
								else if(response[i].Notifications_Type == "Comment"){
									//Allows user to click on the Notifications to go to their post
									$new_notification_box.find('#to-post').val('../merch/?pid='+jsonObject.Post_FK);
									$new_notification_box.find('#notification-user').find('a').attr('href','../profile/?user='+jsonObject.User_FK);
									$new_notification_box.find('#notification-date').find('a').html(latestTime);
									$new_notification_box.find('#notification-comment').html(jsonObject.Name+' has commented on your post:    '+jsonObject.Comment);
									$new_notification_box.insertAfter('#notification-title');
									$('<hr>').insertAfter($new_notification_box);
								}
								else if(response[i].Notifications_Type == "Like"){
									$new_notification_box.find('#to-post').val('../merch/?pid='+jsonObject.Post_FK);
									$new_notification_box.find('#notification-user').find('a').attr('href','../profile/?user='+jsonObject.User_FK);
									$new_notification_box.find('#notification-date').find('a').html(latestTime);
									$new_notification_box.find('#notification-comment').html(jsonObject.Name+' has liked your post!');
									$new_notification_box.insertAfter('#notification-title');
									$('<hr>').insertAfter($new_notification_box);
								}
								else if(response[i].Notifications_Type == "Offer"){
									$new_notification_box.find('#to-post').val('../merch/?pid='+jsonObject.Post_FK);
									$new_notification_box.find('#notification-user').find('a').attr('href','../profile/?user='+jsonObject.User_FK);
									$new_notification_box.find('#notification-date').find('a').html(latestTime);
									$new_notification_box.find('#notification-comment').html(jsonObject.Name+' has made an offer for your post!');
									$new_notification_box.insertAfter('#notification-title');
									$('<hr>').insertAfter($new_notification_box);
								}
							}
						}
					}
				}
			});	
	   }   
	});

});

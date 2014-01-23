$(document).ready(function(){
	var $message_box = $('#message-insert-box').clone(true,true); //Clone the message box block first
	var num_notifications = 0;
	$('#message-insert-box').remove(); //Remove the initial message block

	var fireserver = new Firebase('https://anilum.firebaseio.com/PROD/MessagingSystem/Data/'+iduser+"/"); //Connect to the current users's messages

	fireserver.on('value',function(snapshot) //Everything time a user gets a message, this will get all of the messages as a snapshot at that point in time
	{
		var conversationArray = new Array(); //2D array of Conversations with whoever they're talking with
		var unreadMessages = {}; //This will keep track of the unread messages of each person they were previously talking with(will be used to populate the value of the badge
		var user_data = snapshot.val(); //Gets an object containing all the messages returned by Firebase
		var unreadCount = 0;
		var numberOfUsers = 0; //Number of people they're having a conversation with

		for(var propt in user_data) //For loop through each of the properties of the user_data(full of Locs)
		{	
			if(user_data[propt]['Last_Read'] == '0') //If the Last_Read of the message is false, increase the number of unread messages for that person by 1(I use an associative array where the indexs are the names of the people)
			{
				++unreadMessages[user_data[propt]['FromUser_FK']];
			}
			//Creates a new Object and populates it with the time of the message,name of the sender,message,profile picture of sender and id of sender for insertion into the 2D array
			var messageInfo = new Object();
			messageInfo.Time = user_data[propt]['DateTime'];
			messageInfo.Name = user_data[propt]['Name'];
			messageInfo.Message = user_data[propt]['Message'];
			messageInfo.ProfilePicture = user_data[propt]['ProfilePicture'];
			messageInfo.FromUser_FK = user_data[propt]['FromUser_FK'];
			
			//Only difference between these two blocks is whether or not the person already has a row made for them in the conversation array
			
			if(conversationArray[user_data[propt]['FromUser_FK']] != undefined) //If the person already has a row
			{
				conversationArray[user_data[propt]['FromUser_FK']].unshift(messageInfo); //Inserts this object full of information into the front of the array of Objects
			}
			else //New person, make row for them
			{
				++numberOfUsers; //Increments how many people they're having a conversation with
				conversationArray[user_data[propt]['FromUser_FK']] = new Array();
				unreadMessages[user_data[propt]['FromUser_FK']] = 0; //Sets the number of unread messages of the new user to 0
				conversationArray[user_data[propt]['FromUser_FK']].unshift(messageInfo);
			}
		}

		conversationArray.sort(function(a,b) //Sorts the conversation array by using the Timestamp of the first element of each person's array(because that's the most recent message from them)
		{
			var time1 = Date.parse(a[0].Time) * 1000; //Converts to seconds
			var time2 = Date.parse(b[0].Time) * 1000;
			if(time1 > time2) //If the time is greater(earlier) than swap, else don't
				return 0;
			if(time1 < time2)
				return 1;
		});
		
		if(numberOfUsers < 10) //If they're having conversations with less than 10 people, display the number of convos they have
			var numberOfConvos = numberOfUsers;
		else //Else that means they're having conversations with more than 10, we only limit 10 at this point
			var numberOfConvos = 10;
		

		for(var i=0;i < numberOfConvos;i++)
		{
			if($('#' + conversationArray[i][0]['FromUser_FK']).length > 0) //If the message block is already there, then we want to replace the message and move it to the top
			{
				var conversation = $('#' + conversationArray[i][0]['FromUser_FK']); //Get a handle to the conversation block

				conversation.attr('id',conversationArray[i][0]['FromUser_FK']);
				//conversation.find('a').attr('href','/messages/?user=' + conversationArray[i][0]['FromUser_FK']);
				conversation.find('#profilePicture').css('background-image','url(php/image_proxy.php?image=' + conversationArray[i][0]['ProfilePicture'] + ')');
				conversation.find('#person-name').html(conversationArray[i][0]['Name']);
				conversation.find('#message-message').html(conversationArray[i][0]['Message']); //Last message that was sent by this user
				if(unreadMessages[conversationArray[i][0]['FromUser_FK']] != 0)
					conversation.find('#message-count-badge').html(unreadMessages[conversationArray[i][0]['FromUser_FK']]);
				else
					conversation.find('#message-count-badge').html('');
				conversation.appendTo('#header_message_box'); //Doesn't add a new block, just moves it to the top of the list
			}
			else //Else, make a new conversation block and add it to the drop down
			{
				var $conversation = $message_box.clone(true,true);

				$conversation.attr('id',conversationArray[i][0]['FromUser_FK']);
				//$conversation.find('a').attr('href','/messages/?user=' + conversationArray[i][0]['FromUser_FK']);
				$conversation.find('#profilePicture').css('background-image','url(php/image_proxy.php?image=' + conversationArray[i][0]['ProfilePicture'] + ')');
				$conversation.find('#person-name').html(conversationArray[i][0]['Name']);
				$conversation.find('#message-message').html(conversationArray[i][0]['Message']); //Last message that was sent by this user
				if(unreadMessages[conversationArray[i][0]['FromUser_FK']] != 0)
					$conversation.find('#message-count-badge').html(unreadMessages[conversationArray[i][0]['FromUser_FK']]);
				else
					$conversation.find('#message-count-badge').html('');
				$conversation.appendTo('#header_message_box');
			}
		}

		for(var count in unreadMessages) //Loops through the unreadMessages object and check if there are any unread messages from anyone
		{
			if(unreadMessages[count] != 0) //IF there are unread messages from anyone, increase the number of unreadCount by one(REMEMBER, WE DON'T INCREMENT FOR EACH MESSAGE BUT INSTEAD INCREMENT FOR EACH NEW MESSAGES FROM DISTINCT USERS)
				++unreadCount;
		}

		if(unreadCount != 0) //We check if unreadCount is not 0 because if its not 0 then that means we have unread messages from people and we display the number in the badge
			$('#message-badge').html(unreadCount);
	});

//Upon clicking on the notification icon on header
//We use the class because since each conversation block is going to have a different ID, we use the class instead since all conversation blocks have this class
	$('.conversation-box').live('click',function()
	{
		var conversationUserID = $(this).attr('id'); //We get the ID of the current block(represents the ID of the person in the conversation)
		var previousBadgeNum = $('#message-badge').html(); //We get the number of unread messages we currently have because we'll need to update it
		
		//Since a conversation has been clicked on, we must decrement the number in the badge by 1(THIS IS ALWAYS 1 BECAUSE WE ONLY INCREMENT BY 1 WHENEVER A NEW PERSON MESSAGES THE USER)
		//We pass in the id of the person in the conversation in order to limit the number of records returned by the query
		$.ajax({
			type: 'GET',
			url: '/globalref/header/php/message_read.php',
			dataType: 'json',
			data: {user1_fk: conversationUserID},
			success: function(response)
			{
				for(var i = 0; i<response.length; i++)
				{
					if(response[i].FireLoc != null){
						var fireserver = new Firebase('https://anilum.firebaseio.com/PROD/MessagingSystem/Data/'+iduser+"/"+response[i].FireLoc);
						fireserver.update({Last_Read: '1'});
					}
				}
				
				--previousBadgeNum;
				//Notifications icon on header is now not numbered
				if(previousBadgeNum != 0)
					$('#message-badge').html(previousBadgeNum);
				else
					$('#message-badge').html('');
				
				window.location = '/messages/?user=' + conversationUserID;
			}
		});
		
	});
});
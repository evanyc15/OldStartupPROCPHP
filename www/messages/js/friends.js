$(document).ready(function(){
	var temp = null;
	//Cloning the message boxes

	$('#message-from').css('visibility','visible');
	$('#message-to').css('visibility','visible');
	$('#message-list').css('visibility','visible');
	var $listbox = $('#message-list').clone(true,true);
	var $frombox = $('#message-from').clone(true,true);
	var $tobox = $('#message-to').clone(true,true);

	var messagebox = $('#message-box');
	var jsonArray = new Object();
	temp = userchat;

	//These variables are for the scroll to bottom detection
	var cont = $('#chats');
    var list = $('.chats', cont);

	//empty messagebox upon load
	messagebox.empty();

	//Global variables
	var $newbox;
	var inputmsg;
	var fromserver; 
	var toserver
	var fromname;
	var frompfimage;
	var user_data;
	var clickedfriendID;

	$("#input-message").prop('disabled', true);
	if(temp == null || temp == ''){
		$.ajax({
			type: 'GET',
			url: 'php/get_messages_list.php',
			dataType: 'json',
			success: function(response){
				for(var i = 0;i<response.length;i++){
					$newbox = $listbox.clone(true,true);
					$newbox.find('img').attr('src','php/image_proxy.php?image=' + response[i].ProfilePicture);
					$newbox.find('a.name').text(response[i].FirstName + " " + response[i].LastName);
					$newbox.find('a.name').attr('href','?user='+response[i].User1_FK);
					$newbox.find('span.datetime').text('at '+ response[i].ActualTime);
					$newbox.find('span.body').text(response[i].Message);
					messagebox.append($newbox);
				}
			}
		});
	}
	
	if(temp != null && temp != ''){
		$("#input-message").prop('disabled', false);
		clickedfriendID = temp;
		console.log("Calling Get Messages");
		getmessages(temp);
	}

	//Message input is initially disabled because user has not chose friend to chat with


	//Select2 to show relavant names when searching
		$('#select2-sample2').select2(
   		{
   			width: "100%",
   			formatResult: resultLayout,
   			query: function (query) {
                var data = {results: []};
	                $.ajax({
	                	type: 'GET',
	                	url: 'php/get_friends.php',
	                	dataType: 'json',
	                	data: {searchdata: '\'' + query.term  + '\''},
	                	success: function(response)
	                	{
		                		for(var i=0;i < response.length;i++)
		                			//data.results.push({id: "\"" + response[i]['Tag'] + "\"",text: "\"" + response[i]['Tag'] + "\""});
		                			data.results.push({id: response[i]['User_PK'],text: response[i]['FirstName'] + ' ' + response[i]['LastName'], picture: response[i]['ProfilePicture']});

		                		query.callback(data);
	                	}
	             	});
	        }
   		});

		//When name is chosen, send ajax call to get_message.php to get the messages from Database
		//Then initiate firebase to listen to new messages added
   		$('#select2-sample2').live("select2-selecting",function(e)
   		{
   			messagebox.empty();
   			clickedfriendID = e.val;
   			$("#input-message").prop('disabled', false);
   			getmessages(clickedfriendID);
   		});
   		
   		//Function for inputting messages
   		$('#input-form').submit(function(e){
   			
   			//Prevent the default submit from html
   			e.preventDefault();
   			
   			//Get the value from input
   			inputmsg = $('#input-message').val();
   			$('#input-message').val('');
   			$.ajax({
   				type: 'POST',
   				url: 'php/post_message.php',
   				dataType: 'json',
   				data: ({'touser':clickedfriendID, 'message':inputmsg}),
   				success: function(response){
   					
   					console.log("Submitting message");
   					//Create a new autoincremented location at the specific from child
   					var newloc = toserver.push();
   					newloc.set({
   						User_FK: clickedfriendID,
   						FromUser_FK: session,
		   				Name: fromname,
		   				ProfilePicture: frompfimage,
		   				Message: inputmsg,
		   				DateTime: response.DateTime,
		   				Last_Read: 0
		   			});

		   			//Append to message box
		   			$newbox = $frombox.clone(true,true);
		   			$newbox.find('img').attr('src','php/image_proxy.php?image=' + frompfimage);
					$newbox.find('a.name').text(fromname);
					$newbox.find('span.datetime').text('at '+response.DateTime);
					$newbox.find('span.body').text(inputmsg);
					messagebox.append($newbox);
					scrolldown();

					jsonArray.fireloc = newloc.name();
		   			jsonArray.messagepk = response.Msg_PK;
	   				$.ajax({
						type: 'POST',
						url: 'php/insertfireloc.php',
				   		data: {json: JSON.stringify(jsonArray)}
				   	});
				}
   			});
   		});
   		
   		//Function to scroll down to message box
   		function scrolldown (){
   			 $('.scroller', cont).slimScroll({
                    scrollTo: list.height()
                });
   		}
   		
   		function resultLayout(tag)
   		{
   			var markup = "";
   			if(tag.picture != undefined)
   			{
   				markup += "<img class='personImg' src='php/image_proxy.php?image=" + tag.picture + "'/>"; 
   			}
   			if(tag.text != "")
   			{
   				markup += "<p class='personText'>" + tag.text + "</p>";
   			}

   			return markup;
   		}
   		
   		
   		function getmessages(userid){
	   		$.ajax({
				type: 'GET',
   				url: 'php/get_messages.php',
   				dataType: 'json',
   				data: ({'touser':userid}),
   				success: function(response)
   				{
   					console.log("Getting messages");
   					//Initializing new firebase for from and to users
   					fromserver = new Firebase('https://anilum.firebaseio.com/PROD/MessagingSystem/Data/' + session);
   					toserver = new Firebase('https://anilum.firebaseio.com/PROD/MessagingSystem/Data/' + clickedfriendID);	

   					if(response.length == 1){
	   					fromname = response[0].FirstName+" "+response[0].LastName;
	   					frompfimage = response[0].ProfilePicture;
   					}
   					else 
   					{
	   					//If messages are returned
	   					if(response[0].Fill == true)
	   					{
		   					for(var i=0; i < response.length; i++) //Iterate through all the messages and create a tobox or frombox depending on what type of message it is
		   					{
		  						if(response[i].Type == 'To')
		  						{
		   							$newbox = $tobox.clone(true,true);
		   						}
		   						else if(response[i].Type == 'From')
		   						{
		   							$newbox = $frombox.clone(true,true);
		   							fromname = response[i].FirstName + " " + response[i].LastName;
		   							frompfimage = response[i].ProfilePicture;
		   						}
		   						$newbox.find('img').attr('src','php/image_proxy.php?image=' + response[i].ProfilePicture);
		   						$newbox.find('a.name').text(response[i].FirstName + " " + response[i].LastName);
		   						$newbox.find('span.datetime').text('at '+ response[i].DateTime);
		   						$newbox.find('span.body').text(response[i].Message);
		   						messagebox.append($newbox);
		   						scrolldown();
		   					}		

					   		//Skip the initial childs, only add the new ones added
					   		var first = true;

					   		fromserver.endAt().limit(1).on('child_added', function(snapshot2)
					   		{
					   			console.log("Inside child added block");
				   				user_data = snapshot2.val();
				   				console.log(user_data);
					   			if( first ) {
							       // ignore the first snapshot, which is an existing record
							       first = false;
							       return;
							    }
							    else
							    {   
								    $newbox = $tobox.clone(true,true);
								    $newbox.find('img').attr('src',user_data.ProfilePicture);
			   						$newbox.find('a.name').text(user_data.Name);
			   						$newbox.find('span.datetime').text('at ' + user_data.DateTime);
			   						$newbox.find('span.body').text(user_data.Message);
			   						messagebox.append($newbox);
			   						scrolldown();
			   					}    
				   			});
	   					}
   					}
   				}
			});
		}
});
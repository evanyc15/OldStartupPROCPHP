$(document).ready(function(){     
    var jsonArray = new Object();
    var jsonArray2 = new Object();
    var jsonArray3 = new Object();
    var jsonLikeArray = new Object();
	var $commentBox = $('#commentBox').clone(true,true);
	var $offerBox = $('#offersBlock').clone(true,true); //Copy of the offer block
	var $newOfferBlock;
	var commentNum = 0;
    var commentInfoArray = new Object();
    commentInfoArray.postid = idpost;
    commentInfoArray.commentCount = commentNum;

    //Remove initial html blocks so they don't show up as an empty one on load
	$('#commentBox').remove();
	$('#offersBlock').remove();

	/*---------------COMMENTS AJAX-------------------*/

	$.ajax({
		type: 'GET',
		url: '/merch/php/get_comment.php',
		dataType: 'json',
		data: {json: JSON.stringify(commentInfoArray)},
		success: function(response){
			if(response.length > 0)
			{
				for(var i = 0; i<response.length;i++){
					var comment = response[i].comment;
					var img_url = response[i].imgurl;
					var fullname = response[i].fullname;
					var fromuserfk = response[i].fromuserfk;
					var timeDiff = response[i].time;
					var splitTimes = timeDiff.split(' ');
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
					var $newbox = $commentBox.clone(true,true);
					$newbox.find('#profileImg').attr('src','php/image_proxy.php?image=' + img_url);
			   		$newbox.find('#profileLink').attr('href','/profile/?user='+fromuserfk);
			   		$newbox.find('#fullname b').html(fullname);
			   		$newbox.find('#date').html(latestTime);    
			        $newbox.find('#comment').html(comment);
			        $newbox.fadeIn(1000);
			        $newbox.appendTo('#commentsTab');
			        ++commentNum;
				}
				if(response.length == 5)
				{
					$("<div style='width: 100px;margin:0px auto;''><a href='#' id='showMore' style='text-align:center;'>Show More</button></div>").insertAfter('#commentBox:last-child');
					$('#commentsTab').delegate('#showMore','click',function()
					{
						$('#showMore').remove();
						var ajaxObject = new Object();
						ajaxObject.commentCount  = commentNum;
						ajaxObject.postid = idpost;
						$.ajax(
						{
							type: 'GET',
							url: '/merch/php/get_comment.php',
							dataType: 'json',
							data: {json: JSON.stringify(ajaxObject)},
							success: function(response)
							{
								var numberOfComments = response.length;
								var commentUserID;
								var posterName;
								var posterIMG;
								var diffTime;
								var comment;
								
								if(numberOfComments == 5)
								{
									var initialComments = 5;
								}
								else
								{
									var initialComments = numberOfComments;
								}

								for(var i=0;i<initialComments;i++)
								{
									var splitTimes = response[i]['time'].split(' ');
									var timeChosen = false;	
									var latestTime;

									for(var j=0;j < splitTimes.length && !timeChosen;j++)
									{
										if(splitTimes[j] != '00')
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
									var $newComment = $commentBox.clone(true,true);
									$newComment.find('#profileImg').attr('src',response[i]['imgurl']);
									$newComment.find('#profileLink').attr('href','/profile/?user=' + response[i]['fromuserfk']);
									$newComment.find('#fullname b').html(response[i]['fullname']);
									$newComment.find('#date').html(latestTime);
									$newComment.find('#comment').html(response[i]['comment']);
									$newComment.appendTo('#commentsTab');
									++commentNum;
								}
								if(numberOfComments == 5)
								{
									$("<div style='width: 100px;margin:0px auto;''><a href='#' id='showMore' style='text-align:center;'>Show More</button></div>").insertAfter('#commentBox:last-child');
								}
							}
						});
						return false;
					});
				}	
			}
			/*else
			{
				$('#commentsTab').find('#commentBox').remove();
	         	$('#commentsTab').append("<div class='span12'><p style='text-align:center;'>No Comments</p></div>");
			}*/
		} //Initial Ajax call for comments
	});

	$('#comment_form textarea').keydown(function(e){
		if (e.keyCode == 13) {
			$("#comment-error").show();
		   if($(this).val() == '') 
		   {
			   $("#comment-error").html("Your comment can't be blank!");
       			return false;
		   } //if
		   else
		   {
			   	var dollarSignTest = $(this).val().split('$');
	       		var spacebarDelimit;
	       		
	       		if(dollarSignTest.length >= 2) //Check if they put more one dollar sign
	       		{
	       			$("#comment-error").html("There can be no '$' in your comment!");
	       			return false;
	       		} //if
	       		$("#comment-error").hide();
	       		
		   } //else
		   e.preventDefault(); 
	       var textcontent = $(this).val();
	       var $newbox = $commentBox.clone(true,true);
	       $(this).val('');
	  	   //Initialize to json Object	
	       jsonArray.postId = idpost;
	       jsonArray.userId = session;
	       jsonArray.comment = textcontent;
	       
	       //Post data to Comment DB
	       	$.ajax({
				type: 'POST',
				url: '/merch/php/post_comment.php',
		   		data: {json: JSON.stringify(jsonArray)},
		   		dataType:'json',
		   		success: function(response){
		   			//Start fireserver and insert the comment data to the firebase
		   			//fireserver is for the User's server comment
		   			var fireserver = new Firebase('https://anilum.firebaseio.com/PROD/Users/'+response.UserFK+'/Data');
		   			
		   			//fireserver2 is for the Comment_reply
		   			var fireserver2 = new Firebase('https://anilum.firebaseio.com/PROD/Comment_Reply/'+response.Post_FK+'/Data')
		   			
		   			//fireserver 3 is for the Owner of the posts
		   			var fireserver3 = new Firebase('https://anilum.firebaseio.com/PROD/Post_Commented_On/'+response.FromUser_FK+'/Data')
		   			
		   			//AutoIncr a new ref location for data user notification
		   			var newloc = fireserver.push();
		   			//AutoIncr a new ref location for data post notification
		   			var newloc2 = fireserver2.push();
		   			//AutoIncr a new ref location for data from posts notification
		   			var newloc3 = fireserver3.push();
		   		
		   			//Insert data into the new ref location
		   			newloc.set({
		   				FromUser_FK: response.FromUser_FK,
		   				fromName: response.fromName,
		   				Post_FK: response.Post_FK,
		   				Post_Title: response.Post_Title,
		   				DateTime: response.DateTime,
		   				Comment: response.Comment,
		   				Notifications_PK: response.Notifications_PK,
		   				ProfilePic: response.ProfilePic,
		   				Parent_Loc: newloc.name(),
		   				Type: 'Comment',
		   				Last_Read: '0'
		   			});
		   			
		   			newloc2.set({
		   				User_FK: response.UserFK,
		   				FromUser_FK: response.FromUser_FK,
		   				fromName: response.fromName,
		   				Post_FK: response.Post_FK,
		   				Post_Title: response.Post_Title,
		   				DateTime: response.DateTime,
		   				Comment: response.Comment,
		   				Notifications_PK: response.Notifications_PK,
		   				ProfilePic: response.ProfilePic,
		   				Parent_Loc: newloc2.name(),
		   				Type: 'Reply',
		   				Last_Read: '0'
		   			});
		   			
		   			newloc3.set({
		   				User_FK: response.UserFK,
		   				FromUser_FK: response.FromUser_FK,
		   				fromName: response.fromName,
		   				Post_FK: response.Post_FK,
		   				Post_Title: response.Post_Title,
		   				DateTime: response.DateTime,
		   				Comment: response.Comment,
		   				Notifications_PK: response.Notifications_PK,
		   				ProfilePic: response.ProfilePic,
		   				Parent_Loc: newloc3.name(),
		   				Type: 'Post_Commented_On',
		   				Last_Read: '0'
		   			});
		   			
		   			//Filling out the cloned comment box
		   			$newbox.find('#profileImg').attr('src','php/image_proxy.php?image=' + response.ProfilePic);
		   			$newbox.find('#profileLink').attr('href','/profile?user='+response.FromUser_FK);
		   			$newbox.find('#fullname b').html(response.fromName);
		   			$newbox.find('#date').html("Just Now");
		   			
		   			//Insert FireBase Location to Notifications Table
		   			jsonArray2.fireloc = newloc.name();
		   			jsonArray2.notificationpk = response.Notifications_PK;
	   				$.ajax({
						type: 'POST',
						url: 'php/insertfireloc.php',
				   		data: {json: JSON.stringify(jsonArray2)}
				   	});

				   	$newbox.find('#comment').html(textcontent);
				   	$newbox.fadeIn(1000);
				    $newbox.insertAfter('#comment_form');
		   		}
		   });
	 	} //Ajax call to insert comments into database
	});

	/*---------------[END] COMMENTS AJAX-------------*/


	/*----------------OFFERS AJAX--------------------*/
	$.ajax( //Initial Ajax call for the offers
	{
		type: 'GET',
		url: '/merch/php/offers.php',
		dataType: 'json',
		data: {postid: idpost},
		success: function(response)
		{
			for(var i=0;i < response.length;i++)
			{
				var $newOfferBlock = $offerBox.clone(true,true);
				$newOfferBlock.find('#offerName').html(response[i]['FirstName'] + " " + response[i]['LastName']);
				$newOfferBlock.find('#profileDirect').attr('href',"/profile/?user=" + response[i]['User_PK']);
				$newOfferBlock.find('#offerProfilePicture').attr('src',response[i]['ProfilePicture']);
				$newOfferBlock.appendTo('#offersTab');
			}
		}
	});
	
	
	// START REPLACE
	$('#offersInput').on('keydown',function(e) //Handle input of offers using the enter button
    {
        if(e.keyCode == 13)
        {
        	$("#offer-error").show();
        	if($(this).val() == '') 
        	{
        		$("#offer-error").html("Your offer can't be blank!");
        		return false;
        	} //if
        	else
        	{
        		var dollarSignTest = $(this).val().split('$');
        		var spacebarDelimit;
        		
        		if(dollarSignTest.length > 2) //Check if they put more one dollar sign
        		{
        			$("#offer-error").html("Too many dollar signs! '$$$$'");
        			return false;
        		} //if
        		else if(dollarSignTest.length < 2) //Check if they didn't put any dollar signs
        		{
        			$("#offer-error").html("Put a dollar sign for your price! Like this: $600");
        			return false;
        		} //else if
        		else
        		{
        			var i = 0;
        			var numbers = false; //we assume that there are no numbers after your dollar sign
        			
        			for(i = 0; i < dollarSignTest.length; ++i)
        			{
        				if($.isNumeric(dollarSignTest[i][0]) )
        				{
        					numbers = true; //there are numbers after the '$' sign
        					break;
        				} //if
        			} //for
        			
        			if(numbers) //there are numbers after the '$' sign
        			{
        				spacebarDelimit = dollarSignTest[i].split(' ');
        				var j = 0;
        				for(j = 0; j < spacebarDelimit[0].length-1; ++j)
        				{
        					if( !($.isNumeric(spacebarDelimit[0][j])) )
        					{
        						$("#offer-error").html("There is an unwanted character in your price!  Try something like this: $600");
        						return false;
        					} //if
        				} //for
        			} //if
        			else
        			{
        				$("#offer-error").html("There are no numbers after your dollar sign!  Try something like this: $600");
        				return false;
        			} //else
        			$("#offer-error").hide();
        		} //else
       		} //else
        	
        	e.preventDefault();
        	var offerInfo = new Object();
        	offerInfo.postID = idpost;
        	offerInfo.offer = $(this).val();
        	$(this).val('');
        	
         	$.ajax({
     			type: 'GET',
     			url: '/merch/php/make_offer.php',
     			dataType: 'json',
     			data: offerInfo,
     			success: function(response)
     			{
     				//We creating a new reference to the firebase, response.UserFK is the person who owns the post
     				//that you are offering to.
     				var fireserver = new Firebase('https://anilum.firebaseio.com/Dev/Users/'+response.User_FK+'/Data');//need
     				
     				 //Creating a new autoincremented area to contain the data for the offer you just made
     				var newloc = fireserver.push();
     				
     				//At the new location, begin defining data
     				newloc.set({
     					User_FK: response.User_FK,
     					FromUser_FK: session,  //fromUser is the current posting session user
		   				fromName: response.Name,    //fronname is above's name
		   				Post_FK: offerInfo.postID,			//FK of the post being offered to
		   				Post_Title: response.Subject,  //And its title need
		   				DateTime: response.DateTime,//need
		   				Comment: offerInfo.offer,
		   				Notifications_PK: response.Notifications_PK,//response.Notifications_PK,//need
		   				ProfilePic: response.ProfilePicture,
		   				Parent_Loc: newloc.name(),
		   				Type: 'Offer',
		   				Last_Read: '0'
     				});
     				
     				$newOfferBlock = $offerBox.clone(true,true);
     				$newOfferBlock.find('#offerName').html(response.Name);
     				$newOfferBlock.find('#profileDirect').attr('href',"/profile/?user=" + session);
     				$newOfferBlock.find('#offerProfilePicture').attr('src',response.ProfilePicture);
     				$newOfferBlock.fadeIn(1000);
     				$newOfferBlock.insertAfter('#offersInput');
     				
     				jsonArray3.fireloc = newloc.name();
		   			jsonArray3.notificationpk = response.Notifications_PK;
	   				$.ajax({
						type: 'POST',
						url: 'php/insertfireloc.php',
				   		data: {json: JSON.stringify(jsonArray3)}
				   	});
     			}
         	});
        }
    });
	// END REPLACE
	// END REPLACE
	/*---------------[END] OFFERS AJAX---------------*/
	
	
    $('#bookmarkButton').on('click',function(){
    	$.ajax({
     		type: 'GET',
     		url: '/merch/php/bookmark.php',
     		dataType: 'text',
     		data: ({'postid': idpost}),
     		success: function(response)
     		{
     			if(response == 'Unbookmark')
     			{
     				$('#bookmarkButton').html('Bookmark <i class="icon-bookmark-empty"></i>');
     				$('#bookmarkButton').removeClass('text-seafoam');
     				$('#bookmarkButton').addClass('text-black');
     				//$('#bookmarkButton').css( {"color":"black"} );
     			}
     			else if(response == 'Bookmark')
     			{
     				$('#bookmarkButton').html('Bookmark <i class="icon-bookmark"></i>');
     				$('#bookmarkButton').removeClass('text-black');
     				$('#bookmarkButton').addClass('text-seafoam');
     				//$('#bookmarkButton').css( {"color":"#73b3ac"} );
     			}
     		}
     	});
    });
     
    $('#likeButton').on('click',function(){
     	//Primary ajax code when button is clicked
     	$.ajax({
     		type: 'GET',
     		url: '/merch/php/like.php',
     		dataType: 'json',
     		data: ({'postid': idpost}),
     		success: function(response)
     		{
     			if(response.Status == 'Unlike')
     			{
     				//Change like button to 'Like'
     				$('#likeButton').html('Like <i class="icon-heart-empty"></i>');
     				$('#likeButton').removeClass('text-seafoam');
     				$('#likeButton').addClass('text-black');
     				var fireserver1 = new Firebase('https://anilum.firebaseio.com/Dev/Users/'+response.User_FK+'/Data/'+response.FireLoc);
	     			//Remove the like notification in the Firebase
	     			fireserver1.remove();
     			}
     			else if(response.Status == "Like")
     			{
     				//Change like button to 'Unlike'
     				$('#likeButton').html('Like <i class="icon-heart"></i>');
     				$('#likeButton').removeClass('text-black');
     				$('#likeButton').addClass('text-seafoam');
     				//New Firebase ref
     				var fireserver3 = new Firebase('https://anilum.firebaseio.com/Dev/Users/'+response.User_FK+'/Data');
		   			//AutoIncr a new ref location for data
		   			var newloc = fireserver3.push();
		   			//Insert data into the new ref location
		   			newloc.set({
		   				FromUser_FK: response.fromUserFK,
		   				fromName: response.fromName,
		   				Post_FK: response.Post_FK,
		   				Post_Title: response.Post_Title,
		   				DateTime: response.DateTime,
		   				Notifications_PK: response.Notifications_PK,
		   				Parent_Loc: newloc.name(),
		   				ProfilePic: response.ProfilePic,
		   				Type: response.Status,
		   				Last_Read: '0'
		   			});		
		   			
		   			//Insert Firebase Location to Notifications Table
		   			jsonLikeArray.notificationpk = response.Notifications_PK;
		   			jsonLikeArray.fireloc = newloc.name();
		   			$.ajax({
						type: 'POST',
						url: 'php/insertfireloc.php',
				   		data: {json: JSON.stringify(jsonLikeArray)}
				   	});
     			}
     		}
     	});
    });

	$('#deleteButton').on('click',function(){
		$('#yesButton').css('visibility','visible');
		$('#noButton').css('visibility','visible');
		$('#yesButton').on('click',function()
		{
			$.ajax({
	     		type: 'GET',
	     		url: '/merch/php/delete.php',
	     		dataType: 'text',
	     		data: {postid: idpost},
	     		success: function(response)
	     		{
	     			window.location = "/myshop/";
	     		}
	     	});
	    });
	    $('#noButton').on('click',function()
	    {
	    	$('#yesButton').css('visibility','hidden');
	    	$('#noButton').css('visibility','hidden');
	    });
	});


	$('.pictureClick').live('click',function() //When the user clicks on the little thumbnails on the bottom, switch the photos
    {
			$('#main_pic').attr('src',$(this).attr('src')); 
			return false;  
    });
});

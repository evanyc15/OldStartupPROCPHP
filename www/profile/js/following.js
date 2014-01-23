$(document).ready(function(){
var numberOfRows = 0;
var followingArray = new Object();
	         var ajaxArray = new Object();
	         ajaxArray.rowCount = numberOfRows; //Number of rows
	         ajaxArray.user = u_id;

	         var $itemBlock = $('#itemBlock').clone(true,true);
	         var $rowBlock = $('#rowBlock').clone(true,true); 
	         $('#postBlock').remove();
	         $('#rowBlock').remove();
	         $.ajax({
	         	type: 'GET',
	         	url: 'php/populate_shop.php',
	         	dataType: 'json',
	         	data: {json: JSON.stringify(ajaxArray)},
	         	success: function(response)
	         	{
	         		var numberOfItems = response.length;
	         		if(numberOfItems > 0) //Profile user has items for sale
	         		{
	         			var postCount = 0;
	         			var subject = '';
	         			var description = '';
	         			var price = 0;
	         			var source = '';
	         			var postID = 0;

	         			if(numberOfItems > 4) //Number of elements
	         				var initialRows = 2; //Forced number of rows if they have more than 4 elements(2 rows)
	         			else
	         				var initialRows = Math.ceil(response.length/2); //If they have less than 4 items,use the number of rows they have 

	         			for(var i=0;i<initialRows;i++)
	         			{
	         				var $newRow = $rowBlock.clone(true,true);
	         				$newRow.appendTo('#tab_1_1_1');
	         				$newRow.find('#itemBlock').remove();//We have to remove the item block initially
	         				numberOfRows++; //For each row created we want to increment

	         				if(numberOfItems - postCount >= 2) //As we add item blocks to the rows we want to check if we want to add 2 item blocks or 1
	         				{
	         					for(var j=postCount;j< postCount + 2;j++) //We assign j to postCount so we can use it to index the response, we iterate 2 times for each row
	         					{
			         				subject = response[j]['Subject'];         //   {----Subject
			         				description = response[j]['Description']; //   {----Description
			         				price = response[j]['CurrentPrice'];      /////{----Price
			         				source = response[j]['Source'];           //   {----Source
			         				postID = response[j]['Post_PK'];          //   {----Post ID

			         				var $newItemBlock = $itemBlock.clone(true,true);
			         				$newItemBlock.appendTo('#rowBlock:nth-child(' + (i+1) + ')');//We have to append the new item block to the ith row(rowBlock) we are on, we add one because nth-child starts at 1  
			         				$newItemBlock.find('#postPic').css('background-image', 'url(php/image_proxy.php?image=' + source + ')');
			         				//$newItemBlock.find('#postPic').attr('src',source);
			         				$newItemBlock.find('#postSubjectLink').html(subject);
			         				$newItemBlock.find('#postSubjectLink').attr('href','../merch/?pid=' + postID);
 									$newItemBlock.find('#imageLink').attr('href','../merch/?pid=' + postID);
 									$newItemBlock.find('#postDescription').html(description);
			         				$newItemBlock.find('#postPrice').html(price);

			         			}
			         			postCount += 2; //We then have to increment postCount by 2 since we added 2 posts
		         			}
		         			else //If we can only add one item block left
		         			{
		         				//We have to use postCount as the index because we are not iterating 2 times, we have to get the last item(since the difference between postCount and the length is < 2, which means its 1)
		         				subject = response[postCount]['Subject'];
		         				description = response[postCount]['Description'];
		         				price = response[postCount]['CurrentPrice'];
		         				source = response[postCount]['Source'];
		         				postID = response[postCount]['Post_PK'];

		         				var $newItemBlock = $itemBlock.clone(true,true);
		         				$newItemBlock.appendTo('#rowBlock:nth-child(' + (i+1) + ')');
		         				$newItemBlock.find('#postPic').css('background-image', 'url(php/image_proxy.php?image=' + source + ')');
		         				//$newItemBlock.find('#postPic').attr('src',source);
		         				$newRow.find('#postSubjectLink').html(subject);
		         				$newRow.find('#postSubjectLink').attr('href','../merch/?pid=' + postID);
								$newItemBlock.find('#imageLink').attr('href','../merch/?pid=' + postID);
		         				$newRow.find('#postDescription').html(description);
		         				$newRow.find('#postPrice').html(price);

		         				postCount++; 
		         		
		         			}
	         			}
	         			if(numberOfItems >= 4) //Since we asked for 4 items(2 rows), we expect to get at least 5 or more items in order to show the Show More button, if they give us less than they have no more items for sale logically
	         			{
	         				//var $showMoreButton = "<div style='width: 100px;margin:0px auto;''><a href='#' id='showMore' style='text-align:center;'>Show More</button></div>";
	         				$("<div style='width: 100px;margin:0px auto;''><a href='#' id='showMore' style='text-align:center;'>Show More</button></div>").insertAfter('#rowBlock:last-child');
	         				//$showMoreButton.appendTo('#tab_1_1_1');
	         				//We have to add the click check here because if we put under the ajax call then it won't know what the id #showMore is since the ajax call is called in the background
	         				$('#tab_1_1_1').delegate('#showMore','click',function(){
	         					$('#showMore').remove();
								var ajaxArray = new Object();
								//alert("Number of rows is " + numberOfRows);
								ajaxArray.rowCount = numberOfRows;
								ajaxArray.user = u_id;
								$.ajax({
									type: 'GET',
									url: 'php/populate_shop.php',
									dataType: 'json',
									data: {json: JSON.stringify(ajaxArray)},
									success: function(response)
									{
											var numberOfItems = response.length;
											//alert("Number of items is " + numberOfItems);
											var postCount = 0;
											var subject = '';
											var description = '';
											var price = 0;
											var source = '';
											var postID = 0;
											var tempNumRows = numberOfRows;
											if(numberOfItems < 4) //Even though we asked for 4 more items, if they don't have 4 more items to show then just use how much left they have
											{
												var initialRows = Math.ceil(numberOfItems/2);
											}
											else
											{
												var initialRows = 2;//If they give the number of rows we asked
											}
											//alert("Number of rows is " + numberOfRows + " and initial rows is " + initialRows);
											for(var i=tempNumRows;i<tempNumRows + initialRows;i++) //Iterate through each row
											{
												//alert("Creating a row");
												var $newRow = $rowBlock.clone(true,true);
	         									$newRow.appendTo('#tab_1_1_1');
	         									$newRow.find('#itemBlock').remove();//We have to remove the item block initially
	         									numberOfRows++; //For each row created we want to increment

												if(numberOfItems - postCount >= 2) //We can still add two items per row
												{
													for(var j=postCount;j < postCount+2;j++)
													{
														subject = response[j]['Subject'];
														description = response[j]['Description'];
														price = response[j]['CurrentPrice'];
														source = response[j]['Source'];
														postID = response[j]['Post_PK'];

														var $newItemBlock = $itemBlock.clone(true,true);
														$newItemBlock.appendTo('#rowBlock:last-child');
														$newItemBlock.find('#postPic').css('background-image', 'url(php/image_proxy.php?image=' + source + ')');
								         				//$newItemBlock.find('#postPic').attr('src',source);
			         									$newItemBlock.find('#postSubjectLink').html(subject);
			         									$newItemBlock.find('#postSubjectLink').attr('href','../merch/?pid=' + postID);
			         									$newItemBlock.find('#imageLink').attr('href','../merch/?pid=' + postID);
			         									$newItemBlock.find('#postDescription').html(description);
			         									$newItemBlock.find('#postPrice').html(price);
													}
													postCount += 2;
												}
												else //If we are at the end and can only add one in the last row
												{
													subject = response[postCount]['Subject'];
													description = response[postCount]['Description'];
													price = response[postCount]['CurrentPrice'];
													source = response[postCount]['Source'];
													postID = response[postCount]['Post_PK'];

													var $newItemBlock = $itemBlock.clone(true,true);
													$newItemBlock.appendTo('#rowBlock:last-child');
													$newItemBlock.find('#postPic').css('background-image', 'url(php/image_proxy.php?image=' + source + ')');
							         				//$newItemBlock.find('#postPic').attr('src',source);
		         									$newItemBlock.find('#postSubjectLink').html(subject);
		         									$newItemBlock.find('#postSubjectLink').attr('href','../merch/?pid=' + postID);
		         									$newItemBlock.find('#imageLink').attr('href','../merch/?pid=' + postID);
		         									$newItemBlock.find('#postDescription').html(description);
		         									$newItemBlock.find('#postPrice').html(price);

		         									postCount++;
												}
											}
											if(numberOfItems == 4) //If they did give us back 4 items(2 rows) that means they might have more so create the Show More button again
											{
												$("<div style='width: 100px;margin:0px auto;''><a href='#' id='showMore' style='text-align:center;'>Show More</a></div>").insertAfter('#rowBlock:last-child');
											}
									}	
								});
								return false;
							});
	         			}
	         		}
	         		else
	         		{
	         			//If they have no items, create a div with No Items in it
	         			$('#tab_1_1_1').find('#rowBlock').remove();
	         			$('#tab_1_1_1').append("<div class='span12'><p style='text-align:center;'>No Items</p></div>"); 
	         		}
	         	}
	         });
			
	         $('#followButton').on('click',function(){
	         	$.ajax({
	         		type: 'GET',
	         		url: 'php/follow.php',
	         		dataType: 'json',
	         		data: ({'userid': u_id}),
	         		success: function(response)
	         		{
	         			if(response.Status == "Unfollow")
	         			{
	         				$('#followButton').html('Follow');
     				
		     				//New Firebase ref
		     				var fireserver1 = new Firebase('https://anilum.firebaseio.com/PROD/Users/'+response.User_FK+'/Data/'+response.FireLoc);
			     			//Remove the like notification in the Firebase
			     			fireserver1.remove();
		 
	         			}
	         			else if(response.Status == "Follow")
	         			{
	         				$('#followButton').html('Unfollow');
	         				
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
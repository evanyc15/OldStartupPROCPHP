$(document).ready(function(){
	/*var offersBlock = $('#offersBlock');
	offersBlock.remve();*/
	var $offerBox = $('#offersBlock').clone(true,true); //Copy of the offer block
	for(var i=0;i<numberOfPosts;i++)
	{
		$('#collapse_' + i).find('#offersBlock').remove();
	}
	var $newOfferBlock;
	postidarray = JSON.parse(postarray);
	$.ajax( //Initial Ajax call for the offers
	{
		type: 'GET',
		url: 'php/offers.php',
		dataType: 'json',
		data: {postid: postidarray},
		success: function(response)
		{
			for(var i=0; i < response.length; i++) //Iterating through the row of Posts
			{
				for(var j=0; j < response[i].length; j++) //Iterating through the offers of each post
				{
					$newOfferBlock = $offerBox.clone(true,true);
					$newOfferBlock.find('#offerName').html(response[i][j]['FirstName'] + " " + response[i][j]['LastName']);
					$newOfferBlock.find('#offerPrice').html(response[i][j]['Price']);
					$newOfferBlock.find('#offerMessage').html("\"" + response[i][j]['Message'] + "\"");
					$newOfferBlock.find('#acceptButton').attr('href',response[i][j]['User_PK'] + '-' + response[i][j]['Post_FK'] + '-' + response[i][j]['Offer_PK']);
					$newOfferBlock.find('#rejectButton').attr('href',response[i][j]['User_PK'] + '-' + response[i][j]['Post_FK'] + '-' + response[i][j]['Offer_PK']);
					if(response[i][j]['Status'] == 'Accepted')
						$newOfferBlock.css('background','#e1f3f1');
					$newOfferBlock.appendTo('#offers-inner_'+i);
				}
			}
		}
	});
	
	$('#acceptButton').live('click',function()
	{
		var offerAccept = new Object();
		var PK_Split = ($(this).attr('href')).split('-'); //Offerer-PostID-OfferID
		offerAccept.offererID = PK_Split[0]; //Person who made offer(send notification to this person)
		offerAccept.postID = PK_Split[1]; //Post ID of offer
		offerAccept.offerID = PK_Split[2]; //Offer ID
		offerAccept.userID = session.toString(); //Person who is getting offer(fromUser_FK)
		offerAccept.Name = userName;
		offerAccept.Price = $(this).siblings('#offerPrice').html();
		offerAccept.Status = "accepted";

		console.log(offerAccept);
		
		var $currentCopy = $(this);
		$.ajax(
		{
			type: 'GET',
			url: 'php/response.php',
			dataType: 'json',
			data: {offerInfo: JSON.stringify(offerAccept)},
			success: function(response)
			{
				
				var fireserver = new Firebase('https://anilum.firebaseio.com/PROD/Users/'+response.User_FK+'/Data');

				var newloc = fireserver.push();

				newloc.set(
				{
					Notifications_PK: response.Notifications_PK,
					User_FK: response.User_FK,
					fromUser_FK: response.fromUser_FK,
					fromName: response.fromName,
					Post_FK: response.Post_FK,					
					Post_Subject: response.Post_Subject,
					OfferPrice: response.OfferPrice,
					Status: response.Status,
					DateTime: response.DateTime,
					ProfilePic: response.ProfilePicture,
					ParentLoc: newloc.name(),
					Type: 'OfferResponse',
					Last_Read: '0'
				});


				$currentCopy.parent().parent().children().css('background','#fafafa');
				$currentCopy.parent().animate({backgroundColor:'#e1f3f1'},200);

				var fireLocObject = new Object();
				fireLocObject.fireloc = newloc.name();
				fireLocObject.notificationpk = response.Notifications_PK;
				$.ajax(
				{
					type: 'POST',
					url: 'php/insertfireloc.php',
					data: {json: JSON.stringify(fireLocObject)}
				});
			}
		});
		return false;
	});
	$('#rejectButton').live('click',function()
	{
		var offerReject = new Object();
		var PK_Split = ($(this).attr('href')).split('-'); //Offerer-PostID-OfferID
		offerReject.offererID = PK_Split[0]; //Person who made offer(send notification to this person)
		offerReject.postID = PK_Split[1]; //Post ID of offer
		offerReject.offerID = PK_Split[2]; //Offer ID
		offerReject.userID = session.toString(); //Person who is getting offer(fromUser_FK)
		offerReject.Name = userName;
		offerReject.Price = $(this).siblings('#offerPrice').html();
		offerReject.Status = "rejected";
		
		var $currentCopy = $(this);
		$.ajax(
		{
			type: 'GET',
			url: 'php/response.php',
			dataType: 'json',
			data: {offerInfo: JSON.stringify(offerReject)},
			success: function(response)
			{
				var fireserver = new Firebase('https://anilum.firebaseio.com/PROD/Users/'+response.User_FK+'/Data');

				var newloc = fireserver.push();

				newloc.set(
				{
					Notifications_PK: response.Notifications_PK,
					User_FK: response.User_FK,
					fromUser_FK: response.fromUser_FK,
					fromName: response.fromName,
					Post_FK: response.Post_FK,					
					Post_Subject: response.Post_Subject,
					OfferPrice: response.OfferPrice,
					Status: response.Status,
					DateTime: response.DateTime,
					ProfilePic: response.ProfilePicture,
					ParentLoc: newloc.name(),
					Type: 'OfferResponse',
					Last_Read: '0'
				});

				$currentCopy.parent().fadeOut(500);
				setTimeout(function(){$currentCopy.parent().remove();},500);

				var fireLocObject = new Object();
				fireLocObject.fireloc = newloc.name();
				fireLocObject.notificationpk = response.Notifications_PK;
				$.ajax(
				{
					type: 'POST',
					url: 'php/insertfireloc.php',
					data: {json: JSON.stringify(fireLocObject)}
				});
			}
		});
		return false;
	});
});

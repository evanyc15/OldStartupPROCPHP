$(document).ready(function(){
	var jsonArray = new Object();
	var $textbox = $('.post-box').clone(true,true);
	$('.post-box').remove();
	
	//Begin ajax call to get comments and populate
	$.ajax({
		type: 'GET',
		url: 'php/get_comment.php',
		dataType: 'json',
		data: ({'postid': idpost}),
		success: function(response){
			for(var i = 0; i<response.length;i++){
				var comment = response[i].Comment;
				var $newbox = $textbox.clone(true,true);
		       $newbox.appendTo('#comment-display-box');
		       $newbox.find('#post-text').val(comment);
			}	
		}
	});
	
	//When enter is pressed in the textarea
	$('#input-box').keypress(function(e){
		if (e.keyCode == 13) { 
	       var textcontent = $(this).val();
	       var url = window.location.pathname;
		   var id = url.substring(url.lastIndexOf('=') + 1);
	       var $newbox = $textbox.clone(true,true);
	       $newbox.appendTo('#comment-display-box');
	       
	  	   //Initialize to json Object	
	       jsonArray.postId = idpost;
	       jsonArray.userId = session;
	       jsonArray.comment = textcontent;
	       
	       //Post data to Comment DB
	       	$.ajax({
				type: 'POST',
				url: 'php/post_comment.php',
		   		data: {json: JSON.stringify(jsonArray)},
		   		dataType:'json',
		   		success: function(response){
		   			//Start fireserver and insert the comment data to the firebase
		   			var fireserver = new Firebase('https://anilum.firebaseio.com/Users/'+response[0]+'/Data');
		   			//AutoIncr a new ref location for data
		   			var newloc = fireserver.push();
		   			//Insert data into the new ref location
		   			newloc.set({
		   				FromUser_FK: response[1],
		   				fromName: response[2],
		   				Post_FK: response[3],
		   				Post_Title: response[4],
		   				DateTime: response[5],
		   				Comment: response[6],
		   				Notifications_PK: response[7],
		   				ProfilePic: response[8],
		   				Parent_Loc: newloc.name(),
		   				Type: 'Comment',
		   				Last_Read: '0'
		   			});
		   		}
		   });
	       $newbox.find('#post-text').val(textcontent);
	       $(this).val('');
   		 }
	});
	$('#save,#like,#share').hover(function(){
		$(this).animate({height: '75px'},500);
	},function(){
		$(this).animate({height: '25px'},500);
	});
});




	/*var $tile_pic = $('#pic-tiles').clone(true,true);
	$('#pic-tiles').remove();
	$.ajax({
		type: 'GET',
		url: 'call_db.php',
		dataType: 'json',
		success: function(response){
			for(var i = 0; i<response.length;i++){
				if(response[i][0] != ""){
					var image = ".." + response[i][0];
					var $clone_img = $tile_pic.clone(true,true);
					var url = "photo.php?id="+response[i][1];
					$clone_img.find('img').attr({
						src: image,
						alt: url
					});
					//$('#tiles li img').attr("src",image);
					$('#tiles').append($clone_img);
				}
			}
		}
	});
	var $currImage;*/
	//$('.lightbox-contentbox').hide();
	
	/*$tile_pic.click(function(){
		$('.lightbox-contentbox').fadeIn(1500);
		$currImage = $(this).find('#click-img').clone(true,true);
		$currImage.removeAttr('display','width','height');
		$currImage.css({
			'position': 'absolute',
			'top': '15%',
			'width': '100%',
			'height': 'auto'
		});
		$('#image-box').empty().append($currImage);
	});*/

function bookmarkLikeStatus()
{
	$('#bookmark-btn').live('click', function(){
		var status = true;
		var postID = $(this).find('i').attr('name');
		
		if(type == "bookmarks")
		{
			if($(this).parent().parent().parent().hasClass('opacity-level'))
				$(this).parent().parent().parent().removeClass('opacity-level'); //gets the id='entire-post'
			else
				$(this).parent().parent().parent().addClass('opacity-level'); //gets the id='entire-post'
			
		} //if
		
		if($(this).find('i').hasClass('color-1'))
		{
			$(this).find('i').removeClass('color-1');
			$(this).find('i').addClass('color-2');
			status = false;
		} //if
		else
		{
			$(this).find('i').removeClass('color-2');
			$(this).find('i').addClass('color-1');
		} //if
		
		$.ajax({
	          url: "php/bookmark.php",
	          type: "get",
	          data: {status: status, postID: postID}
	        });
		return false;	
	});	
	
	$('#like-btn').live('click', function(){
		var status = true;
		var postID = $(this).find('i').attr('name');
		
		if($(this).find('i').hasClass('color-1'))
		{
			$(this).find('i').removeClass('color-1 icon-heart-empty');
			$(this).find('i').addClass('color-2 icon-heart');
			var status = false;
		} //if
		else
		{
			$(this).find('i').removeClass('color-2 icon-heart');
			$(this).find('i').addClass('color-1 icon-heart-empty');
		} //if
		
		$.ajax({
	          url: "php/like.php",
	          type: "get",
	          data: {status: status, postID: postID}
	        });
		return false;
		});	
} //function
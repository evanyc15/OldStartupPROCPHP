$(document).ready(function(){
	var jsonArray = new Object();
	var $commentBox = $('#commentBox').clone(true,true);
	$('#commentBox').remove();
	$.ajax({
		type: 'GET',
		url: '../php/comment_form.php',
		dataType: 'json',
		data: "<?php echo $_GET;?>",
		success: function(response)
		{
			for(var i=0;i < response.length;i++)
			{
				var comment = response[i].Comment;
				var postID = response[i].User_PK;
				var firstName = response[i].FirstName;
				var lastName = response[i].LastName;
				var date = response[i].DateTime;
				var profilePic = response[i].ProfilePicture;

				var $newCommentBox = $commentBox.clone(true,true);
				$newCommentBox.appendTo('#commentsTab');
				$newCommentBox.find('#profilePicture').attr('href','../../profile/?pid=' + postID);
				$newCommentBox.find('#profilePicture').attr('src',profilePic);
				$newCommentBox.find('#fullname').val(firstName + ' ' + lastName);
				$newCommentBox.find('#date').val(date);
				$newCommentBox.find('#comment').val(comment);
			}
		}
	});
	$('#comment_form').submit(function(){

	});

	$('#comment_form').keypress(function(e){
		if(e.keyCode == 13)
		{
			$('#comment_form').submit();
		}
	});
});

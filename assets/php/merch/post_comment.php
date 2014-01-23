<?php
	//Parse Json
	$data = $_POST['json'];
	$inputJson = json_decode($data);
	$post_id = $inputJson->postId;
	$user_id = $inputJson->userId;
	$user_comment = $inputJson->comment;
	$fromUser = $_SESSION['id'];
	
	//automatically bookmark the post commented on
	$query = "SELECT COUNT(*) AS c FROM Bookmarks_Users_Posts WHERE User_FK = '$user_id' AND Post_FK = '$post_id'";
	$result  = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	
	if($row['c'] == 0) //don't allow the post to be bookmarked more than once
	{
		$query = "SELECT COUNT(*) AS c FROM Posts WHERE User_FK = '$user_id' AND Post_PK = '$post_id'";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result);
		if($row['c'] == 0) //don't allow a users OWN POST to be bookmarked
		{
			$query = "INSERT INTO Bookmarks_Users_Posts (User_FK, Post_FK) VALUES ('$user_id', '$post_id')";
			mysqli_query($con, $query);
		} //if
	} //if
	
	//Inserting the comment/data into the Comments table
	$sql = $con->query(
    "INSERT INTO PostComments (User_FK,Post_FK,Comment) 
    VALUES ('$user_id','$post_id','$user_comment')");
	if (!$sql) {
    	die('Invalid query: ' . mysqli_error());
	}
	
	$query = "UPDATE Posts SET Comment_Count = Comment_Count + 1 WHERE Post_PK = '$post_id'"; 
	mysqli_query($con, $query);
	
	//Get the current Comment PK
	$query = "SELECT * FROM PostComments WHERE User_FK = '$user_id' AND 
		Post_FK = '$post_id' AND Comment = '$user_comment'";
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_array($result);
	$comment_pk = $row['Comment_PK'];
	
	$fireserverdata = array();
	
	//Getting the User that posted and the post title
	$query = "SELECT * FROM Posts WHERE Post_PK = '$post_id'";
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_array($result);
	$userfk = $row['User_FK'];
	$post_title = $row['Subject'];
	
	//Getting the user that posted's name, his/her profile picture, and datetime of post
	$query = "SELECT * FROM Users WHERE User_PK = '$fromUser'";
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_array($result);
	$name = $row['FirstName']." ".$row['LastName'];
	$img_url = $row['ProfilePicture'];
	
	$datetime = date('Y-m-d H:i:s',time());
	
	$temp_notif_data = array (
		'User_FK' => $fromUser,
		'Name' => $name,
		'Post_FK' => $post_id,
		'DateTime' => $datetime,
		'Comment' => $user_comment
	);
	
	$notification_data = json_encode($temp_notif_data);
	
	//Insert the data into the notifications table
	$notifications_sql = $con->query(
    "INSERT INTO Notifications (User_FK,Notifications_Type,Notifications_Data,Last_Read) 
    VALUES ('$userfk','Comment','$notification_data','0')");
	if (!$notifications_sql) {
    	die('Invalid query: ' . mysqli_error());
	} 
	
	//Selecting from db to get the Notification_PK
	$query = "SELECT * FROM Notifications WHERE User_FK = '$userfk' AND Notifications_Data = '$notification_data'";
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_array($result);
	$NotificationPK = $row['Notifications_PK'];
	
	$fireserverdata = array(
		'UserFK' => $userfk,
		'FromUser_FK' => $fromUser,
		'fromName' => $name,
		'Post_FK' => $post_id,
		'Post_Title' => $post_title,
		'DateTime' => $datetime,
		'Comment' => $user_comment,
		'Notifications_PK' => $NotificationPK,
		'ProfilePic' => $img_url
	);
	
	//Set the Notifications PK in the comments table with the respective comment PK
	$query = "UPDATE PostComments SET Notification_FK='$NotificationPK'
		WHERE Comment_PK='$comment_pk'";
	$result = mysqli_query($con,$query);
	
	echo json_encode($fireserverdata);
	
	mysqli_close($con);	
?>
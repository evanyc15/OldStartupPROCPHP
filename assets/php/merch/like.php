<?php
$userID = $_SESSION['id'];
$postID = $_GET['postid'];

$query = "SELECT * FROM Likes_Users_Posts WHERE User_FK = '$userID' AND Post_FK = '$postID'";
$main_result = mysqli_query($con, $query);

//Query Get who owns the current post and the post's title
$post_query = "SELECT * FROM Posts WHERE Post_PK = '$postID'";
$post_result = mysqli_query($con, $post_query);
$post_row = mysqli_fetch_array($post_result);
$owner = $post_row['User_FK'];
$post_title = $post_row['Subject'];

//If the button is already liked, delete from the Likes_Users_Posts table
if($main_result && mysqli_num_rows($main_result) > 0) //deleting the row
{
	$query = "SELECT * FROM  Likes_Users_Posts WHERE User_FK = '$userID' AND Post_FK = '$postID'";
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_array($result);
	$notification_pk = $row['Notification_FK'];
	
	$query = "DELETE FROM Likes_Users_Posts WHERE User_FK = '$userID' AND Post_FK = '$postID'";
	if(mysqli_query($con, $query))
	{
		$query = "UPDATE Posts SET Likes = Likes - 1 WHERE User_FK = '$userID' AND Post_PK ='$postID'";
		$popularityQuery = "UPDATE Posts SET Popularity = Popularity - 2 WHERE Post_PK = '$postID'";
		mysqli_query($con,$query);
		mysqli_query($con,$popularityQuery);
	} //if
	
	$query = "SELECT * FROM Notifications WHERE Notifications_PK = '$notification_pk'";
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_array($result);
	$fireloc = $row['FireLoc'];
	
	$query = "DELETE FROM Notifications WHERE Notifications_PK = '$notification_pk'";
	$result = mysqli_query($con,$query);
	
	$tempArray = array(
		'User_FK' => $owner,
		'FireLoc' => $fireloc,
		'Status' => "Unlike"
	);
	
	echo json_encode($tempArray);
} //if

//Part of code that is implemented when user clicks like
else
{
	$query = "SELECT * FROM Users WHERE User_PK = '$userID'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	$img_url = $row['ProfilePicture'];
	$name = $row['FirstName']." ".$row['LastName'];
			
	//Insert the Like into the table
	$query = "INSERT INTO Likes_Users_Posts
	VALUES ('$userID','$postID',DEFAULT,DEFAULT)";
	if(mysqli_query($con, $query))
	{
		$query = "UPDATE Posts SET Likes = Likes + 1 WHERE User_FK = '$userID' AND Post_PK ='$postID'";
		$popularityQuery = "UPDATE Posts SET Popularity = Popularity + 2 WHERE Post_PK = '$postID'";
		mysqli_query($con,$query);	
		mysqli_query($con,$popularityQuery);
	} //if
	
	//Getting datetime of the post
	$query = "SELECT * FROM Likes_Users_Posts WHERE User_FK = '$userID' AND Post_FK = '$postID'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	$datetime = $row['DateTime'];
	
	//Create associative array to be used with json_encode
	$tempData = array(
		'User_FK' => $userID,
		'Name' => $name,
		'Post_FK' => $postID,
		'DateTime' => $datetime
	);
	
	//Creating json object with the array
	$notification_data = json_encode($tempData);
	
	//Insert the new data into the notifications table
	$query = "INSERT INTO Notifications
	VALUES (DEFAULT,'$owner','Like','$notification_data',DEFAULT,'0',DEFAULT)";
	$result = mysqli_query($con,$query);
	
	//Getting the Owner of posts and Notifications_PK to use in the json Array
	$query = "SELECT * FROM Notifications WHERE User_FK = '$owner' AND Notifications_Type = 'Like' 
		AND Notifications_Data = '$notification_data'";
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_array($result);
	$Notification_PK = $row['Notifications_PK'];
	
	$query = "UPDATE Likes_Users_Posts SET Notification_FK='$Notification_PK'
		WHERE User_FK='$userID' AND Post_FK='$postID'";
	$result = mysqli_query($con,$query);
	
	//Create associative array to be used with json_encode
	$jsonArray = array(
		'User_FK' => $owner,
		'fromUserFK' => $userID,
		'fromName' => $name,
		'DateTime' => $datetime,
		'Post_FK' => $postID,
		'Post_Title' => $post_title,
		'ProfilePic' => $img_url,
		'Notifications_PK' => $Notification_PK,
		'Status' => "Like"
	);
	
	
	//Encode as json object with the array and echo
	echo json_encode($jsonArray);
	
} //else
mysqli_close($con);
?>
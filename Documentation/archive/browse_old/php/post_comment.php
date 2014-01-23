<?php
	include('../../globalref/php/sqlconf.php');
	include('../../globalref/php/sessionstart.php');
	
	$data = $_POST['json'];
	$inputJson = json_decode($data);
	$post_id = $inputJson->postId;
	$user_id = $inputJson->userId;
	$user_comment = $inputJson->comment;
	$fromUser = $_SESSION['id'];
	
	$sql = $con->query(
    "INSERT INTO PostComments (User_FK,Post_FK,Comment) 
    VALUES ('$user_id','$post_id','$user_comment')");
	if (!$sql) {
    	die('Invalid query: ' . mysqli_error());
	} 
	
	$fireserverdata = array();
	
	$post_sql = "SELECT * FROM Posts WHERE Post_PK = '$post_id'";
	$post_result = mysqli_query($con,$post_sql);
	$post_row = mysqli_fetch_array($post_result);
	$userfk = $post_row['User_FK'];
	$post_title = $post_row['Subject'];
	
	$user_sql = "SELECT * FROM Users WHERE User_PK = '$fromUser'";
	$user_result = mysqli_query($con,$user_sql);
	$user_row = mysqli_fetch_array($user_result);
	$name = $user_row['FirstName']." ".$user_row['LastName'];
	$img_url = $user_row['ProfilePicture'];
	
	$datetime = date('Y-m-d H:i:s',time());
		
	array_push($fireserverdata,$userfk);
	array_push($fireserverdata,$fromUser);
	array_push($fireserverdata,$name);
	array_push($fireserverdata,$post_id);
	array_push($fireserverdata,$post_title);
	array_push($fireserverdata,$datetime);
	array_push($fireserverdata,$user_comment);
	
	$temp_notif_data = array (
		'User_FK' => $fromUser,
		'Name' => $name,
		'Post_FK' => $post_id,
		'DateTime' => $datetime,
		'Comment' => $user_comment
	);
	
	$notification_data = json_encode($temp_notif_data);
	
	$notifications_sql = $con->query(
    "INSERT INTO Notifications (User_FK,Notifications_Type,Notifications_Data,Last_Read) 
    VALUES ('$userfk','Comment','$notification_data','0')");
	if (!$notifications_sql) {
    	die('Invalid query: ' . mysqli_error());
	} 
	$notification_retrieve_sql = "SELECT * FROM Notifications WHERE User_FK = '$userfk' AND Notifications_Data = '$notification_data'";
	$retrieve_result = mysqli_query($con,$notification_retrieve_sql);
	$retrieve_row = mysqli_fetch_array($retrieve_result);
	$NotificationPK = $retrieve_row['Notifications_PK'];
	array_push($fireserverdata,$NotificationPK);
	array_push($fireserverdata,$img_url);
	
	echo json_encode($fireserverdata);
	
	mysqli_close($con);	
?>
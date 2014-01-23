<?php
	$notify_id = $_GET['notificationid'];
	
	$sql = "SELECT * FROM Notifications WHERE Notifications_PK = '$notify_id'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);
	
	$jsonObject = json_decode($row['Notifications_Data']);
	$userkey = $jsonObject->{'User_FK'};
	$user_sql = "SELECT * FROM Users WHERE User_PK = '$userkey'";
	$user_result = mysqli_query($con,$user_sql);
	$user_row = mysqli_fetch_array($user_result);
	$user_name = $user_row['FirstName'];
	array_push($row,$user_name);

	echo json_encode($row);
	mysqli_close($con);	
?>
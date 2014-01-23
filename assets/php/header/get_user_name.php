<?php
	$user_id = $_GET['userpk'];
	
	$sql = "SELECT * FROM Users WHERE User_PK = '$user_id'";
	$result = mysqli_query($con,$sql);
	$user_row = mysqli_fetch_array($result);
	echo json_encode($user_row);
	mysqli_close($con);	
?>
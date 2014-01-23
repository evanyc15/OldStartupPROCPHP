<?php
	$user_id = $_GET['userid'];
	
	$sql = "SELECT * FROM Notifications WHERE User_FK = '$user_id'";
	$result = mysqli_query($con,$sql);
	$notifications_row = array();
	$i = 0;
	while($row = mysqli_fetch_array($result))
	{
		if($row['Last_Read'] == 0){		
			$notifications_row[$i] = $row;
			$jsonObject = json_decode($row[3]);
			$userkey = $jsonObject->{'User_FK'};
			$user_sql = "SELECT * FROM Users WHERE User_PK = '$userkey'";
			$user_result = mysqli_query($con,$user_sql);
			$user_row = mysqli_fetch_array($user_result);
			$user_name = $user_row['FirstName'];
			array_push($notifications_row[$i],$user_name);
			$i++;
		}
	}
	echo json_encode($notifications_row);
	mysqli_close($con);	
?>
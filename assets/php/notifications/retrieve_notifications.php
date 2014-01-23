<?php
	require("../../../assets/php/notifications/retrieve_notifications.php");
	$user_id = $_SESSION['id'];
	$current = $_GET['currcount'];
	$increment = $_GET['increment'];
	
	$sql = "SELECT *,
			TIME_FORMAT(TIMEDIFF(NOW(),Timestamp),'%y %m %d %H %i %S') AS TimeDiff 
			FROM Notifications WHERE User_FK = '$user_id'
			LIMIT $current,$increment";
	
	$result = mysqli_query($con,$sql);
	$notifications_row = array();
	$i = 0;
	while($row = mysqli_fetch_array($result))
	{
			$notifications_row[$i] = array(
				'User_FK'=> $row['User_FK'],
				'Notifications_Type'=> $row['Notifications_Type'],
				'Notifications_Data'=> $row['Notifications_Data'],
				'TimeDiff' => $row['TimeDiff']
			);
			$i++;
	}
		
	echo json_encode($notifications_row);
	mysqli_close($con);	
?>
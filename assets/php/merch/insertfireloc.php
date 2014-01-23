<?php
	$data = $_POST['json'];
	$inputJson = json_decode($data);
	$fireloc = $inputJson->fireloc;
	$notificationpk = $inputJson->notificationpk;

	$sql = $con->query(
	"UPDATE Notifications SET FireLoc='$fireloc'
	WHERE Notifications_PK='$notificationpk'");
	if (!$sql) {
    	die('Invalid query: ' . mysqli_error());
	} 
	
	mysqli_close($con);	
?>
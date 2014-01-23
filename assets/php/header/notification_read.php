<?php
	$userid = $_SESSION['id'];
	
	$sql = $con->query(
	"UPDATE Notifications SET Last_Read='1'
	WHERE User_FK='$userid'");
	if (!$sql) {
    	die('Invalid query: ' . mysqli_error());
	} 
	
	//Select all firebase locations for respective user to set Last Read to 1
	$sql = "SELECT FireLoc FROM Notifications WHERE User_FK = '$userid'";
	$result = mysqli_query($con,$sql);
	$fireloc = array();
	$i = 0;
	while($row = mysqli_fetch_array($result))
	{
		$fireloc[$i] = array(
			'FireLoc' => $row['FireLoc']
		);
		$i++;
	}
	echo json_encode($fireloc);
	mysqli_close($con);	
?>
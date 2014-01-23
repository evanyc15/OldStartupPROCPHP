<?php
	$userid = $_SESSION['id']; //User
	$user1_fk = $_GET['user1_fk']; //Person the user is having the conversation with
	
	//Select all firebase locations for respective user to set Last Read to 1
	$sql = "SELECT FireLoc FROM Messages_Users_Users WHERE User1_FK = '$user1_fk' AND User2_FK = '$userid'";
	$result = mysqli_query($con,$sql);
	$fireloc = array();
		while($row = mysqli_fetch_array($result))
		{
			$fireloc[] = array(
				'FireLoc' => $row['FireLoc']
			);
		}
	echo json_encode($fireloc);
	mysqli_close($con);	
?>
<?php
	$user = $_SESSION['id'];
	
	
	$sql = "SELECT DATE_FORMAT(m.DateTime,'%b %d %Y %h:%i %p') AS ActualTime,m.Message,m.User1_FK,
			u.FirstName,u.LastName,u.ProfilePicture
			FROM Messages_Users_Users AS m
			INNER JOIN Users AS u
			ON u.User_PK = m.User1_FK
			WHERE m.User2_FK = '$user'
			GROUP BY m.User1_FK
			ORDER BY m.DateTime ASC";
	
	$result = mysqli_query($con,$sql);
	$i = 0;
	$message_row = array();
	while($row = mysqli_fetch_array($result)){
		$message_row[$i] = $row;
		$i++;
	}
	
	echo json_encode($message_row);
?>

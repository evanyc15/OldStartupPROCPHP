<?php	
	//Get from user from session, to user and from user's message
	$fromuser = $_SESSION['id'];
	$touser = mysqli_real_escape_string($con,$_POST['touser']);//flag test. might block
	$message = mysqli_real_escape_string($con,$_POST['message']);
	
	
	//Insert them into the table
	$sql = $con->query(
    "INSERT INTO Messages_Users_Users (User1_FK,User2_FK,Message) 
    VALUES ('$fromuser','$touser','$message')");
	if (!$sql) {
    	die('Invalid query: ' . mysqli_error());
	} 
	
	$newRecordId = mysqli_insert_id($con);
	
	//Get the newly added data's data like the Datetime and Profile picture
	//$sql = "SELECT DATE_FORMAT(m.DateTime,'%b %d %Y %h:%i %p') AS DateTime, u.ProfilePicture
	$sql = "SELECT DATE_FORMAT(m.DateTime,'%b %d %Y %h:%i %p') AS DateTime, u.ProfilePicture
			FROM Messages_Users_Users
			AS m
			INNER JOIN Users
			AS u
			ON m.User1_FK = u.User_PK
			WHERE m.Auto_Inc = '$newRecordId'";
	
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);
	
	$datetime = $row['DateTime'];
	
	$array = array(
		'ProfilePicture' => $row['ProfilePicture'],
		'DateTime'=> $datetime,
		'Msg_PK'=> $newRecordId
	);
	
	echo json_encode($array);
	
	mysqli_close($con);	
?>
<?php
	$user_ID_H = $_SESSION['id'];
	
	$sql_H = "SELECT * FROM Users WHERE User_PK = '$user_ID_H'";
	
	if($result_H = mysqli_query($con,$sql_H)){}
	if($row_H = mysqli_fetch_array($result_H)){}
	
	$firstName_H = $row_H['FirstName'];
	$lastName_H = $row_H['LastName'];
	$profilePicture_H = $row_H['ProfilePicture'];
	$new_user = $row_H['NewUser'];
?>
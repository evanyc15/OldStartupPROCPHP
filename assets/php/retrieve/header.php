<?php

$row;

if(!isset($_GET['code']))
{
	header("Location: /");
}
else
{
	$code = $_GET['code'];
	$query = "SELECT * FROM ResetPassword WHERE Code = '$code'";
	$result = mysqli_query($con, $query);
	
	if (mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);
		$user_id = $row['User_FK'];
		
		$query = "SELECT * FROM Users WHERE User_PK = '$user_id'";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result);
		$ProfilePicture = $row['ProfilePicture'];
		
		session_start();
		
		$_SESSION['email'] = mysqli_real_escape_string($con,$row['Email']);
		$_SESSION['FirstName'] = mysqli_real_escape_string($con,$row['FirstName']);
		$_SESSION['LastName'] = mysqli_real_escape_string($con,$row['LastName']);
		$_SESSION['id'] = mysqli_real_escape_string($con,$row['User_PK']);
		
	}
	else 
	{
		header("Location: /");
	}
}

?>
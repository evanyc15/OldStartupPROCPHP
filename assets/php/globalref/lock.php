<?php
	$user_email = $_SESSION['email'];
	$user_password = $_SESSION['password'];

	$ses_query = mysqli_query($con,"SELECT User_PK FROM Users WHERE Email = '$user_email' AND Password = '$user_password'");
	
	//$login_session = mysqli_real_escape_string($con,$row['User_FK']);
	
	if(mysqli_num_rows($ses_query) < 1)
	{
		header("Location: /login/");
	}
?>
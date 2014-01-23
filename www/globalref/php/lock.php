<?php
	include('sqlconf.php');
	//session_save_path("/session/");
	include('sessionstart.php');
	$user_check = $_SESSION['email'];
	
	$ses_query = mysqli_query($con,"SELECT Email FROM Users WHERE Email = '$user_check'");
	
	
	$row = mysqli_fetch_array($ses_query);
	
	$login_session = $row['Email'];
	
	if(!isset($login_session))
	{
		header("Location: /");
	}
?>
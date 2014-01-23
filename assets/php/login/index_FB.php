<?php
// Check if they are already logged in, and if so, then send them to home
if (isset($_SESSION['email']))
{
	$user_check = $_SESSION['email'];
	$ses_query = mysqli_query($con,"SELECT Email FROM Users WHERE Email = '$user_check'");
	$row = mysqli_fetch_array($ses_query);
	$login_session = $row['Email'];
	if(isset($login_session))
	{
		header("Location: /home/");
	}
}

mysqli_close($con);
?>
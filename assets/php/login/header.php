<?php 

if(isset($_SESSION['email']) && isset($_SESSION['password']))
{
	$user_email = $_SESSION['email'];
	$user_password = $_SESSION['password'];

	$ses_query = mysqli_query($con,"SELECT User_PK FROM Users WHERE Email = '$user_email' AND Password = '$user_password'");

	if(mysqli_num_rows($ses_query) > 0)
	{
		header("Location: /home/");
	}

}
mysqli_close($con);

?>
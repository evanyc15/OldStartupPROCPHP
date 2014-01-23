<?php 

include('../../globalref/php/sqlconf.php');
include('../../globalref/php/sessionstart.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$email = addslashes($_POST['email']);
	$password = addslashes($_POST['password']);
	$password = md5($password);
	
	if(filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email))
	{

		$sql = "SELECT * FROM Users WHERE Email = '$email' AND Password = '$password'";
		$result = mysqli_query($con,$sql);
	
		$numRows = mysqli_num_rows($result);
	
		$row = mysqli_fetch_array($result);
	
		if($numRows == 1)
		{
			$_SESSION['email'] = $email;
			$_SESSION['FirstName'] = $row['FirstName'];
			$_SESSION['LastName'] = $row['LastName'];
			$_SESSION['id'] = $row['User_PK'];
			mysqli_close($con);
			header("Location: /home/");
		}
		else
		{
			$_SESSION['error'] = 1;
			header("Location: /login/");
		}
	
	}
	else 
	{

		$_SESSION['error'] = 2;
		header("Location: /login/");
	}
	mysqli_close($con);
}

?>
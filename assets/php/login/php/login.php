	<?php 

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$email = addslashes($_POST['email']);
	$password = addslashes($_POST['password']);
	$password_test = $password;
	
	$password = md5($password);

	//generateSalt($length = 8);
	//$password_test = hash($password_test);
	
	//echo("-------------------- '$password'-----------");
	//echo("-------------------- '$password_test'-----------");
	
	
	
	if(filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email))
	{

		$sql = "SELECT * FROM Users WHERE Email = '$email' AND Password = '$password'";
		$result = mysqli_query($con,$sql);
	
		$numRows = mysqli_num_rows($result);

		$row = mysqli_fetch_array($result);
	
		if($numRows == 1)
		{
			$_SESSION['email'] = $row['Email'];
			$_SESSION['FirstName'] = $row['FirstName'];
			$_SESSION['LastName'] = $row['LastName'];
			$_SESSION['id'] = $row['User_PK'];
			$_SESSION['password'] = $row['Password'];
			$user_id = $_SESSION['id'];
			mysqli_close($con);
			header("Location: /browse/?type=newsfeed");
		}
		else
		{
			$query = "UPDATE Users SET User_Password_Error = 1, WHERE User_PK = '$user_id'";
			mysqli_query($con, $query);
			$_SESSION['error'] = 1;
			header("Location: /login/index_error.php");
		}
	
	}
	else 
	{
		$query = "UPDATE Users SET User_Password_Error = 1, WHERE User_PK = '$user_id'";
		mysqli_query($con, $query);
		$_SESSION['error'] = 2;
		header("Location: /login/index_error.php");
	}
	mysqli_close($con);
}
	
	
	?>
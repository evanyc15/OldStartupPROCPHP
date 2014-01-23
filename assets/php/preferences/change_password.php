<?php 

$user_id = $_SESSION['id'];

$password;
$stmt = $con->prepare("SELECT Password FROM Users WHERE User_PK = ?");
$stmt->bind_param('d', $user_id);
if ($stmt->execute())       // <== passed array of parameters
{
	$stmt->bind_result($password);
	while ($stmt->fetch())
	{

		//echo "$password";
		
	}

}

	if(isset($_POST['change'])) 
	{ //When button above pressed

	 if($password == md5($_POST['password_old_text']))
	 {//Then allow to change password
	 		 	
	 	$passwordnew = md5($_POST['password_new_text']);
	 	$confirm_new =md5($_POST['password_new_confirm']);
	 	//$confirm_new = md5($_POST['password_new_confirm']);
	 	
	 	if($passwordnew == $confirm_new)
	 	{//check if the user has confirmed same new password
	 		$password = $confirm_new;
	 		
	 		$sql =("UPDATE Users SET Password = ? WHERE User_PK = ?");
	 		$stmt = $con->prepare($sql);
	 		$stmt->bind_param('sd', $password, $user_id);
	 		
	 		//$stmt->execute();
	 		//$query = "UPDATE Users SET Password = '$password' WHERE User_PK = '$user_id'";
	 		
	 		if($stmt->execute())
	 		{
	 			header("Location: /preferences/");
	 			$flag = 0;
	 		}
	 	
	 	}
	 	

	 }
	 
	 else 
	 {
	 	
	 	echo "<br />\n";//new line
	 	echo "<font color='red'>Incorrect password, try again.</font>";
	 	echo "<br />\n";//new line
	 	$flag = 1;
		//echo "<a href=" . $passurl . "</a>"; I want to put a link to (forget password)  		
	 	header("Location: /preferences/");
	 }
	 
	 mysqli_close($con);
	 
	} 
?>

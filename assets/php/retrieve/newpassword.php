<?php 

$password = md5($_POST['password']);
$user_id = $_SESSION['id'];

if(mysqli_query($con, "UPDATE Users SET Password = '$password' WHERE User_PK = '$user_id'"))
	echo "IT WORKS!   ";

echo $password;
echo "   ".$user_id;

$_SESSION['password'] = $password;

header("Location: /");

?>
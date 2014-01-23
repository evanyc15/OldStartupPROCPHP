<?php
require("../globalref/php/lock.php");
require("../globalref/php/sqlconf.php");

//session_start();

$user_id = $_SESSION['id'];
	
$firstName;// First name of user
$lastName;// Last name of user
$about;// About information of user
$profilePicture;// Profile picture of user
$city;// City of user
$state;// State of user
$row;// For other needed information
	
$query = "SELECT * FROM Users WHERE User_PK = '$user_id'";
if($result = mysqli_query($con,$query))
{
		$row = mysqli_fetch_array($result);
		$firstName = $row['FirstName'];
		$lastName = $row['LastName'];
		$profilePicture = $row['ProfilePicture'];
		$city = $row['City'];
		$state = $row['State'];
		$email = $row['Email'];
}


?>
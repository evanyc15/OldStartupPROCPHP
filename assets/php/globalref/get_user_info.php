<?php

$user_id = $_SESSION['id'];
	
$firstName;// First name of user
$lastName;// Last name of user
$about;// About information of user
$profilePicture;// Profile picture of user
$city;// City of user
$state;// State of user
$row;// For other needed information
$newUser; //checks if the user is new!
	//$newUser = 1;
$query = "SELECT * FROM Users WHERE User_PK = '$user_id'";
if($result = mysqli_query($con,$query))
{
		$row = mysqli_fetch_array($result);
		$firstName = mysqli_real_escape_string($con,$row['FirstName']);
		$lastName = mysqli_real_escape_string($con,$row['LastName']);
		$profilePicture = mysqli_real_escape_string($con,$row['ProfilePicture']);
		$city = mysqli_real_escape_string($con,$row['City']);
		$state = mysqli_real_escape_string($con,$row['State']);
		$email = mysqli_real_escape_string($con,$row['Email']);
		$newUser = mysqli_real_escape_string($con,$row['NewUser']);
}


?>
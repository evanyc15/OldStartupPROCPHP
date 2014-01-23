<?php
require('../../../assets/php/globalref/sqlconf.php');
require("../../../assets/php/login/php/fb_signup.php");
mysqli_close($con);
/*
session_start();

$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$city = $_POST['city'];
$state = $_POST['state'];//Really state but I didnt wanna touch the code
$email = $_POST['email'];
$password = md5($_POST['password']);
$profilePicture = $_POST['profilePicture'];
$gender = ($_POST['gender'][0] == 'm') ? 'M' : 'F';
$birthdate = $_POST['birthdate'];
$facebookID = $_POST['fbid'];

echo $firstName . ' ' . $lastName . ' ' . $city . ' ' . $state . ' ' . $email . ' ' . $password . ' ' . $profilePicture . ' ' . $gender . ' ' . $birthdate . ' ' . $facebookID;
$fbuser_insert_query = mysqli_query($con,"INSERT INTO Users (User_PK,Email,Password,FirstName,LastName,City,State,ProfilePicture,Gender,Birthdate,FacebookID) VALUES (NULL,'$email','$password','$firstName','$lastName','$city','$state','$profilePicture','$gender',STR_TO_DATE('$birthdate','%m/%d/%Y'),'$facebookID')");
if($fbuser_insert_query)
{
	$_SESSION['id'] = mysqli_insert_id($con);
	$_SESSION['FirstName'] = $firstName;
	$_SESSION['LastName'] = $lastName;
	$_SESSION['email'] = $email;
	mysqli_close($con);
	header("Location: ../../home/");
	
}
*/
?>
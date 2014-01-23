<?php
//require('../../globalref/php/sqlconf.php');
//require("../../assets/php/globalref/sessionstart.php");
require('../../../assets/php/globalref/sqlconf.php');
require("../../../assets/php/login/php/fb_login.php");
mysqli_close($con);

/*
 * 
 * session_start();

$userFB = $_GET['fb'];
$userInfoJson = json_decode($userFB);
$firstName = $userInfoJson->firstName;
$lastName = $userInfoJson->lastName;
$city = $userInfoJson->city;
$state = $userInfoJson->state;
$profPic = $userInfoJson->picture;
$gender = $userInfoJson->gender;
$birthdate = $userInfoJson->birthday;
$facebookID = $userInfoJson->user_id;
//$email = $userInfoJson['email'];
$email = "testing13@yahoo.com";

//$facebookID = $userInfoJson['user_id'];
//echo $firstName . ' ' . $lastName . ' ' . $city . ' ' . $state . ' ' . $profPic . ' ' . $gender . ' ' . $birthdate . ' ' . $facebookID;
$insertQueryStatement = "INSERT INTO Users (Email,FirstName,LastName,City,State,ProfilePicture,Gender,Birthdate,FacebookID) VALUES ('$email','$firstName','$lastName','$city','$state','$profPic','$gender',STR_TO_DATE('$birthdate','%m/%d/%Y'),'$facebookID')";
$userInsertQuery = mysqli_query($con,$insertQueryStatement);

$_SESSION['id'] = mysqli_insert_id($con);
$_SESSION['FirstName'] = $firstName;
$_SESSION['LastName'] = $lastName;
$_SESSION['email'] = $email;
 */

?>
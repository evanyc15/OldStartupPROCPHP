<?php
  	include ('../../globalref/php/sqlconf.php');
  	

	$email =  mysqli_real_escape_string($con, $_POST['eml']);
	$password = mysqli_real_escape_string($con, $_POST['pwd']);
	$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
  	$password = md5($password);
  	
	$sql = $con->query(
    "INSERT INTO Users (Email,Password,FirstName,LastName) 
    VALUES ('$email','$password','$firstname','$lastname')");
	if (!$sql) {
    	die('Invalid query: ' . mysqli_error());
	} 
	else {
   		header("../../browse/index.php");
	}
	
	mysqli_close($con);
?> 
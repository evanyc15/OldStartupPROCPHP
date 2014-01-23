<?php
	$data = $_POST['json'];
	$inputJson = json_decode($data);
	$fireloc = $inputJson->fireloc;
	$msgpk = $inputJson->messagepk;

	$sql = $con->query(
	"UPDATE Messages_Users_Users SET FireLoc='$fireloc'
	WHERE Auto_Inc ='$msgpk'");
	if (!$sql) {
    	die('Invalid query: ' . mysqli_error());
	} 
	
	mysqli_close($con);	
?>
<?php 
	
	$post_id = $_GET['pid'];
	
	$query = "SELECT Subject,Description,CurrentPrice FROM Posts WHERE Post_PK='$post_id'";
	if($result = mysqli_query($con,$query))
	{
		$row = mysqli_fetch_array($result);
		$subject = mysqli_real_escape_string($con,$row['Subject']);
		$description = mysqli_real_escape_string($con,$row['Description']);
		$price = mysqli_real_escape_string($con,$row['CurrentPrice']);
	} //if
?>
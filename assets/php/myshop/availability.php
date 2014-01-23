<?php

$post_id = $_GET['postid']; // does this have to be POST ?
$user_id = $_SESSION['id'];
$status = $_GET['status']; //Something from the ajax call !!!

if($status == 'checked')
{
	$status = 1;
} //if
else
{
	$status = 0;	
} //else
$query = "UPDATE Posts SET Sold = '$status' WHERE Post_PK = '$post_id' AND User_FK = '$user_id'";
$result = mysqli_query($con, $query);
if($result)
{
	//echo "<br/> Update is successful!  Status: $status";
} //if

?>
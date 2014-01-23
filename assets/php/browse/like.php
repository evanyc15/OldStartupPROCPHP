<?php 
$userID = $_SESSION['id'];
$likeStatus = $_GET['status'];
$postID = $_GET['postID'];

if($likeStatus == "false")
{
	$query = "INSERT INTO Likes_Users_Posts (User_FK, Post_FK) VALUES ('$userID', '$postID')";
	mysqli_query($con, $query);
} //if
else
{
	$query = "DELETE FROM Likes_Users_Posts WHERE User_FK = '$userID' AND Post_FK = '$postID'";
	mysqli_query($con, $query);
} //else
	
?>
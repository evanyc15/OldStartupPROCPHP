<?php
$userID = $_SESSION['id'];
$bookmarkStatus = $_GET['status'];
$postID = $_GET['postID'];

if($bookmarkStatus == "false")
{
	$query = "INSERT INTO Bookmarks_Users_Posts (User_FK, Post_FK) VALUES ('$userID', '$postID')";
	mysqli_query($con, $query);
} //if
else
{
	$query = "DELETE FROM Bookmarks_Users_Posts WHERE User_FK = '$userID' AND Post_FK = '$postID'";
	mysqli_query($con, $query);
} //else
	
?>
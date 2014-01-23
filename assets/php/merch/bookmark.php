<?php
$userID = $_SESSION['id'];
$postID = $_GET['postid'];

$query = "SELECT * FROM Bookmarks_Users_Posts WHERE User_FK = '$userID' AND Post_FK = '$postID'";
$result = mysqli_query($con, $query);

if($result && mysqli_num_rows($result) > 0) //deleting the row
{
	$query = "DELETE FROM Bookmarks_Users_Posts WHERE User_FK = '$userID' AND Post_FK = '$postID'";
	mysqli_query($con, $query);
	echo "Unbookmark";
} //if
else
{
	$query = "INSERT INTO Bookmarks_Users_Posts (User_FK,Post_FK)
	VALUES ('$userID','$postID')";
	mysqli_query($con, $query);
	echo "Bookmark";
} //else
?>
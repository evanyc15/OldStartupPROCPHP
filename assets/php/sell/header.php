<?php
$postID = $_GET['pid'];
$userID = $_SESSION['id'];

$query = "SELECT NewUser FROM Users WHERE User_PK = '$userID'";
$result = mysqli_query($con, $query);
if($row = mysqli_fetch_array($result))
{
	$new_user = $row['NewUser'];
} //if
else
{
	echo "query fail!";
}
?>
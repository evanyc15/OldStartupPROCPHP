<?php 

$qExists = false;// Represents whether or not the user queried anything yet
$followersTabState = true;// Represents the state of the followers tab

if(isset($_GET['q']) && $_GET['q'] != '' )
{
	$qExists = true;
}
if(isset($_GET['tab']))
{
	if ($_GET['tab'] == "following")
	{
		$followersTabState = false;
	} //if
} //if

$sessionUser_id = $_SESSION['id'];

$showMine = false;
$showYours = true;

if (isset($_GET["user"]))
{
	$user_id_F = $_GET["user"];
} //if
else
{
	$user_id_F = $sessionUser_id;
} //else

if($user_id_F == $sessionUser_id)
{
	$showMine = true;
	$showYours = false;
} //if


$query_current_user = "SELECT FirstName FROM Users WHERE User_PK = '$user_id_F'";
$result = mysqli_query($con, $query_current_user);
if( $row = mysqli_fetch_array($result) )
{
	$currentName = $row['FirstName'];
}

// To find who is follower current user
$query_followers = "SELECT * FROM Users_Users WHERE User2_FK = '$user_id_F'";
$followers = mysqli_query($con,$query_followers);

// To find who current user is following
$query_following = "SELECT * FROM Users_Users WHERE User1_FK = '$user_id_F'";
$following = mysqli_query($con,$query_following);

?>
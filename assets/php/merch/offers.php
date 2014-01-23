<?php
$post_id = $_GET['postid'];

$query = "SELECT u.FirstName,u.LastName,u.User_PK,u.ProfilePicture FROM Offers AS o INNER JOIN Users AS u ON o.User_FK = u.User_PK WHERE o.Post_FK = '$post_id'";
$result = mysqli_query($con, $query);

if($result)
{
	$offersArray = array();
	while($offer = mysqli_fetch_array($result))
	{
		$offersArray[] = $offer;
	}
	echo json_encode($offersArray);
}
?>
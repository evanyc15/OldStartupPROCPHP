<?php

$user_id = $_SESSION['id'];

$user_interests_query = "SELECT t.Tag_ID,t.Tag,ut.Deleted FROM Tags AS t INNER JOIN Users_Tags AS ut ON ut.Tag_FK = t.Tag_ID WHERE ut.User_FK = '$user_id'";
$interests = mysqli_query($con,$user_interests_query);

if($interests)
{
	$interestsArray = array();
	while($tags = mysqli_fetch_array($interests))
	{
		$interestsArray[] = $tags;
	}
	echo json_encode($interestsArray);
}
?>
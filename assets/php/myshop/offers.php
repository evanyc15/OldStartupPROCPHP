<?php

$post_id = $_GET['postid'];
$userid = $_SESSION['id'];

$query = "SELECT u.FirstName,u.LastName,u.User_PK,u.ProfilePicture,o.Post_FK,o.Price,o.Message,o.Offer_PK ,o.Status
FROM Offers AS o 
INNER JOIN Users AS u ON o.User_FK = u.User_PK 
WHERE o.Post_FK = '$post_id[0]' AND o.Status != 'Rejected'";

for($i = 1; $i < count($post_id); $i++)
{
	$query .= " OR o.Post_FK = '$post_id[$i]' AND o.Status != 'Rejected'";
}
$query .= " ORDER BY o.Post_FK";

$result = mysqli_query($con, $query);
//var_dump($result);

if($result)
{
	$postsArray = array();
	$rowCount = 0;
	$offer = mysqli_fetch_array($result);
	$offersArray[0][] = $offer;
	$postNumber = $offer['Post_FK'];

	while($offer = mysqli_fetch_array($result))
	{
		if($offer['Post_FK'] != $postNumber)
		{
			++$rowCount;
			$postNumber = $offer['Post_FK'];
		}
		$offersArray[$rowCount][] = $offer;
	} //while
	echo json_encode($offersArray);
}

else
{
	header("Location: /error/");

}
?>
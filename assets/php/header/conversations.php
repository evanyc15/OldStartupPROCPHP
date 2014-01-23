<?php
$userID = $_SESSION['id'];

$conversationQuery = "SELECT Time.*,u.FirstName,u.LastName,u.ProfilePicture FROM (SELECT * FROM Messages_Users_Users ORDER BY DateTime DESC) AS Time INNER JOIN Users AS u ON Time.User1_FK = u.User_PK WHERE User2_FK = '$userID' GROUP BY User1_FK ORDER BY DateTime DESC";
$conversationResult = mysqli_query($con,$conversationQuery);

if($conversationResult)
{
	$conversationArray = array();
	while($person = mysqli_fetch_array($conversationResult))
	{
		$conversationArray[] = $person;
	}
	echo json_encode($conversationArray);
}
else
{
	echo "Error";
}
?>
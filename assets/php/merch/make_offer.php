<?php
$userID = $_SESSION['id']; //Person who is offering
$postID = $_GET['postID']; //Post ID that the offer is for
$userOffer = $_GET['offer']; //The offer that was made

$dollarExplode = explode('$',$userOffer);
$spaceExplode = explode(' ',$dollarExplode[1]);
$price = $spaceExplode[0];

//----------------------bookmark post when offered on-------------------BEGIN-------------------
$query = "SELECT COUNT(*) AS c FROM Bookmarks_Users_Posts WHERE User_FK = '$userID' AND Post_FK = '$postID'";
$result  = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

if($row['c'] == 0) //don't allow the post to be bookmarked more than once
{
	$query = "SELECT COUNT(*) AS c FROM Posts WHERE User_FK = '$userID' AND Post_PK = '$postID'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	if($row['c'] == 0) //don't allow a users OWN POST to be bookmarked
	{
		$query = "INSERT INTO Bookmarks_Users_Posts (User_FK, Post_FK) VALUES ('$userID', '$postID')";
		mysqli_query($con, $query);
	} //if
} //if
//----------------------bookmark post when offered on-------------------END-------------------

$makeOfferQuery = mysqli_query($con,"INSERT INTO Offers (User_FK,Post_FK,Price,Message) VALUES ('$userID','$postID','$price','$userOffer')");
if($makeOfferQuery)
{
	$offerCountQuery = "UPDATE Posts SET Offer_Count = Offer_Count + 1 WHERE Post_PK = '$postID'"; //Increment the offer count for the post
	mysqli_query($con, $offerCountQuery);
	
	$offerIDQuery = mysqli_query($con, "SELECT Offer_PK FROM Offers WHERE User_FK='$userID' AND Post_FK='$postID' ORDER BY DateTime DESC LIMIT 1");
	$row = mysqli_fetch_array($offerIDQuery);
	$offerID = $row['Offer_PK'];
	
	$userInfoQuery = mysqli_query($con,"SELECT u.FirstName,u.LastName,u.ProfilePicture,o.DateTime,p.Subject,p.User_FK 
									FROM Users AS u 
									INNER JOIN Offers AS o ON u.User_PK = o.User_FK 
									INNER JOIN Posts AS p ON p.Post_PK = o.Post_FK 
									WHERE o.Offer_PK = '$offerID'");
	//$userInfoQuery = mysqli_query($con,"SELECT FirstName,LastName,ProfilePicture FROM Users WHERE User_PK = '$userID'");
	if($userInfoQuery)
	{
		$userInfoRow = mysqli_fetch_array($userInfoQuery);
		
		$datetime = date('Y-m-d H:i:s',time());
		
		$temp_notif_data = array (
		'User_FK' => $userID,
		'Name' =>  $userInfoRow['FirstName']." ".$userInfoRow['LastName'],
		'Post_FK' => $postID,
		'DateTime' => $datetime,
		'Comment' => $userOffer
		);
		
		$notification_data = json_encode($temp_notif_data);
		$userfk = $userInfoRow['User_FK'];
		
		//Insert the data into the notifications table
		$notifications_sql = $con->query(
	    "INSERT INTO Notifications (User_FK,Notifications_Type,Notifications_Data,Last_Read) 
	    VALUES ('$userfk','Offer','$notification_data','0')");
		if (!$notifications_sql) {
	    	die('Invalid query: ' . mysqli_error());
		} 
		
		//Selecting from db to get the Notification_PK
		$query = "SELECT * FROM Notifications WHERE User_FK = '$userfk' AND Notifications_Data = '$notification_data'";
		$result = mysqli_query($con,$query);
		$row = mysqli_fetch_array($result);
		$NotificationPK = $row['Notifications_PK'];
		
		$userInfoArray = array(
			'Notifications_PK' => $NotificationPK,
			'Name' =>  $userInfoRow['FirstName']." ".$userInfoRow['LastName'],
			"ProfilePicture" => $userInfoRow['ProfilePicture'],
			"FromUser_FK" => $userID,
			"DateTime" => $datetime,
			"User_FK" => $userInfoRow['User_FK'],
			"Subject" => $userInfoRow['Subject']
			// need notifications pk
		);

		echo json_encode($userInfoArray);
	}
	else 
	{
		echo "QUERY FAILED $offerID";
	}
}
else
{
	echo "Failure";
}
?>
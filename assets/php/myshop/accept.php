<?php
$offerJSON = $_GET['offerAccept'];
$offerDecoded = json_decode($offerJSON);
$offererID = $offerDecoded->offererID; //The person who is offering(User_FK)
$offerID = $offerDecoded->offerID; //The ID of the offer the person is responding to
$postID = $offerDecoded->postID; //The post the person is responding to
$userID = $offerDecoded->userID; //The person who is accepting/rejecting(FromUser_FK)
$userName = $offerDecoded->Name; //The first and last name of the person accepting/rejecting
$offerPrice = $offerDecoded->Price; //The price at which the person accepted/rejected at
$offerStatus = $offerDecoded->Status;


$postAndUserQuery = "SELECT p.Subject,u.ProfilePicture FROM Posts AS p INNER JOIN Users AS u ON p.User_FK = u.User_PK WHERE p.Post_PK = '$postID'";
$postAndUserResult = mysqli_query($con,$postAndUserQuery);
$postAndUserRow = mysqli_fetch_array($postAndUserResult);
$subject = $postAndUserRow['Subject'];

$updateAllStatusQuery = mysqli_query($con,"UPDATE Offers SET Status = 'None' WHERE Status != 'Rejected' AND Post_FK = '$postID'");
if($updateAllStatusQuery)
{
	$updatePickedQuery = mysqli_query($con,"UPDATE Offers SET Status = 'Accepted' WHERE Offer_PK = '$offerID'");
	if($updatePickedQuery)
	{
		$notificationJSON = array(
			'User_FK' => $userID,
			'Name' => $userName,
			'Post_FK' => $postID,
			'Subject' => $subject,
			'Price' => $offerPrice,
			'Status' => $offerStatus);

		$notificationData = mysqli_escape_string($con,json_encode($notificationJSON));
	
		$notificationQuery = "INSERT INTO Notifications (User_FK,Notifications_Type,Notifications_Data,Last_Read) VALUES ('$offererID','OfferResponse','$notificationData','0')";
		$notificationResult = mysqli_query($con,$notificationQuery);
		if($notificationResult)
		{
			$firebaseQuery = "SELECT * FROM Notifications WHERE User_FK = '$offererID' AND Notifications_Data = '$notificationData'";
			$firebase = mysqli_query($con,$firebaseQuery);
			$firebaseRow = mysqli_fetch_array($firebase);

			$firebaseInfo = array(
				'Notifications_PK' => $firebaseRow['Notifications_PK'],
				'User_FK' => $offererID,
				'fromUser_FK' => $userID,
				'fromName' => $userName,
				'Post_FK' => $postID,
				'Post_Subject' => $subject,
				'OfferPrice' => $offerPrice,
				'Status' => $offerStatus,
				'DateTime' => $firebaseRow['Timestamp'],
				'ProfilePicture' => $postAndUserRow['ProfilePicture']
			);

			$firebaseJSON = json_encode($firebaseInfo);

			echo $firebaseJSON;
		}
	}
}
else
{
	echo 'Failure';
}
?>
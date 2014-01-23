<?php
$offerJSON = $_GET['offerInfo'];
$offerDecoded = json_decode($offerJSON);
$offererID = $offerDecoded->offererID; //The person who is offering(User_FK)
$offerID = $offerDecoded->offerID; //The ID of the offer the person is responding to
$postID = $offerDecoded->postID; //The post the person is responding to
$userID = $offerDecoded->userID; //The person who is accepting/rejecting(FromUser_FK)
$userName = $offerDecoded->Name; //The first and last name of the person accepting/rejecting
$offerPrice = $offerDecoded->Price; //The price at which the person accepted/rejected at
$offerStatus = $offerDecoded->Status; //Accepted/Rejected

//Gets the subject of post that the offer was offered on and also gets the the profile picture of the person that owns the post to show in the notifications
$postAndUserQuery = "SELECT p.Subject,u.ProfilePicture FROM Posts AS p INNER JOIN Users AS u ON p.User_FK = u.User_PK WHERE p.Post_PK = '$postID'";
$postAndUserResult = mysqli_query($con,$postAndUserQuery);
$postAndUserRow = mysqli_fetch_array($postAndUserResult);
$subject = $postAndUserRow['Subject'];

//If they accept the offer, we want to reset all offers to 'None', except for the rejected ones 
if($offerStatus == 'accepted')
	$updateAllStatusQuery = mysqli_query($con,"UPDATE Offers SET Status = 'None' WHERE Status != 'Rejected' AND Post_FK = '$postID'");
else 
	$updateAllStatusQuery = true; //If they reject the offer then we don't want to do anything because we're just going to set it to 'Rejected'

if($updateAllStatusQuery)
{
	//Since accepting and rejecting an offer is really the same process except you send different statuses, this file handles both cases depending on whether offerStatus is accepted or rejected
	//We set the current offer to accepted if the person presses Accept or rejected if the person presses the Reject
	if($offerStatus == 'accepted')
		$updatePickedQuery = mysqli_query($con,"UPDATE Offers SET Status = 'Accepted' WHERE Offer_PK = '$offerID'");
	else
		$updatePickedQuery = mysqli_query($con,"UPDATE Offers SET Status = 'Rejected' WHERE Offer_PK = '$offerID'");
	
	if($updatePickedQuery)
	{
		$notificationJSON = array(
				'User_FK' => $userID,
				'Name' => $userName,
				'Post_FK' => $postID,
				'Subject' => $subject,
				'Price' => $offerPrice,
				'Status' => $offerStatus);

		$notificationData = mysqli_escape_string($con,json_encode($notificationJSON)); //Incase their offer has quotes or special characters that would break the query

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
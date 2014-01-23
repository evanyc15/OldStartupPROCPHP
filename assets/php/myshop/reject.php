<?php

$offerID = $_GET['offer_id'];

$rejectOfferQuery = mysqli_query($con,"UPDATE Offers SET Status = 'Rejected' WHERE Offer_PK = '$offerID'");
if($rejectOfferQuery)
{
	echo 'Success';
}
else 
{
	header("Location: /error/");
	
}
?>
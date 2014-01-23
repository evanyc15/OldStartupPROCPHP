<?php

$interestsArray = $_GET['json'];

$userID = $_SESSION['id'];
$interestID = $interestsArray['id'];

$remove_query = "UPDATE Users_Tags SET Deleted=1 WHERE User_FK = '$userID' AND Tag_FK = '$interestID'";
$remove = mysqli_query($con,$remove_query);

if($remove)
	echo "Success";
else
	echo "Failure";

?>
<?php
require('../../assets/php/globalref/sqlconf.php');
function updateTutorials($tutorialName, $user_id_Tut, $con)
{
	$query = "UPDATE Tutorials SET $tutorialName = '0' WHERE User_FK = '$user_id_Tut'";
	mysqli_query($con, $query);
} //function

function tutorialCounter($user_id_Tut, $tutorialCount, $con)
{
	$query = "UPDATE Tutorials SET TutorialCount = TutorialCount + 1 WHERE User_FK = '$user_id_Tut'";
	mysqli_query($con, $query);
	$tutorialCount += 1;
} //function

function updateNewUser($user_id_Tut, $con)
{
	$query = "UPDATE Users SET NewUser = 0 WHERE User_PK = '$user_id_Tut'";
	mysqli_query($con, $query);
} //function

$user_id_Tut = $_SESSION['id'];

$rowTutorial;
$interestsTutorial;
$sellTutorial;
$browseTutorial;
$merchTutorial;
$myshopTutorial;
$tutorialCount;

$queryTut = "SELECT * FROM Tutorials WHERE User_FK = '$user_id_Tut'";
$resultTut = mysqli_query($con, $queryTut);

if($rowTutorial = mysqli_fetch_array($resultTut))
{
	$interestsTutorial = mysqli_real_escape_string($con,$rowTutorial['InterestsTutorial']);
	$sellTutorial = mysqli_real_escape_string($con,$rowTutorial['SellTutorial']);
	$browseTutorial = mysqli_real_escape_string($con,$rowTutorial['BrowseTutorial']);
	$merchTutorial = mysqli_real_escape_string($con,$rowTutorial['MerchTutorial']);
	$myshopTutorial = mysqli_real_escape_string($con,$rowTutorial['MyshopTutorial']);
	$tutorialCount = mysqli_real_escape_string($con,$rowTutorial['TutorialCount']);
} //if

$ifNewUser;

if($interestsTutorial == 1)
{
	$query = "SELECT NewUser FROM Users WHERE User_PK = '$user_id_Tut'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	$ifNewUser = mysqli_real_escape_string($con,$row['NewUser']);

	if($ifNewUser == 1 && $interestsTutorial == 1)
	{
		$query = "INSERT INTO Users_Tags (User_FK,Tag_FK) VALUES ('$user_id_Tut', '1')";
		mysqli_query($con, $query);
	
		$query = "INSERT INTO Users_Tags (User_FK,Tag_FK) VALUES ('$user_id_Tut', '2')";
		mysqli_query($con, $query);
	}//if
} //if

?>
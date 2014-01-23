<?php

$user_id = $_SESSION['id']; //this is the id of the user
$jsonArray = $_GET['json'];
$interestsArray = json_decode($jsonArray,true); //Array of tags that the user input


if(!empty($interestsArray))
{
	$interestQuery = "";
	$insertionCheck = false;
	for($i = 0;$i < count($interestsArray);$i++)
	{
		$tagID = $interestsArray[$i]['id'];
		$duplicateCheck = mysqli_query($con,"SELECT * FROM Users_Tags WHERE User_FK = '$user_id' AND Tag_FK = '$tagID'");
		if($duplicateCheck)
		{
			if(mysqli_num_rows($duplicateCheck) == 0) //Not duplicate, add it 
			{
				$interestQuery = "INSERT INTO Users_Tags (User_FK,Tag_FK,Weight,Deleted) VALUES ('$user_id','$tagID',0,0)";
				$interestInsert = mysqli_query($con,$interestQuery);
				if($interestInsert)
					$insertionCheck = true;
				else
					$insertionCheck = false;
			}
			else //They previously added this option as an interest, so just make Deleted 0 again
			{
				$updateQuery = "UPDATE Users_Tags SET Deleted = 0 WHERE User_FK = '$user_id' AND Tag_FK = '$tagID'";
				$update = mysqli_query($con,$updateQuery);
				if($update)
				{
					$insertionCheck = true;
				}
				else
				{
					$insertionCheck = false;
				}
			}
		}
		
	}
	if($insertionCheck)
		echo "Success";
} 
//if
//header("Location: /interests/");
?>
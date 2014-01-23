<?php 
	$sessionUser_id = mysqli_real_escape_string($con,$_SESSION['id']);
	
	$user_id_P;// Id of user
	$firstName_P;// First name of user
	$lastName_P;// Last name of user
	$about_P;// About information of user
	$profilePicture_P;// Profile picture of user
	$city_P;// City of user
	$state_P;// State of user
	
	$showEdit = false;
	$showFollow = true;
	
	if (isset($_GET["user"]))
	{
		$user_id_P = mysqli_real_escape_string($con,$_GET["user"]);
		if($user_id_P != $sessionUser_id)
		{//if user is not viewing own profile than add popularity of different profile
			
			$query_popularity = "UPDATE Users SET Popularity = Popularity + 1 WHERE User_PK = '$user_id_P'";
			$result = mysqli_query($con, $query_popularity);	
		} //if
	}
	else
	{
		$user_id_P = $sessionUser_id;
	}
	
	if($user_id_P == $sessionUser_id)
	{
		$showEdit = true;
		$showFollow = false;
	}
	
	$query = "SELECT * FROM Users WHERE User_PK = '$user_id_P'";
	if($result = mysqli_query($con,$query))
	{
		$row = mysqli_fetch_array($result);
		$firstName_P =mysqli_real_escape_string($con, $row['FirstName']);
		$lastName_P = mysqli_real_escape_string($con,$row['LastName']);
		$about_P = mysqli_real_escape_string($con,$row['About']);
		$profilePicture_P = mysqli_real_escape_string($con,$row['ProfilePicture']);
		$city_P = mysqli_real_escape_string($con,$row['City']);
		$state_P = mysqli_real_escape_string($con,$row['State']);
	}

	// To find who is following current user
	$query_followers = "SELECT * FROM Users_Users WHERE User2_FK = '$user_id_P'";
	$followers = mysqli_query($con,$query_followers);
	
	// To find who current user is following
	$query_following = "SELECT * FROM Users_Users WHERE User1_FK = '$sessionUser_id'";
	$following = mysqli_query($con,$query_following);

	if($showFollow)
	{
		$query_check_follow = "SELECT * FROM Users_Users WHERE User1_FK = '$sessionUser_id' AND User2_FK = '$user_id_P'";
		$check_follow = mysqli_query($con,$query_check_follow);
		if($check_follow) //Check if the user is following the profile user
		{
			if(mysqli_num_rows($check_follow) > 0) //The session user is following the profile user
			{
				$currentuser = $_SESSION['id'];
				$query_weight = "UPDATE Users_Users SET Weight = Weight + 1 WHERE User1_FK = '$currentuser' AND User2_FK = '$user_id_P'";
				$result = mysqli_query($con, $query_weight);//The relationship weight increments between two users.
				$followText = "Unfollow";
			} //if
			else //The session user is not following the profile user
			{
				$followText = "Follow";
			} //else
		} //if
	} //if
?>
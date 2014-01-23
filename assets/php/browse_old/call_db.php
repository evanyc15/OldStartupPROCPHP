<?php
	
	//Variables to determine which data range should be retrieved
	$current = $_GET['current'];
	$increment = $_GET['increment'];	
		
	//INNER JOIN Posts, Users, Posts_IMG
	$sql = "SELECT p.Subject, p.City, p.State, p.Post_PK, p.User_FK, p.Sold,
			u.FirstName, u.LastName, u.ProfilePicture,
			pi.Source
			FROM Posts
			AS p
			INNER JOIN Users
			AS u
			ON p.User_FK = u.User_PK
			INNER JOIN Posts_IMG
			AS pi
			ON p.Post_PK = pi.Post_FK
			GROUP BY pi.Post_FK
			LIMIT $current,$increment";
		
	/*SQL Query to get all Posts*/
	//$sql = "SELECT * FROM Posts";
	
	$result = mysqli_query($con,$sql);
	
	/*Start initializing the array to get the images*/
	$img_row = array();
		$i = 0;
		while($row = mysqli_fetch_array($result))
		{
			$subject = $row['Subject'];	
			$location = $row['City'].", ".$row['State'];
			$post_fk =  $row['Post_PK'];
			$userfk = $row['User_FK'];
			
			/*$user_query = "SELECT * FROM Users WHERE User_PK = '$userfk'";
			$user_result = mysqli_query($con,$user_query);
			$row = mysqli_fetch_array($user_result);*/
			$name = $row['FirstName']." ".$row['LastName'];
			$profilepic = $row['ProfilePicture'];
			
			//$img_query = "SELECT * FROM Posts_IMG WHERE Post_FK = '$post_fk'";
			//$img_result = mysqli_query($con,$img_query);
			
			//$row = mysqli_fetch_array($img_result);
			$img_row[$i] = array(
				'Post_FK' => $post_fk,
				'Source' => $row['Source'],
				'Subject' => $subject,
				'Loc' => $location,
				'Name' => $name,
				'ProfilePic' => $profilepic,
				'Sold' => $row['Sold']
			);
			$i++;
		}
	
	/*return to ajax as json*/
	echo json_encode($img_row);
	mysqli_close($con);
?>
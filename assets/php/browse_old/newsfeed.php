<?php
	
	//Variables to determine which data range should be retrieved
	$current = $_GET['current'];
	$increment = $_GET['increment'];
	$user_id = $_SESSION['id'];
	
	
	$sql = "SELECT Table1.Post_PK,Table1.Source,Table1.User_FK,
		Table1.ProfilePicture, Table1.Subject, Table1.FirstName,
		Table1.LastName,Table1.City, Table1.State, Table1.DateTime,
		Table1.Sold
		FROM ((SELECT p.Post_PK AS Post_PK, 
		p.Sold AS Sold,
		pi.Source AS Source, 
		u_p.User_PK AS User_FK, 
		u_p.ProfilePicture AS ProfilePicture, 
		u_p.FirstName AS FirstName, 
		u_p.LastName AS LastName, 
		u_p.City AS City,
		u_p.State AS State,
		p.Subject AS Subject,
		p.DateTime AS DateTime 
		FROM Tags AS t 
		INNER JOIN Users_Tags AS ut 
		ON t.Tag_ID = ut.Tag_FK 
		INNER JOIN Posts_Tags AS pt 
		ON pt.Tag_FK = t.Tag_ID 
		INNER JOIN Posts AS p 
		ON pt.Post_FK = p.Post_PK 
		INNER JOIN Posts_IMG AS pi 
		ON pi.Post_FK = p.Post_PK 
		INNER JOIN Users 
		AS u on ut.User_FK = u.User_PK 
		INNER JOIN Users AS u_p 
		ON p.User_FK = u_p.User_PK 
		WHERE u.User_PK = '$user_id' ORDER BY ut.Weight) 
		UNION 
		(SELECT p.Post_PK AS Post_PK,
		p.Sold AS Sold,
		pi.Source AS Source, 
		u.User_PK AS User_FK, 
		u.ProfilePicture AS ProfilePicture, 
		u.FirstName AS FirstName, 
		u.LastName AS LastName, 
		u.City AS City,
		u.State AS State,
		p.Subject AS Subject,
		p.DateTime AS DateTime 
		FROM Users_Users AS uu 
		INNER JOIN Users AS u 
		ON uu.User2_FK = u.User_PK 
		INNER JOIN Posts 
		AS p 
		ON p.User_FK = u.User_PK 
		INNER JOIN Posts_IMG 
		AS pi ON pi.Post_FK = p.Post_PK 
		WHERE uu.User1_FK = '$user_id'
		ORDER BY p.Popularity)) 
		AS Table1 
		GROUP BY Table1.Post_PK
		ORDER BY Table1.DateTime
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
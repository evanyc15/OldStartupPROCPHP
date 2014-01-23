<?php 
	
	$sessionUser_ID = $_SESSION['id'];
	$profileID = $_GET['userid'];

	//Check first to see if the follow already exists or not
	//If it does then unfollow, if not, then follow
	$check_follow_query = mysqli_query($con,"SELECT * FROM Users_Users WHERE User1_FK = '$sessionUser_ID' AND User2_FK = '$profileID'");
	if($check_follow_query)
	{
		if(mysqli_num_rows($check_follow_query) > 0) //Rows were returned(they are following the person), then we must unfollow them
		{
			//Getting respective Notifcation PK
			$query = "SELECT * FROM  Users_Users WHERE User1_FK = '$sessionUser_ID' AND User2_FK = '$profileID'";
			$result = mysqli_query($con,$query);
			$row = mysqli_fetch_array($result);
			$notification_pk = $row['Notification_FK'];
			
			//Getting respective Firebase Location
			$query = "SELECT * FROM Notifications WHERE Notifications_PK = '$notification_pk'";
			$result = mysqli_query($con,$query);
			$row = mysqli_fetch_array($result);
			$fireloc = $row['FireLoc'];
			
			//Delete the respective Notifications and Following data
			$query = "DELETE FROM Notifications WHERE Notifications_PK = '$notification_pk'";
			$result = mysqli_query($con, $query);
			
			$query = mysqli_query($con,"DELETE FROM Users_Users WHERE User1_FK = '$sessionUser_ID' AND User2_FK = '$profileID'");
			if($query)
			{
				
				$temp_array = array(
					'User_FK' => $profileID,
					'FireLoc' => $fireloc,
					'Status' => "Unfollow"
				);
				echo json_encode($temp_array);
			}
			
			else
			{
				header("Location: /error/");
			
			}
			
		}
		else //No rows were returned(they are not following the person), then we must follow them
		{
			//Getting the fromName and fromUser's profile picure
			$query = "SELECT * FROM Users WHERE User_PK = '$sessionUser_ID'";
			$result = mysqli_query($con, $query);
			$row = mysqli_fetch_array($result);
			$img_url = $row['ProfilePicture'];
			$name = $row['FirstName']." ".$row['LastName'];
			
			//Create the follow row (insert data)
			$add_following_query = mysqli_query($con,"INSERT INTO Users_Users (User1_FK,User2_FK) VALUES ('$sessionUser_ID','$profileID')");
			if($add_following_query){
				
				//Getting the respective datetime at the time of following
				$query = "SELECT * FROM Users_Users WHERE User1_FK = '$sessionUser_ID' AND User2_FK = '$profileID'";
				$result = mysqli_query($con, $query);
				$row = mysqli_fetch_array($result);
				$datetime = $row['DateTime'];
				
				$tempData = array(
					'User_FK' => $sessionUser_ID,
					'Name' => $name,
					'DateTime' => $datetime
				);
				
				//Creating json object with the array
				$notification_data = json_encode($tempData);
				
				//Insert the new data into the notifications table
				$query = "INSERT INTO Notifications
				VALUES (DEFAULT,'$profileID','Follow','$notification_data',DEFAULT,'0',DEFAULT)";
				$result = mysqli_query($con,$query); 
				
				//Getting the respective Notification PK
				$query = "SELECT * FROM Notifications WHERE User_FK = '$profileID' AND Notifications_Type = 'Follow' 
				AND Notifications_Data = '$notification_data'";
				$result = mysqli_query($con,$query);
				$row = mysqli_fetch_array($result);
				$NotificationPK = $row['Notifications_PK'];
				
				//Update the Following table to add respective Notification PK
				$query = "UPDATE Users_Users SET Notification_FK='$NotificationPK'
				WHERE User1_FK = '$sessionUser_ID' AND User2_FK = '$profileID'";
				$result = mysqli_query($con,$query);
				
				//Create associative array to be used with json_encode
				$jsonArray = array(
					'User_FK' => $profileID,
					'fromUserFK' => $sessionUser_ID,
					'fromName' => $name,
					'DateTime' => $datetime,
					'ProfilePic' => $img_url,
					'Notifications_PK' => $NotificationPK,
					'Status' => "Follow"
				);
		
				//Encode as json object with the array and echo
				echo json_encode($jsonArray);
			}

			else
			{
				header("Location: /error/");
			
			}
		}
	}
?>
<?php
	$fromuser = $_SESSION['id']; //User's ID
	$touser = $_GET['touser']; //Person they're talking to
	
	/*$fromsql = "SELECT m.DateTime, m.Message, u.FirstName,u.LastName,u.ProfilePicture
				FROM Messages_Users_Users
				AS m
			 	INNER JOIN Users
			 	AS u
			 	ON m.User1_FK = u.User_PK
				WHERE m.User1_FK = '$fromuser'";
				
	$tosql = "SELECT m.DateTime, m.Message, u.FirstName,u.LastName,u.ProfilePicture
			  FROM Messages_Users_Users
		      AS m
		 	  INNER JOIN Users
		 	  AS u
		 	  ON m.User2_FK = u.User_PK
			  WHERE m.User2_FK = '$touser'";
			  */
			  
			//fm is what you are messaging to the others (current session)
			//tm is what they message back  
			
	/*$sql = "SELECT fm.DateTime fDateTime, fm.Message fMessage, fru.User_PK fUser_PK, fru.FirstName fFirstName,fru.LastName fLastName,fru.ProfilePicture fProfilePicture,
				   tm.DateTime tDateTime, tm.Message tMessage, tou.User_PK tUser_PK, tou.FirstName tFirstName, tou.LastName tLastName, tou.ProfilePicture tProfilePicture
			FROM Messages_Users_Users
			AS fm
		 	INNER JOIN Users
		 	AS fru
		 	ON fm.User1_FK = fru.User_PK 
			INNER JOIN Messages_Users_Users
			AS tm
			ON tm.User1_FK = fm.User2_FK
			INNER JOIN Users
			AS tou
			ON tm.User1_FK = tou.User_PK
			WHERE tm.User1_FK = '$touser' AND fm.User1_FK = '$fromuser'
			ORDER BY fm.DateTime DESC, tm.DateTime DESC";*/
			
	/*$sql = "SELECT DATE_FORMAT(m.DateTime,'%b %d %Y %h:%i %p') AS DateTime, m.Message, u.User_PK, u.FirstName, u.LastName, u.ProfilePicture
			FROM Messages_Users_Users
			AS m
		 	INNER JOIN Users
		 	AS u
		 	ON m.User1_FK = u.User_PK
			WHERE (m.User1_FK = '$touser' AND m.User2_FK = '$fromuser') OR (m.User1_FK = '$fromuser' AND m.User2_FK = '$touser')
			ORDER BY DateTime ASC";*/
	$sql = "SELECT DATE_FORMAT(muu.DateTime,'%b %d %Y %h:%i %p') AS ActualTime,muu.User1_FK,muu.User2_FK,muu.DateTime,muu.Message,muu.FireLoc,u.User_PK,u.FirstName,u.LastName,u.ProfilePicture 
			FROM Messages_Users_Users AS muu 
			INNER JOIN Users AS u ON u.User_PK = muu.User1_FK 
			WHERE (User1_FK = '$fromuser' OR User1_FK = '$touser') AND (User2_FK = '$touser' OR User2_FK = '$fromuser') 
			ORDER BY muu.DateTime ASC";
	$result = mysqli_query($con,$sql);
	
	$messagerow = array();
	$i = 0;
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result))
		{			
			$messagerow[$i] = $row;
			
			if($row['User_PK'] == $fromuser){
				$messagerow[$i]['Type'] = 'From';
			}
			else if($row['User_PK'] == $touser){
				$messagerow[$i]['Type'] = 'To';
			}
			$messagerow[$i]['Fill'] = true;	
			$i++;
		}
	}
	else if(mysqli_num_rows($result) == 0){
		$sql = "SELECT * FROM Users WHERE User_PK = '$fromuser'";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
		
		$name = $row['FirstName']." ".$row['LastName'];
		$profilepic = $row['ProfilePicture'];
		$messagerow[0] = array(
			'FirstName'=>$row['FirstName'],
			'LastName' => $row['LastName'],
			'ProfilePicture' => $profilepic,
			'Fill' => false
		);
	}
		
	echo json_encode($messagerow);
	mysqli_close($con);	
?>
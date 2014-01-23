<?php
	if(isset($_GET['searchdata']))
	{
		// Parse by space into array
		$parsedName = explode(" ", $_GET['searchdata']);
		$searcharray = array();
		$sessionID = $_SESSION['id'];
		if(count($parsedName) > 1)
		{
			$query = "SELECT User_PK,FirstName,LastName,ProfilePicture FROM Users WHERE FirstName = '" . $parsedName[0] . "' AND LastName LIKE CONCAT({'$parsedName[1]'},'%')";
		}
		else if(count($parsedName) == 1)
		{
			$query = "SELECT User_PK,FirstName,LastName,ProfilePicture FROM Users WHERE FirstName LIKE CONCAT($parsedName[0],'%') OR LastName LIKE CONCAT($parsedName[0],'%')";
		}

		$result = mysqli_query($con,$query);
		
		if($result)
		{
			while($row = mysqli_fetch_array($result))
			{
				if($row['User_PK'] != $sessionID)		
				{
					$searcharray[] = $row;
				}
			}
			echo json_encode($searcharray);
			mysqli_close($con);
		}			
	}
?>


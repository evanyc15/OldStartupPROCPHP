<?php
//dont do sql escape comands!!!!
	if(isset($_GET['searchdata']))
	{
		// Parse by space into array
		$parsedName = explode(" ", $_GET['searchdata']);
		$searcharray = array();
		if(count($parsedName) > 1)
		{
			$query = "SELECT * FROM Users WHERE FirstName = '" . $parsedName[0] . "' AND LastName LIKE CONCAT({'$parsedName[1]'},'%')";
		}
		else if(count($parsedName) == 1)
		{
			$query = "SELECT * FROM Users WHERE FirstName LIKE CONCAT($parsedName[0],'%') OR LastName LIKE CONCAT($parsedName[0],'%')";
		}

		$result = mysqli_query($con,$query);
		
		$i = 0;
		if($result)
		{
			while($row = mysqli_fetch_array($result))
			{			
				$searcharray[$i] = $row;//dont touch this line, NO real escape comands
				$i++;
			}
			echo json_encode($searcharray);
			mysqli_close($con);
		}
		else
		{
			header("Location: /error/");
		
		}			
	}
?>


<?php 

$id;

if (isset($_GET["user"]))
{
	$id = $_GET["user"];
}
else
{
	$id = $_SESSION['id'];
}

$query = "SELECT * FROM Users WHERE User_PK = '$id'";
if($result = mysqli_query($con,$query))
{
	$row = mysqli_fetch_row($result);

	// If true then that means to hide the edit buttons, meaning
	// visiting page that isn't the logged in user's
	if ($id == $_SESSION['id'])
	{
		$row[2] = false;
		$row[1] = true;		
	}
	else 
	{
		$row[2] = true;
		
		// Check to see if logged in user can follow current page owner
		$loggedInUser = $_SESSION['id'];
		$query_following = "SELECT * FROM Users_Users WHERE User1_FK = '$loggedInUser' AND User2_FK = '$id'";
		if($result_following = mysqli_query($con,$query_following))
		{
			if (mysqli_num_rows($result_following) > 0)
			{
				$row[1] = true;
			}
			else
			{
				$row[1] = false;
			}
		}
	}

	
	echo json_encode($row);
}

else 
{
	header("Location: /error/");
	
}

?>
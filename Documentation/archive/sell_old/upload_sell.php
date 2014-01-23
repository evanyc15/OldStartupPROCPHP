<?php
include('../globalref/php/sqlconf.php');

session_start();

$user_id = $_SESSION['id']; //this is the id of the user
$city;// City of user
$state;// State of user
$subject; // Title of the post
$description; // Description of the post
$price = 0; // Price of the item

if(empty($_POST['address']))
{
	echo "If address statement";
	$query = "SELECT City,State FROM Users WHERE User_PK = '$user_id'";
	if($result = mysqli_query($con,$query))
	{
			$row = mysqli_fetch_array($result);
			$city = $row['City'];
			$state = $row['State'];
	} //if
} //if
else
{
	echo "Else address statement<br/>";
	echo $_POST['address'];
	$location = explode(', ',$_POST['address']);
	$city = $location[0];
	$state = $location[1];
} //else

if(!empty($_POST['subject']))
{
	$subject = mysqli_real_escape_string($con,$_POST['subject']);
} //if
else
{
	$subject = NULL;
	echo "You didn't type in a subject!<br/>";
} //else

$count = substr_count($subject, '$');

if($count == 1) //this means that there is only one dollar sign in the subject/title
{
	$arr = explode('$', $subject);
	$arr2 = explode(' ', $arr[1]);
	$price = $arr2[0];
} //if
else 
{
	echo "you put too many dollar signs!";
} //else

if(!empty($_POST['description']))
{
	$description = mysqli_real_escape_string($con,$_POST['description']);
} //if
else
{
	$description = NULL;
	echo "You didn't type in a description!<br/>";
} //else

$num_files = 0;// Represents number of files
$num_sizes = count($_FILES['file']['size']);
$success = true;
$file_path_array = array();// Represents the array of paths to each uploaded file

for($i=0;$i < $num_sizes;++$i)
{
	if($_FILES['file']['size'][$i] > 0)
	{
		++$num_files;
	}
}
$allowedExts = array(".gif", ".jpeg", ".jpg", ".png");
for($i = 0;$i < $num_files;$i++)
{
	if (isset($_FILES["file"]["name"][$i]))
	{
		$image_type_num = exif_imagetype($_FILES["file"]["tmp_name"][$i]);
		$extension = image_type_to_extension($image_type_num);

		if(($_FILES["file"]["size"][$i] < 5000000) && in_array($extension, $allowedExts))
	  	{
	  		
	  		if ($_FILES["file"]["error"][$i] > 0) //If there are any errors with the file or invalid file
	    	{
	    		$success = false;
	    		echo "Return Code: " . $_FILES["file"]["error"][$i] . "<br>";
	    	}
	  		else //Prints out the info of the file
	    	{
	    		/*echo "Upload: " . $_FILES["file"]["name"][$i] . "<br>";
	    		echo "Type: " . $_FILES["file"]["type"][$i] . "<br>";
	    		echo "Size: " . ($_FILES["file"]["size"][$i] / 1024) . " kB<br>";
	    		echo "Temp file: " . $_FILES["file"]["tmp_name"][$i] . "<br>";
	    		*/		
				$config = '../images/config.txt';
				$handle = fopen($config, 'r');
				$data = fread($handle,filesize($config)); //Opens up the config file and gets the directory number line
				fclose($handle);
				$directory_line = explode(" ",$data); //Parses through the line and gets the directory number
				$directory_number = end($directory_line);
						
				$file_increment = 0;
				$uploaded = false;
				$file_name = "";
				$file_complete_path = "";
				
				switch($image_type_num)
				{
					case IMAGETYPE_GIF:
						$imageTemp = imagecreatefromgif($_FILES["file"]["tmp_name"][$i]);
						break;
					case IMAGETYPE_JPEG:
						$imageTemp = imagecreatefromjpeg($_FILES["file"]["tmp_name"][$i]);
						break;
					case IMAGETYPE_PNG:
						$imageTemp = imagecreatefrompng($_FILES["file"]["tmp_name"][$i]);
						break;
				}
				
				while(!$uploaded)
				{			
	    			if (file_exists("../images/" . $directory_number . "/" . $file_name . "_" . $file_increment . '.jpg'))
	      			{
	      				//echo "Inside file_exists";
	      				++$file_increment;
	      		
						if($file_increment == 4)
						{
							mkdir("../images/" . ($directory_number + 1),777);
							file_put_contents($config,"current_directory : " . ($directory_number+1));
							++$directory_number;
							$file_increment = 0;
						}
	      				
	      			}
	    			else
	      			{
	      				$success = imagejpeg($imageTemp,'../images/' . $directory_number . '/' . $file_name . '_' . $file_increment . ".jpg",100);
	      				if($success)
	      					$file_path_array[$i] = '/images/' . $directory_number . '/' . $file_name . '_' . $file_increment . ".jpg";
	      				imagedestroy($imageTemp);
	      				$uploaded = true;
					}
				}
			}
		}
	}
	else
	{
		echo "<br/>";
		echo "Else block";
	  	echo "Invalid file";
	}
}

// Check if files were uploaded
if(count($file_path_array) == $num_files)
{
	$filepath = true;
}
else 
{
	$filepath = false;
	echo "You forgot to upload an image!<br/>";
}

if($subject && $price && $description && $city && $state && $filepath)
{
	// Push to server
	$query = "INSERT INTO Posts (User_FK,Subject,CurrentPrice,Description,City,State)
	VALUES ('$user_id','$subject','$price','$description','$city','$state')";
	mysqli_query($con, $query);
	
	$query = "SELECT Post_PK FROM Posts WHERE User_FK = '$user_id' ORDER BY Post_PK DESC LIMIT 1";
	
	if($result = mysqli_query($con,$query))
	{
		$row = mysqli_fetch_array($result);
		$pid = $row['Post_PK'];
	} //if
	echo $num_files;
	echo '<br/>';
	// Push filepaths to Posts_IMG
	for($i = 0;$i < $num_files;$i++)
	{
		$posts_img_query = $con->query("INSERT INTO Posts_IMG (Source,Post_FK) VALUES ('$file_path_array[$i]','$pid')");
		echo $file_path_array[$i];
		if (!$posts_img_query)
		{
			echo "Could not create relation!<br/>";
		}
		else
		{
			echo "Post created!<br/>";
		}
	}

	//Create tags for post
	$description = 'Justin' . $description;
		
	$hash_array = explode('#',$description);
		
	$tags = array();
	for($counter = 1;$counter < count($hash_array);$counter++)
	{
		$space_array = explode(' ',$hash_array[$counter]);
		$tags[] = $space_array[0];
	}	

	echo "Post ID = $pid<br/>";
	for($i = 0;$i < count($tags);$i++)
	{
		$tag_query = mysqli_query($con,"SELECT * FROM Tags WHERE Tag = '$tags[$i]'"); //Check if the tag is already in the Tags table
		if(mysqli_num_rows($tag_query) > 0) //Tag is already in database, don't re-add
		{
			$tag_row = mysqli_fetch_array($tag_query);
			$tag_id = $tag_row['Tag_ID']; //We get the Tag_ID of the tag thats already in the table
			$post_tag_query = mysqli_query($con,"INSERT INTO Posts_Tags (Post_FK,Tag_FK) VALUES ('$pid','$tag_id')"); //Insert a new row into Posts_Tags to link the post and the tag
		}
		else //Tag is not present, add it into the database
		{
			$tag_insert_query = mysqli_query($con,"INSERT INTO Tags (Tag_ID,Tag) VALUES (NULL,'$tags[$i]')");//Inserting the new tag into the the tag table
			$tag_id_query = mysqli_query($con,"SELECT Tag_ID FROM Tags WHERE Tag = '$tags[$i]'"); //Since we don't know the new Tag_ID of the newly inserted tag(since its auto increment), we have to query for it
			$new_tag_row = mysqli_fetch_array($tag_id_query); 
			$new_tag_id = $new_tag_row['Tag_ID']; //We then get the tag id of the newly inserted tag from the query
			$post_tag_query = mysqli_query($con,"INSERT INTo Posts_Tags (Post_FK,Tag_FK) VALUES ('$pid','$new_tag_id')");
		}
	}

	// Redirect to show post
	header("Location: /merch/?pid=$pid");
}
else {
	echo "Post failed to be created";
}















?> 
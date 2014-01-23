<?php
include('../globalref/php/sqlconf.php');
include('../globalref/php/sessionstart.php');

$num_files = 0;
$num_sizes = count($_FILES['file']['size']);
$success = true;
$file_path_array = array();

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
				
				//-----------------------------Submitting information----------------------------------------------------------------//
	  
	  
				//$filepath = '../images/' . $directory_number . '/' . $file_name . '_' . $file_increment . ".jpg"
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

if(count($file_path_array) == $num_files)
{
	$filepath = true;
}
else 
{
	$filepath = false;
	echo "You forgot to upload an image!<br/>";
}

if(!empty($_POST['subject']))
{
	$subject = mysqli_real_escape_string($con,$_POST['subject']);
}
else
{
	$subject = NULL;
	echo "You didn't type in a subject!<br/>";
}

if(!is_numeric($_POST['price']) || !isset($_POST['price']))
{
	$price = NULL;
	echo "You typed in an invalid number!<br/>";
}
else
{
	$price = $_POST['price'];
}

if(!empty($_POST['description']))
{
	$description = mysqli_real_escape_string($con,$_POST['description']);
}
else
{
	$description = NULL;
	echo "You didn't type in a description!<br/>";
}

if(!empty($_POST['location']))
{
	$array = explode(',',mysqli_real_escape_string($con,$_POST['location']),2);
	$city = $array[0];
	$state = $array[1];	
}
else 
{
	$city = NULL;
	$state = NULL;
	echo "You typed in an invalid city or state!<br/>";
}


if($subject && $price && $description && $city && $state && $filepath)
{
	$email = $_SESSION['email'];
	
	$users_query = $con->query("SELECT * FROM Users WHERE Email = '$email'");
	$users_row = mysqli_fetch_assoc($users_query);
	$user_fk = $users_row['User_PK'];
	
	
	$sql = $con->query("INSERT INTO Posts (User_FK,Subject,CurrentPrice,Description,City,State) VALUES ('$user_fk','$subject','$price','$description','$city','$state')");
	if(!$sql)
	{
		echo "Could not insert into database!<br/>";
	}
	else
	{
		$row_id = mysqli_insert_id($con);
		for($i = 0;$i < $num_files;$i++)
		{
			$posts_img_query = $con->query("INSERT INTO Posts_IMG (Source,Post_FK) VALUES ('$file_path_array[$i]','$row_id')");
			if (!$posts_img_query)
			{
				echo "Could not create relation!<br/>";
			}
			else
			{
				echo "Post created!<br/>";
			}
		}
		
		$description = 'Justin' . $description;
		
		$hash_array = explode('#',$description);
		
		$tags = array();
		for($counter = 1;$counter < count($hash_array);$counter++)
		{
			$space_array = explode(' ',$hash_array[$counter]);
			$tags[] = $space_array[0];
		}

		var_dump($tags);
	}
}
else
{
	echo "Post was not created<br/>";
}
?>
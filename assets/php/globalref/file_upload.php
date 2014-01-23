<?php
//This function assumes that the file array you are sending in is the $_FILES superglobal array so the use of the bracket operator is in the context of the $_FILES superglobal
//The acceptedTypes array should be formated so that the strings include the period in it i.e .png or .jpg
function generateFilePaths($fileArray,$acceptedTypes,$uploaderId,$pathString,$con,$multiple) //$fileArray is the array of files that you want uploaded and $acceptedTypes is an array of accepted extensions
{
	if(count($fileArray['file']['size']) == 0) //Since you can't upload a file that is of size 0, this is an accurate check
		return NULL;
	$allowedExts = $acceptedTypes; //Gets the acceptable extension types
	$numOfFiles = count($fileArray['file']['size']); //We have to get the number of files to be uploaded so we can know how many times to loop

	//We query the ImageDirectories table for the last directory that was created because that means it must be not full
	$fileCountStatement = "SELECT FileCount,Directory_PK FROM ImageDirectories ORDER BY Directory_PK DESC LIMIT 1"; 
	$fileCountQuery = mysqli_query($con,$fileCountStatement);
	$fileCountRow = mysqli_fetch_array($fileCountQuery);
	$fileCount = $fileCountRow['FileCount']; //We get the current file count in the directory so we know where to start the file count at
	$directoryCount = $fileCountRow['Directory_PK']; //We also need the last Directory_PK that was created incase we need to make a new directory
	$pathToImages = $pathString . 'assets/images/';

	$fileIncrement = 0; //Increment variable just incase there are collisions
	$filePaths = array(); //This will be the array of paths(strings) that we send out of the function 

	if($multiple) //They passed in a multi file array
	{
		for($i = 0;$i < $numOfFiles;$i++) //Iterate through the number of files in the fileArray
		{
			if(isset($fileArray['file']['size'][$i])) //If the file is present
			{
				$image_type_id = exif_imagetype($fileArray['file']['tmp_name'][$i]); //Gets the type of image it is, returns an int that represents a predefined value using ENUMS
				$extensionString = image_type_to_extension($image_type_id); //String version of the file's extension

				if($fileArray['file']['size'][$i] < 5000000 && in_array($extensionString,$allowedExts)) //Check if the file is less than 4.78MB and is an allowed type of file
				{
					if($fileArray['file']['error'][$i] > 0) //If we have an error, return NULL to signify that those files couldn't be uploaded
					{
						return NULL;
					}
					else //There are no errors so we can proceed and convert and upload the file
					{
						$uploaded = false; //Bool variable used to break out of loop
						/*========================GET DIRECTORY=================================================*/
						//Finds the last directory that doesn't have a file count of 500(full)
						$get_directory_query = "SELECT Path FROM ImageDirectories  WHERE FileCount != 500 ORDER BY Directory_PK DESC LIMIT 1";
						$get_directory = mysqli_query($con,$get_directory_query);
						$directory_row = mysqli_fetch_array($get_directory);
						$directory = $directory_row['Path']; //The path of the last directory that isn't full

						/*====================[END]GET DIRECTORY================================================*/

						/*=========================HASH INFO==============================================================*/
						//Gets the hash information(id,current time,file name) and uses them to hash the files name
						$currentTimeQuery = mysqli_query($con,"SELECT NOW() AS Time");
						$currentTimeRow = mysqli_fetch_array($currentTimeQuery);
						$currentTime = $currentTimeRow['Time'];

						$fileHashName = md5('\'' . $uploaderId . $currentTime . $fileArray['file']['name'][$i] . '\'');

						$imageResourceArray = array();
						$imageResourceArray[0] = createImageResource($image_type_id,$fileArray['file']['tmp_name'][$i]); //Large
						$imageResourceArray[1] = createThumbnails($imageResourceArray[0],200); //Small
						//$imageResourceArray[2] = createThumbnails($imageResourceArray[0],100); //Thumbnail

						/*=======================[END]HASH INFO============================================================*/

						while(!$uploaded) //We stay in this while loop until the photo is uploaded
						{
							checkCapacity($directoryCount,$fileCount,$pathToImages,$con);
							//Checks for file name collisions
							if(file_exists($pathToImages . "ani-pt-" . $directoryCount . '/' . $fileHashName . $fileIncrement . '.jpg'))
							{
								++$fileIncrement;
							}
							else //The filename does not exist in the current directory so we add it in
							{
								$imageDirectoryPath = 'ani-pt-' . $directoryCount . '/' . $fileHashName . $fileIncrement;
								if(createPicture($i,$filePaths,$imageResourceArray,$pathToImages,$imageDirectoryPath,$directoryCount,$fileCount,$con))
								{
									$fileCountUpdateQuery = "UPDATE ImageDirectories SET FileCount = '$fileCount' WHERE Directory_PK = '$directoryCount'";
									$fileCountUpdate = mysqli_query($con,$fileCountUpdateQuery);
									imagedestroy($imageResourceArray[0]);
									imagedestroy($imageResourceArray[1]);
									//imagedestroy($imageResourceArray[2]);
									$uploaded = true; //Make uploaded true so the while loop breaks
								}
							}	
						} 
						$fileIncrement = 0; //Reset the increment count
					}
					//sleep(1);
				}
			}
		}
	}
	else //They passed in a single file array
	{
		if(isset($fileArray['file']['size']))
		{
			$image_type_id = exif_imagetype($fileArray['file']['tmp_name']);
			$extensionString = image_type_to_extension($image_type_id);

			if($fileArray['file']['size'] < 5000000 && in_array($extensionString,$allowedExts))
			{
				if($fileArray['file']['error'] > 0)
				{
					return NULL;
				}
				else
				{
					$get_directory_query = "SELECT `Path` FROM ImageDirectories  WHERE FileCount != 500 ORDER BY Directory_PK DESC LIMIT 1";
					$get_directory = mysqli_query($con,$get_directory_query);
					$directory_row = mysqli_fetch_array($get_directory);
					$directory = $directory_row['Path']; //The path of the last directory that isn't full

					$uploaded = false; //Bool variable used to break out of loop

					$currentTimeQuery = mysqli_query($con,"SELECT NOW() AS Time"); //Gets current time to use for hash
					$currentTimeRow = mysqli_fetch_array($currentTimeQuery);
					$currentTime = $currentTimeRow['Time'];

					$fileHashName = md5('\'' . $uploaderId . $currentTime . $fileArray['file']['name'] . '\''); //This creates a hash using the usersID and the current time it was created

					$imageResourceArray = array();
					$imageResourceArray[0] = createImageResource($image_type_id,$fileArray['file']['tmp_name']); //Large
					$imageResourceArray[1] = createThumbnails($imageResourceArray[0],200); //Small
					//$imageResourceArray[2] = createThumbnails($imageResourceArray[0],100); //Thumbnail

					/*=======================[END]HASH INFO============================================================*/

					while(!$uploaded) //We stay in this while loop until the photo is uploaded
					{
						checkCapacity($directoryCount,$fileCount,$pathToImages,$con);
						//Checks for file name collisions
						if(file_exists($pathToImages . "ani-pt-" . $directoryCount . '/' . $fileHashName . $fileIncrement . '.jpg'))
						{
							++$fileIncrement;
						}
						else //The filename does not exist in the current directory so we add it in
						{
							$imageDirectoryPath = 'ani-pt-' . $directoryCount . '/' . $fileHashName . $fileIncrement;
							if(createPicture(0,$filePaths,$imageResourceArray,$pathToImages,$imageDirectoryPath,$directoryCount,$fileCount,$con))
							{
								$fileCountUpdateQuery = "UPDATE ImageDirectories SET FileCount = '$fileCount' WHERE Directory_PK = '$directoryCount'";
								$fileCountUpdate = mysqli_query($con,$fileCountUpdateQuery);
								imagedestroy($imageResourceArray[0]);
								imagedestroy($imageResourceArray[1]);
								$uploaded = true; //Make uploaded true so the while loop breaks
							}
						}	
					}
					$fileIncrement = 0;
				}
			}
		}
	}
	var_dump($filePaths);
	return $filePaths;
}
/*
createPicture - creates an image in the desired path
-------------------
$row_num - the index of the 2d array you want to insert the paths(which file do you want to insert the path into)
$pictureResourceArray - an array that holds both the image resource of the large and small size, large is index 0, small is index 1
$pathToImages - the path to the images folder outside of web root
$imageDirectoryPath - the path of the directory folder and image name without the size indicator and extension
$directoryCount - the number of the current working directory
$fileCount - the number of files in the current working directory
$con - the link to the database connection


Procedure
-------------
1) Creates the uses the image resource to create the image and places it in $pathToImages concatenated with $imageDirectoryPath 
which is a full path to the images folder and which image directory.

2) We only insert the image directory(ani-pt-1) and the file name into the database 
because since we're going to be accessing these photos from different folders, we want the person to provide the path to the images folder
	2a) We concatenate the $imageDirectoryPath with the respective size indicators in the function and not pass in the full path with the indicators
	because of generalization purposes. We don't want to make two different variables(each with the size indicator added on already), therefore we add it here
	2b) Inside the insertPath function, we add the image directory path(ani-pt-1/....) into the path array we're returning and increment the fileCount. After inserting the actual picture
	and file path, we want to check the capacity of the current directory and make a new directory,adjust the direcetoryCount and fileCount if needed
	2c) If all goes well and both files are created successfully, we return true
*/
function createPicture($row_num = 0,&$filePaths,$pictureResourceArray,$pathToImages,$imageDirectoryPath,&$directoryCount,&$fileCount,$con)
{
	$largeSizeCheck = imagejpeg($pictureResourceArray[0],$pathToImages . $imageDirectoryPath . '_lg.jpg',100);
	insertPath($row_num,$filePaths,$imageDirectoryPath . '_lg.jpg',$directoryCount,$fileCount,$pathToImages,$con);

	$smallSizeCheck = imagejpeg($pictureResourceArray[1],$pathToImages . $imageDirectoryPath . '_sm.jpg',100);
	insertPath($row_num,$filePaths,$imageDirectoryPath . '_sm.jpg',$directoryCount,$fileCount,$pathToImages,$con);

	/*$thumbnailCheck = imagejpeg($pictureResourceArray[2],$pathToImages . $imageDirectoryPath . '_tn.jpg',100);
	insertPath($row_num,$filePaths,$imageDirectoryPath . '_tn.jpg',$directoryCount,$fileCount,$pathToImages,$con);*/

	//var_dump($filePaths);
	if($largeSizeCheck && $smallSizeCheck/* && $thumbnailCheck*/)
		return true;
	else
		return false;
}

function insertPath($row_num,&$filePaths,$imageDirectoryPath,&$directoryCount,&$fileCount,$pathToImages,$con)
{
	$filePaths[$row_num][] = $imageDirectoryPath;
	++$fileCount;
	checkCapacity($directoryCount,$fileCount,$pathToImages,$con);
}

//I'm assuming the file name is the name of the temp file from the $_FILES
function createImageResource($image_type_id,$file_name)
{
	switch($image_type_id) //Use a swtich statement and convert the file to .jpg depending on which extension it was originally
	{
		case IMAGETYPE_GIF:
			$originalPic = imagecreatefromgif($file_name);
			break;
		case IMAGETYPE_JPEG:
			$originalPic = imagecreatefromjpeg($file_name);
			break;
		case IMAGETYPE_PNG:
			$originalPic = imagecreatefrompng($file_name);
			break;
	}

	$pictureDimensions = getimagesize($file_name);
	if($pictureDimensions[0] > 1024) //We only allow for pictures to be a max width of 1024, if its bigger we resize it using the width-height ratio
	{
		$dimensionRatio = 1024 / $pictureDimensions[0]; //Dimension ratio
		$newWidth = 1024;
		$newHeight = $pictureDimensions[1] * $dimensionRatio; 
		$newImageResource = imagecreatetruecolor($newWidth,$newHeight);


		$resizedImage = imagecopyresized($newImageResource, $originalPic, 0, 0, 0, 0, $newWidth, $newHeight, $pictureDimensions[0], $pictureDimensions[1]);
		if($resizedImage)
			return $newImageResource;
	}
	return $originalPic;
}

//Image_path is the source path of the image
//Image_source is the image resource object
//Final width is the width of thumbnail
function createThumbnails($image_resource,$finalWidth)
{
	$sourceX = imagesx($image_resource);
	$sourceY = imagesy($image_resource);

	$pictureRatio = $finalWidth / $sourceX;
	$newWidth = $finalWidth;
	$newHeight = $sourceY * $pictureRatio;
	$newImageResource = imagecreatetruecolor($newWidth,$newHeight);

	$newThumbNail = imagecopyresized($newImageResource,$image_resource,0,0,0,0,$newWidth,$newHeight,$sourceX,$sourceY);

	return $newImageResource;
}



/*
checkCapacity - checks if the current directory is full(has 500 files in it) and creates a new directory if needed
-------------------- 
$current_directory - A reference to the directoryCount variable incase we have to create a new directory
$current_count - A reference to the fileCount variable because we have to reset it if we create a new directory
$pathString - A string that is used to get to the assets folder outside of web root
$con - The link to the database connection
*/
function checkCapacity(&$directoryCount,&$fileCount,$pathToImages,$con)
{
	if($fileCount == 500)
	{
		$updateDirectoryQuery = "UPDATE ImageDirectories SET FileCount = 500 WHERE Directory_PK = '$directoryCount'";
		$updateDirectory = mysqli_query($con,$updateDirectoryQuery);

		$insertNewDirectoryStatement = "INSERT INTO ImageDirectories (Directory_PK) VALUES (NULL)"; 
		$insertNewDirectoryQuery = mysqli_query($con,$insertNewDirectoryStatement);
		
		//We have to use the next value for the Directory_PK column, I create an empty row in ImageDirectories and then assign the path name after
		$newDirectoryID = mysqli_insert_id($con);
		$newDirectory = "/ani-pt-" . $newDirectoryID . "/";
		$updateRecentDir = "UPDATE ImageDirectories SET `Path` = '$newDirectory' WHERE Directory_PK = '$newDirectoryID'"; 
		$updateDir = mysqli_query($con,$updateRecentDir);

		mkdir($pathToImages . "ani-pt-" . $newDirectoryID . '/',644);
		$directoryCount = $newDirectoryID;
		$fileCount = 0;
	}
} 
?>
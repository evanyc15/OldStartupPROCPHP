<?php
echo "Working Directory of Upload_Sell: " . getcwd() . '<br>';
$user_id = $_SESSION['id']; //this is the id of the user
$city;// City of user
$state;// State of user
$subject; // Title of the post
$description; // Description of the post
$price = 0; // Price of the item
$type_of_post; //Type of post


if(empty($_POST['address'])) //If there is no location present, we use the location the user signed up under
{
	$query = "SELECT City,State FROM Users WHERE User_PK = '$user_id'";
	if($result = mysqli_query($con,$query))
	{
			$row = mysqli_fetch_array($result);
			$city = $row['City'];
			$state = $row['State'];
	} //if
} //if
else //If there is a location present, convert the state to its abbreviation
{
	$location = explode(', ',$_POST['address']);
	$city = $location[0];
	$state = $location[1];
	
	$state = str_ireplace( //Converts the actual spelling of the state to its abbreviation
							array(
								"Alabama",
								"Alaska",
								"Arizona",
								"Arkansas",
								"California",
								"Colorado",
								"Connecticut",
								"Delaware",
								"Florida",
								"Georgia",
								"Hawaii",
								"Idaho",
								"Illinois",
								"Indiana",
								"Iowa",
								"Kansas",
								"Kentucky",
								"Louisiana",
								"Maine",
								"Maryland",
								"Massachusetts",
								"Michigan",
								"Minnesota",
								"Mississippi",
								"Missouri",
								"Montana",
								"Nebraska",
								"Nevada",
								"New Hampshire",
								"New Jersey",
								"New Mexico",
								"New York",
								"North Carolina",
								"North Dakota",
								"Ohio",
								"Oklahoma",
								"Oregon",
								"Pennsylvania",
								"Rhode Island",
								"South Carolina",
								"South Dakota",
								"Tennessee",
								"Texas",
								"Utah",
								"Vermont",
								"Virginia",
								"Washington",
								"West Virginia",
								"Wisconsin",
								"Wyoming"
							),
							array(
								"AL",
								"AK",
								"AZ",
								"AR",
								"CA",
								"CO",
								"CT",
								"DE",
								"FL",
								"GA",
								"HI",
								"ID",
								"IL",
								"IN",
								"IA",
								"KS",
								"KY",
								"LA",
								"ME",
								"MD",
								"MA",
								"MI",
								"MN",
								"MS",
								"MO",
								"MT",
								"NE",
								"NV",
								"NH",
								"NJ",
								"NM",
								"NY",
								"NC",
								"ND",
								"OH",
								"OK",
								"OR",
								"PA",
								"RI",
								"SC",
								"SD",
								"TN",
								"TX",
								"UT",
								"VT",
								"VA",
								"WA",
								"WV",
								"WI",
								"WY"
							),
							$state
						);
} //else

if(!empty($_POST['subject'])) //If the subject isn't empty, check for cuss words in the post
{
	$type_of_post = 'Sell';
	$subject = mysqli_real_escape_string($con,$_POST['subject']);
	$subject = str_ireplace( //Checks for cuss words in the post
								array(
									'asshole',
									'bitch',
									'dick',
									'shit',
									'cunt',
									'pussy',
									'fuck',
									'nigga',
									'nigger',
									'fucker',
									'motherfucker',
									'motherfucking'
								), 
								array(
									'allipipopotto',
									'billgringin',
									'dooblemoore',
									'shootinburgle',
									'calitingle',
									'pladitudinous',
									'fillyphobia',
									'noophilio',
									'nallyberry',
									'fudelier',
									'molickflicker',
									'mutetherfeather'
								),
								$subject
								);
} //if
else
{
	$subject = NULL;
	$type_of_post = 'Status';
	echo "You didn't type in a subject!<br/>";
} //else

$count = substr_count($subject, '$'); //Counts the number of $s there are in the subject

if($count == 1) //this means that there is only one dollar sign in the subject/title
{
	//Explodes the original subject by $ dollar sign and then explodes the 2nd element by space to get the price of the post
	$arr = explode('$', $subject);
	$arr2 = explode(' ', $arr[1]);
	$price = $arr2[0];
} //if
else 
{
	echo "you put too many or too little dollar signs!\n";
} //else

if(!empty($_POST['description'])) //Checking if they put in a description, if they did then check for cuss words
{
	$description = mysqli_real_escape_string($con,$_POST['description']);
	$description = str_ireplace(
									array(
										'asshole',
										'bitch',
										'dick',
										'shit',
										'cunt',
										'pussy',
										'fuck',
										'nigga',
										'nigger',
										'fucker',
										'motherfucker',
										'motherfucking'
									), 
									array(
										'allipipopotto',
										'billgringin',
										'dooblemoore',
										'shootinburgle',
										'calitingle',
										'pladitudinous',
										'fillyphobia',
										'noophilio',
										'nallyberry',
										'fudelier',
										'molickflicker',
										'mutetherfeather'
									), 
									$description
								);
} //if
else
{
	$description = NULL;
	echo "You didn't type in a description!<br/>";
} //else

$num_files = count($_FILES['file']['size']);// Represents number of files that are sent through the $_FILES superglobal
$acceptedTypes = array(".jpg",".jpeg",".png",".gif"); //Accepted file extensions
$file_path_array = array();// Represents the array of paths to each uploaded file

echo "Expected file count is $num_files<br>";
if($num_files != 0) //If the number of files sent through $_FILES is not zero than we have to process them
{
	$file_path_array = generateFilePaths($_FILES,$acceptedTypes,$user_id,'../../../',$con,true); //Get the paths of the files uploaded
	var_dump($file_path_array);
	if(count($file_path_array) == $num_files) //If the array isn't NULL, check if the number of paths sent back is equal to the number of files sent through $_FILES(all of the files were successfully created)
	{
		$filepath = true; //All of the files were processed correctly
	}
	else //There was a problem with uploading some of the pictures
	{
		$filepath = false;
	}
}
else //If the user decides not to upload a picture then use the default placeholder picture
{
	$filepath = true;
	$file_path_array[0][1] = '/globalref/images/placeholder.jpg'; 
}

if(($subject && $price && $description && $city && $state && $filepath && $type_of_post == "Sell") || ($description && $city && $state && $filepath && $type_of_post == "Status"))
{
	// Push to server
	upload_info($subject, $price, $description, $city, $state, $filepath, $type_of_post, $num_files, $file_path_array, $user_id, $con);
} //if
else
{
	echo "Post failed to be created";
} //else


function upload_info($subject, $price, $description, $city, $state, $filepath, $type_of_post, $num_files, $file_path_array, $user_id, $con)
{
	if($subject && $price && $description && $city && $state && $filepath && $type_of_post == "Sell")
	{
		$query = "INSERT INTO Posts (User_FK,Subject,CurrentPrice,Description,City,State,Type)
		VALUES ('$user_id','$subject','$price','$description','$city','$state','$type_of_post')";
		mysqli_query($con, $query);
	} //if
	else if($description && $city && $state && $filepath && $type_of_post == "Status")
	{
		$query = "INSERT INTO Posts (User_FK,Description,City,State,Type)
		VALUES ('$user_id','$description','$city','$state','$type_of_post')";
		mysqli_query($con, $query);
	} //else if

	$query = "SELECT Post_PK FROM Posts WHERE User_FK = '$user_id' ORDER BY Post_PK DESC LIMIT 1";

	if($result = mysqli_query($con,$query))
	{
		$row = mysqli_fetch_array($result);
		$pid = $row['Post_PK'];
	} //if
	
	else 
	{
		header("Location: /error/");
	}
	// Push filepaths to Posts_IMG
	for($i = 0;$i < $num_files;$i++)
	{
		$largeSize = $file_path_array[$i][0];
		$smallSize = $file_path_array[$i][1];

		echo "Large Size Path: $largeSize<br>";
		echo "Small Size Path: $smallSize<br>";

		$posts_lgImg_query = mysqli_query($con,"INSERT INTO Posts_IMG (Source,Post_FK,Size) VALUES ('$largeSize','$pid','Large')");
		$posts_smImg_query = mysqli_query($con,"INSERT INTO Posts_IMG (Source,Post_FK,Size) VALUES ('$smallSize','$pid','Small')");
		if (!$posts_lgImg_query || !$posts_smImg_query)
		{
			echo "Could not create relation!<br/>";
		} //if
		else
		{
			echo "Post created!<br/>";
		} //else
	} //for

	//Create tags for post
	$description = 'Justin' . $description;

	$hash_array = explode('#',$description);

	$tags = array();
	for($counter = 1;$counter < count($hash_array);$counter++)
	{
	$space_array = explode(' ',$hash_array[$counter]);
	$tags[] = $space_array[0];
	} //for

	for($i = 0;$i < count($tags);$i++)
	{
		$code = preg_replace("/[^A-Za-z0-9 ]/", '', $tags[$i]); //Make it so that #SamsungGalaxy, and #SamsungGalaxy are not in the table
		$tag_query = mysqli_query($con,"SELECT * FROM Tags WHERE Tag = '$tags[$i]'"); //Check if the tag is already in the Tags table
		if(mysqli_num_rows($tag_query) > 0) //Tag is already in database, don't re-add
		{
			$tag_row = mysqli_fetch_array($tag_query);
			$tag_id = $tag_row['Tag_ID']; //We get the Tag_ID of the tag thats already in the table
			$post_tag_query = mysqli_query($con,"INSERT INTO Posts_Tags (Post_FK,Tag_FK) VALUES ('$pid','$tag_id')"); //Insert a new row into Posts_Tags to link the post and the tag
			$query_pop = "UPDATE Tags SET Popularity = Popularity + 1 WHERE Tag_ID = '$tag_id'";
			$result = mysqli_query($con, $query_pop);
		} //if
		else //Tag is not present, add it into the database
		{
			if(!(ctype_digit($tags[$i][0]))) //if the first character is not a digit, put it in the table
			{
				$tag_insert_query = mysqli_query($con,"INSERT INTO Tags (Tag_ID,Tag) VALUES (NULL,'$tags[$i]')");//Inserting the new tag into the the tag table
				$tag_id_query = mysqli_query($con,"SELECT Tag_ID FROM Tags WHERE Tag = '$tags[$i]'"); //Since we don't know the new Tag_ID of the newly inserted tag(since its auto increment), we have to query for it
				$new_tag_row = mysqli_fetch_array($tag_id_query);
				$new_tag_id = $new_tag_row['Tag_ID']; //We then get the tag id of the newly inserted tag from the query
				$post_tag_query = mysqli_query($con,"INSERT INTo Posts_Tags (Post_FK,Tag_FK) VALUES ('$pid','$new_tag_id')");
			} //if
		} //else
	} //for

	// Redirect to show post
	header("Location: /merch/?pid=$pid");
} //function
?> 
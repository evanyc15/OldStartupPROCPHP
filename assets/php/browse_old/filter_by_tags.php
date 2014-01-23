<?php
	//Get the tag data to search and data range for retrieval
	$current = $_GET['current'];
	$increment = $_GET['increment'];
	$data = $_GET['currentdata'];
	$inputdata = json_decode($data);
	
	//echo $inputdata[0]->{'text'};
	//var_dump($inputdata);
	
	//If there are more than one tag than search for all the tags
	if(count($inputdata) > 0){
		$currenttext = $inputdata[0]->{'text'};
		$sql = "SELECT p.Post_PK, p.Sold,
				u.City,u.State,u.FirstName,u.LastName,
				p.Subject,pi.Source,u.ProfilePicture
				FROM Tags 
				AS t 
				INNER JOIN Posts_Tags 
				AS pt 
				ON t.Tag_ID = pt.Tag_FK 
				INNER JOIN Posts 
				AS p 
				ON pt.Post_FK = p.Post_PK 
				INNER JOIN Posts_IMG 
				AS pi 
				ON p.Post_PK = pi.Post_FK 
				INNER JOIN Users 
				AS u 
				ON p.User_FK = u.User_PK
				WHERE t.Tag = '$currenttext'";
		
		//Appending the tag query
		for($i=1; $i < count($inputdata); $i++){
			$currenttext = $inputdata[$i]->{'text'};
			$sql = $sql." OR t.Tag = '$currenttext'";
		}
		
		//Setting data range of tags
		$sql = $sql." GROUP BY pi.Post_FK LIMIT $current,$increment";
		
		$result = mysqli_query($con,$sql);
		
		$i = 0;
		$tag_row = array();
		while($row = mysqli_fetch_array($result))
		{
			$subject = $row['Subject'];	
			$location = $row['City'].", ".$row['State'];
			$post_fk =  $row['Post_PK'];
			$name = $row['FirstName']." ".$row['LastName'];
			$profilepic = $row['ProfilePicture'];
			$postimg = $row['Source'];
			
			$tag_row[$i] = array(
				'Post_FK' => $post_fk,
				'Source' => $postimg,
				'Subject' => $subject,
				'Loc' => $location,
				'Name' => $name,
				'ProfilePic' => $profilepic,
				'Sold' => $row['Sold']
			);
			$i++;
		}
	}
	/*return to ajax as json*/
	echo json_encode($tag_row);
	mysqli_close($con);

//$jsonObject = json_decode($data);
	/*SQL Query to get all Posts
	$sql = "SELECT * FROM Tags WHERE Tag = '$input_tag'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);
	$tagid = $row['Tag_ID'];*/
?>



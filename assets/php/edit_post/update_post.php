<?php 

$postId = mysqli_real_escape_string($con,$_GET['pid']);

$description = mysqli_real_escape_string($con,$_POST['description']);
$subject = mysqli_real_escape_string($con,$_POST['subject']);
$price = 0;

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

$query = "UPDATE Posts SET CurrentPrice='$price',Description='$description',Subject='$subject' WHERE Post_PK='$postId'";
if($result = mysqli_query($con,$query))
{
	//Create tags for post
	$description = 'Justin' . $description;
		
	$hash_array = explode('#',$description);
		
	$inputTags = array();
	for($counter = 1;$counter < count($hash_array);$counter++)
	{
		$space_array = explode(' ',$hash_array[$counter]);
		echo "**$space_array[0]**";
		$inputTags[] = $space_array[0];
	}	
	
	echo $postId;
	$query = "SELECT t.Tag FROM Tags AS t INNER JOIN Posts_Tags AS pt ON t.Tag_ID = pt.Tag_FK WHERE pt.Post_FK = '$postId'";
	if($result = mysqli_query($con, $query))
	{
		$queryTags = array();
		$i = 0;
		while($row = mysqli_fetch_array($result))
		{
			$queryTags[$i] = mysqli_real_escape_string($con,$row[0]);
			echo "|***$queryTags[$i]***|";
			$i++;
		}
		
		// Calculate the difference between the inputTags and queryTags
		$add = array_diff($inputTags, $queryTags);
		echo "Count: ".count($add);
		print_r($add);
		$remove = array_diff($queryTags, $inputTags);
		echo "</br>Remove: ".count($remove);
		print_r($remove);
		// Add the tags that need to be added
		foreach($add as &$element)
		{
			echo $element."</br>";
			if(mysqli_query($con, "INSERT INTO Tags (Tag) VALUES ('$element')"))
			{
				echo "$element added</br>";
			}
			else 
			{
				echo "$element not added</br>";
			}
			
			if($result = mysqli_query($con, "SELECT Tag_ID FROM Tags WHERE Tag = '$element'"))
			{
				$row = mysqli_fetch_array($result);
				$tagId = mysqli_real_escape_string($con,$row['Tag_ID']);
				
				if (!mysqli_query($con, "INSERT INTO Posts_Tags (Post_FK,Tag_FK) VALUES ('$postId','$tagId')"))
					echo "Could not insert row ('$postId','$tagId') into Posts_Tags</br>";
			}
			else 
			{
				echo "Couldn't find $element in the Tags table. </br>";
			}
		}// end for add
		
		// Unreference $element so it can be used later
		unset($element);
		
		// Remove the tags that need to be removed
		foreach($remove as &$element)
		{
			echo $element."</br>";
			$result = mysqli_query($con, "SELECT Tag_ID FROM Tags WHERE Tag = '$element'");
			$row = mysqli_fetch_array($result);
			$tagId = mysqli_real_escape_string($con,$row['Tag_ID']);
			
			mysqli_query($con,"DELETE FROM Posts_Tags WHERE Post_FK='$postId' AND Tag_FK = '$tagId'");
		}// end for remove
	}// end if

	header("Location: /merch/?pid=$postId");
} //if

else
{
	header("Location: /error/");

}

?>
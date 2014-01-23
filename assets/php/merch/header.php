<?php
$postID = $_GET['pid'];
$userID = $_SESSION['id'];
$myPost = 0;

$post_query = "SELECT p.*,pi.Source,DATE_FORMAT(p.DateTime,'%M %c, %Y') AS Time FROM Posts AS p INNER JOIN Posts_IMG AS pi ON p.Post_PK = pi.Post_FK WHERE p.Post_PK = '$postID' AND pi.Size = 'Large'"; //Get the post info and post images
$comment_query = "SELECT * FROM PostComments WHERE Post_FK = '$postID'"; //Get all the comments for a particular post														//This is breaking it  ^^  the "AND LARGE"
$tag_query = "SELECT pt.Post_FK,t.Tag,t.Tag_ID FROM Posts_Tags AS pt INNER JOIN Tags AS t ON pt.Tag_FK = t.Tag_ID WHERE pt.Post_FK = '$postID'";
$popularity_query = "UPDATE Posts SET Popularity = Popularity + 1 WHERE Post_PK = '$postID'";
$new_user_query = "SELECT NewUser FROM Users WHERE User_PK = '$userID'";

$my_post_query = "SELECT COUNT(*) AS c FROM Posts WHERE User_FK = '$userID' AND Post_PK = '$postID'"; //you can't offer on your own post!
$result = mysqli_query($con, $my_post_query);
$row = mysqli_fetch_array($result);

if($row['c'] > 0)
{
	$myPost = 1;
} //if

$postResult = mysqli_query($con,$post_query); //Post info query
$commentsResult = mysqli_query($con,$comment_query); //Comments query
$tagsResult = mysqli_query($con,$tag_query);
$popularityResult = mysqli_query($con,$popularity_query);
$new_userResult = mysqli_query($con, $new_user_query);

//$tagsResult = mysqli_query($con,$tags_query); 

if($postResult && $commentsResult && $tagsResult)
{
	/*----------POST-INFO--------------------*/

	$query_row = mysqli_fetch_array($postResult);
	$isSold = mysqli_real_escape_string($con,$query_row['Sold']);  
	$subject = mysqli_real_escape_string($con,$query_row['Subject']); 
	$curentPrice = mysqli_real_escape_string($con,$query_row['CurrentPrice']); 
	$description = mysqli_real_escape_string($con,$query_row['Description']);
	$timeCreated = mysqli_real_escape_string($con,$query_row['Time']);
	$city = mysqli_real_escape_string($con,$query_row['City']);
	$state = mysqli_real_escape_string($con,$query_row['State']);
	$likes = mysqli_real_escape_string($con,$query_row['Likes']);
	//$pictureSrc = '../test.jpg';
	$pictureSrc = mysqli_real_escape_string($con,$query_row['Source']);
	$posterID = mysqli_real_escape_string($con,$query_row['User_FK']);
	$offerCount = mysqli_real_escape_string($con,$query_row['Offer_Count']);
	$comments = mysqli_real_escape_string($con,$query_row['Comment_Count']);
	//$comments = mysqli_num_rows($commentsResult);

	/*----------END-POST-INFO----------------*/

	$newUserRow = mysqli_fetch_array($new_userResult);
	$newUser = $newUserRow['NewUser'];
	
	/*----------USER-INFO--------------------*/
	$user_info_rows = mysqli_query($con,"SELECT * FROM Users WHERE User_PK = '$posterID'");
	$user_row = mysqli_fetch_array($user_info_rows);
	$firstName = mysqli_real_escape_string($con,$user_row['FirstName']);
	$lastName = mysqli_real_escape_string($con,$user_row['LastName']);
	$sellerPicture = mysqli_real_escape_string($con,$user_row['ProfilePicture']);

	/*----------END-USER-INFO----------------*/

	/*----------TAGS-------------------------*/
	$tags = array();
	while($tempTags = mysqli_fetch_array($tagsResult))
	{
		$tags[] = $tempTags;
 	}
 	$tagRelationQuery = "";
 	for($i=0;$i < count($tags);$i++)
 	{
 		$tagRelationQuery = mysqli_query($con,"UPDATE Users_Tags SET Weight = Weight+1 WHERE User_FK = '$userID' AND Tag_FK = '{$tags[$i]['Tag_ID']}'");
 	}
}

// START QUERYING BOOKMARKS
$alreadyBookmarked = false;// Represents whether or not the current user has already bookmarked this post.
$irrelevantBookmark = false;//represent whether the user is viewing his own merch, in that case don't show the bookmark

$bookmarkQuery = "SELECT * FROM Bookmarks_Users_Posts WHERE User_FK = '$userID' AND Post_FK = '$postID'";
$bookmarkResult = mysqli_query($con, $bookmarkQuery);
//--------------------------------------------------------------------------------------------------------

//$relevantQuery = "SELECT User_FK FROM Bookmarks_Users_Posts Where User_FK = '$userID'";
//$relevantResult = mysqli_query($con, $relevantQuery);

$irrelevantQuery = "SELECT Post_PK,User_FK FROM Posts WHERE Post_PK = '$postID'";
$irrelevantResult = mysqli_query($con, $irrelevantQuery);
$row = mysqli_fetch_array($irrelevantResult);
$poster_id = $row['User_FK'];
$noBookmark = false;

if($bookmarkResult && mysqli_num_rows($bookmarkResult) > 0)
{
	$alreadyBookmarked = true;
} 

if($poster_id == $userID)
{//check to see if merch item belongs to the user or not
	$irrelevantBookmark = true;
}

$alreadyLiked = false;

$likeQuery = "SELECT * FROM Likes_Users_Posts WHERE User_FK = '$userID' AND Post_FK = '$postID'";
$likeResult = mysqli_query($con, $likeQuery);

if($likeResult && mysqli_num_rows($likeResult) > 0)
{
	$alreadyLiked = true;
} //if
?>
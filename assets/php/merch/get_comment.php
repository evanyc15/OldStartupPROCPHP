<?php	
	$jsonArray = $_GET['json'];
	$decodedArray = json_decode($jsonArray);
	$post_id = $decodedArray->postid;
	$currentComment = $decodedArray->commentCount;

	$sql = "SELECT PostComments.*,TIME_FORMAT(TIMEDIFF(NOW(),DateTime),'%y %m %d %H %i %S') AS TimeDiff FROM PostComments WHERE Post_FK = '$post_id' ORDER BY DateTime DESC LIMIT " . $currentComment . ",5";
	$result = mysqli_query($con,$sql);
	$comment_row = array();
	$i = 0;
	while($row = mysqli_fetch_array($result))
	{			
		$fromuserfk = mysqli_real_escape_string($con,$row['User_FK']);
		$timeDiff = mysqli_real_escape_string($con,$row['TimeDiff']);
		$comment = mysqli_real_escape_string($con,$row['Comment']);
		
		$user_sql = "SELECT * FROM Users WHERE User_PK = '$fromuserfk'";
		$user_result = mysqli_query($con,$user_sql);
		$user_row = mysqli_fetch_array($user_result);
		
		$fullname = $user_row['FirstName']." ".$user_row['LastName'];
		$imgurl = $user_row['ProfilePicture'];
		
		$tempArray = array (
			'fromuserfk' => $fromuserfk,
			'fullname' => $fullname,
			'imgurl' => $imgurl,
			'time' => $timeDiff,
			'comment' => $comment
		);
		
		$comment_row[$i] = $tempArray;
		
		unset($tempArray);
	
		$i++;
	}
		
	echo json_encode($comment_row);
?>
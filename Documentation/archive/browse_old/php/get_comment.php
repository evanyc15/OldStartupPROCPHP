<?php
	include('../../globalref/php/sqlconf.php');
	include('../../globalref/php/lock.php');
	
	$post_id = $_GET['postid'];
	
	$sql = "SELECT * FROM PostComments WHERE Post_FK = '$post_id'";
	$result = mysqli_query($con,$sql);
	$_SESSION['num_rows'] = mysqli_num_rows($result) - 1;
	$comment_row = array();
	$i = 0;
		while($row = mysqli_fetch_array($result))
		{			
			$comment_row[$i] = $row;
			$i++;
		}
		
	echo json_encode($comment_row);
	mysqli_close($con);	
?>
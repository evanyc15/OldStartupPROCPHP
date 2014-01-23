<?php
	include('../../globalref/php/sqlconf.php');
	include('../../globalref/php/sessionstart.php');
	
	/*SQL Query to get all Posts*/
	$sql = "SELECT * FROM Posts";
	$result = mysqli_query($con,$sql);
	
	/*Start initializing the array to get the images*/
	$img_row = array();
		$i = 0;
		while($row = mysqli_fetch_array($result))
		{
			$subject =$row['Subject'];	
			$location = $row['City'].", ".$row['State'];
			$post_fk =  $row['Post_PK'];
			
			$img_query = "SELECT * FROM Posts_IMG WHERE Post_FK = '$post_fk'";
			$img_result = mysqli_query($con,$img_query);
			
			$row = mysqli_fetch_array($img_result);
			$img_row[$i] = array(
				'Post_FK' => $post_fk,
				'Source' => $row['Source'],
				'Subject' => $subject,
				'Loc' => $location
			);
			$i++;
		}
	/*return to ajax as json*/
	echo json_encode($img_row);
	mysqli_close($con);
?>
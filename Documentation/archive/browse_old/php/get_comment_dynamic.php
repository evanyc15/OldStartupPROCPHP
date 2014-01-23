<?php
	include('../../globalref/php/sqlconf.php');
	include('../../globalref/php/sessionstart.php');
		
	$num = $_GET['num'];	
	/*SQL Query to get all Posts*/
	$sql = "SELECT * FROM Posts";
	$result = mysqli_query($con,$sql);
	
	/*Start initializing the array to get the images*/
	$img_row = array();
		$i = 0;
		while($row = mysqli_fetch_array($result) && $i < 19)
		{
			$post_fk =  $row['Post_PK'];
			
			$img_query = "SELECT * FROM Posts_IMG WHERE Post_FK = '$post_fk'";
			$img_result = mysqli_query($con,$img_query);
			
			$img_row[$i] = mysqli_fetch_row($img_result);
			$i++;
		}
	
	/*return to ajax as json*/
	echo json_encode($img_row);
	mysqli_close($con);
?>
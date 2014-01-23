<?php 
require('../php/sqlconf.php');

$input = $_GET['input'];

$tagQuery = mysqli_query($con,"SELECT Tag FROM Tags WHERE Tag LIKE CONCAT('$input','%')");
if($tagQuery)
{
	$tagArray = array();
	$count = 1;
	while($tag = mysqli_fetch_array($tagQuery))
	{
		$tagArray[] = array(
			'id' => $count,
			'name' => $tag['Tag'],
			'type' => 'contact');
		++$count;
	}
	echo json_encode($tagArray);
}
?>
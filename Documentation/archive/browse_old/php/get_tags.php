<?php
require('../../globalref/php/sqlconf.php');

/*$jsonArray = $_GET['json'];
$decodedText = json_decode($jsonArray);
$text = mysqli_real_escape_string($con,$decodedText->currentText);
*/
$text = $_GET['currentText'];


$tag_query = "SELECT * FROM Tags WHERE Tag LIKE CONCAT('$text','%')";
$tags = mysqli_query($con,$tag_query);

if($tags)
{
	$tagArray = array();
	while($tag = mysqli_fetch_array($tags))
	{
		$tagArray[] = $tag;
	}
	echo json_encode($tagArray);
}
?>
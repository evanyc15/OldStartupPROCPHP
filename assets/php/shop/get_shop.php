<?php

$userID = $_SESSION['id'];
$page = $_GET['page'];
$current = $page*20;

$query = "SELECT p.Post_PK, p.Subject, p.City, p.State, p.Sold, 
		  pi.Source, p.CurrentPrice
		  FROM Posts AS p
		  INNER JOIN Posts_IMG AS pi ON pi.Post_FK = p.Post_PK
		  WHERE p.User_FK = '$userID'
		  GROUP BY p.Post_PK
		  LIMIT $current,20";
		  
$result = mysqli_query($con, $query);

$img_row = array();
$i = 0;
while( $row = mysqli_fetch_array($result) )
{
	list($width, $height, $type, $attr) = getimagesize("../../../assets/images/".$row['Source']); //GET's THE IMAGE SIZE!
	
	$img_row[$i] = array(
	"id" => $row['Post_PK'],
	"title" => $row['Subject'],
	"location" => $row['City'].", ".$row['State'],
	"price" => $row['CurrentPrice'],
	"width" => $width,
	"height" => $height,
	"preview" => "php/image_proxy.php?image=".$row['Source']
	);
	
	++$i;
} //while

echo json_encode($img_row);
mysqli_close($con);

?>
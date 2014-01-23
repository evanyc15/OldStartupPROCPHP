<?php

$jsonArray = $_GET['json'];
$infoArray = json_decode($jsonArray);
$initialRowNumber = $infoArray->rowCount;
/*if($initialItemNumber % 2 == 0) //If the number of posts they added is even, we request an even number of items
	$finalItemNumber = $initialItemNumber + 4;
else //If the number of posts they added is odd, we request an odd number of items to make it even again
	$finalItemNumber = $initialItemNumber + 5;
*/
//$finalRowNumber = $initialRowNumber + 2;
$user_ID = $infoArray->user;

//echo "Initial is $initialItemNumber and Final is $finalItemNumber";
$user_items_query = "SELECT p.Post_PK,p.Subject,p.Description,p.CurrentPrice,pi.Source FROM Posts AS p INNER JOIN Posts_IMG AS pi ON p.Post_PK = pi.Post_FK WHERE p.User_FK = '$user_ID' AND pi.Size = 'Small' GROUP BY p.Post_PK LIMIT " . ($initialRowNumber*2) . ',4';
$user_items = mysqli_query($con,$user_items_query);

if($user_items)
{
	$items_array = array();
	while($item = mysqli_fetch_array($user_items))
	{
		$items_array[] = $item;
	}
	echo json_encode($items_array);
}

else
{
	header("Location: /error/");

}

?>
<?php 
$user_id = $_SESSION['id'];
	
$query = "SELECT i.Post_FK, p.Subject, p.CurrentPrice, p.Description, p.City, p.State, p.Likes, p.Sold, p.Offer_Count, p.Comment_Count, i.Source
FROM Posts AS p
INNER JOIN Posts_IMG AS i ON p.Post_PK = i.Post_FK
WHERE p.User_FK =  '$user_id'
GROUP BY i.Post_FK";
$result = mysqli_query($con,$query);

?>
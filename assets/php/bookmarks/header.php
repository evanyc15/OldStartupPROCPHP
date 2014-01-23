<?php 

$user_id = $_SESSION['id'];

$query = "SELECT b.Post_FK,b.User_FK, p.Subject,p.Description,p.CurrentPrice,p.Likes,i.Source, p.Offer_Count, p.Comment_Count FROM Bookmarks_Users_Posts AS b INNER JOIN Posts AS p ON b.Post_FK = p.Post_PK INNER JOIN Posts_IMG AS i ON p.Post_PK = i.Post_FK WHERE b.User_FK  = '$user_id' AND i.Size = 'Large'";
$result = mysqli_query($con,$query);


?>
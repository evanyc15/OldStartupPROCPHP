<?php 

$page = $_GET['page'];
$current = $page*20;
$user_id = $_SESSION['id'];

//INNER JOIN Posts, Users, Posts_IMG
$sql = "SELECT Table1.Post_PK,Table1.Source,Table1.User_FK,
		Table1.ProfilePicture, Table1.Subject, Table1.FirstName,
		Table1.LastName,Table1.City, Table1.State, Table1.DateTime,
		Table1.Sold,Table1.CurrentPrice
		FROM ((SELECT p.Post_PK AS Post_PK, 
		p.Sold AS Sold,
		pi.Source AS Source, 
		u_p.User_PK AS User_FK, 
		u_p.ProfilePicture AS ProfilePicture, 
		u_p.FirstName AS FirstName, 
		u_p.LastName AS LastName, 
		u_p.City AS City,
		u_p.State AS State,
		p.Subject AS Subject,
		p.DateTime AS DateTime,
		p.CurrentPrice AS CurrentPrice
		FROM Tags AS t 
		INNER JOIN Users_Tags AS ut 
		ON t.Tag_ID = ut.Tag_FK 
		INNER JOIN Posts_Tags AS pt 
		ON pt.Tag_FK = t.Tag_ID 
		INNER JOIN Posts AS p 
		ON pt.Post_FK = p.Post_PK 
		INNER JOIN Posts_IMG AS pi 
		ON pi.Post_FK = p.Post_PK 
		INNER JOIN Users 
		AS u on ut.User_FK = u.User_PK 
		INNER JOIN Users AS u_p 
		ON p.User_FK = u_p.User_PK 
		WHERE u.User_PK = '$user_id' ORDER BY ut.Weight) 
		UNION 
		(SELECT p.Post_PK AS Post_PK,
		p.Sold AS Sold,
		pi.Source AS Source, 
		u.User_PK AS User_FK, 
		u.ProfilePicture AS ProfilePicture, 
		u.FirstName AS FirstName, 
		u.LastName AS LastName, 
		u.City AS City,
		u.State AS State,
		p.Subject AS Subject,
		p.DateTime AS DateTime, 
		p.CurrentPrice AS CurrentPrice
		FROM Users_Users AS uu 
		INNER JOIN Users AS u 
		ON uu.User2_FK = u.User_PK 
		INNER JOIN Posts 
		AS p 
		ON p.User_FK = u.User_PK 
		INNER JOIN Posts_IMG 
		AS pi ON pi.Post_FK = p.Post_PK 
		WHERE uu.User1_FK = '$user_id'
		ORDER BY p.Popularity)) 
		AS Table1 
		GROUP BY Table1.Post_PK
		ORDER BY Table1.DateTime
		LIMIT $current,20";

$result = mysqli_query($con,$sql);

$img_row = array();

while($row = mysqli_fetch_array($result))
{
	list($width, $height, $type, $attr) = getimagesize("../../../assets/images/".$row['Source']);

	$img_row[] = array(
			"id" => addslashes($row['Post_PK']),
			"title" => addslashes($row['Subject']),
			"poster" => addslashes("/profile/?user=".$row['User_FK']),
			"url" => addslashes("/merch/?pid=".$row['Post_PK']),
			"width" => $width,
			"height" => $height,
			"image" => addslashes("php/image_proxy.php?image=".$row['Source']),
			"preview" => addslashes("php/image_proxy.php?image=".$row['Source']),
			"name" => addslashes($row['FirstName']." ".$row['LastName']),
			"profilepicture" => addslashes("php/image_proxy.php?image=".$row['ProfilePicture']),
			"location" => addslashes($row['City'].", ".$row['State']),
			"price" => addslashes($row['CurrentPrice']),
	);
}

echo json_encode($img_row);
mysqli_close($con);

?>
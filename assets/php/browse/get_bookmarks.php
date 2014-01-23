<?php 
	$userID = $_SESSION['id'];
	$page = $_GET['page'];
	$current = $page*20;
	
	//INNER JOIN Posts, Users, Posts_IMG
	$sql = "SELECT p.Subject, p.City, p.State, p.Post_PK, p.User_FK, p.Sold,
	u.FirstName, u.LastName, u.ProfilePicture,
	pi.Source, p.CurrentPrice,
	bup.Post_FK AS BookmarkStatus,
	lup.Post_FK AS LikeStatus,
	bup.User_FK AS UserWhoBookmarked,
	lup.User_FK AS UserWhoLiked,
    o.Price AS Offer,
    o.User_FK AS Offerer,
    o.Status AS OfferStatus
	FROM Tags AS t 
	INNER JOIN Posts_Tags AS pt 
	ON t.Tag_ID = pt.Tag_FK
	INNER JOIN Posts AS p
	ON pt.Post_FK = p.Post_PK 
	INNER JOIN Users AS u
	ON p.User_FK = u.User_PK
	INNER JOIN (SELECT * FROM Posts_IMG WHERE Size ='Large') AS pi
	ON p.Post_PK = pi.Post_FK
	LEFT JOIN Bookmarks_Users_Posts AS bup 
	ON p.Post_PK = bup.Post_FK
	LEFT JOIN (SELECT * FROM Likes_Users_Posts WHERE User_FK = '$userID') AS lup 
	ON p.Post_PK = lup.Post_FK
	LEFT JOIN (SELECT o1.* FROM Offers AS o1
  	JOIN (SELECT Status,User_FK, Price, MAX(Offer_PK) AS Offer_PK FROM Offers WHERE User_FK = '$userID' GROUP BY Post_FK) AS o2
    ON o1.Offer_PK = o2.Offer_PK) AS o
	ON p.Post_PK = o.Post_FK";
	
	
	$inputdata;
	if(isset($_GET['tags']))
	{
		$pieces = explode(" ", $_GET['tags']);
		
		$currenttext = $pieces[0];
		
		$sql = $sql." WHERE bup.User_FK = '$userID' ";
		
		if($currenttext != "")
			$sql = $sql."AND t.Tag IN ('$currenttext'";
		
		//Appending the tag query
		for($i=1; $i < count($pieces); $i++)
		{
			if ($currenttext != "")
			{
				$currenttext = $pieces[$i];
				$sql = $sql.",'$currenttext'";
			}
		}
	}
	
	if($currenttext != "")
		$sql = $sql.")";
	
	//Setting data range of tags
	$sql = $sql." GROUP BY pi.Post_FK LIMIT $current,20";
	$result = mysqli_query($con,$sql);
	
	$img_row = array();
	while($row = mysqli_fetch_array($result))
	{
		list($width, $height, $type, $attr) = getimagesize("../../../assets/images/".$row['Source']);
		
		$bookmarkStatus = false;
		$likeStatus = false;
		
		if($row['BookmarkStatus'] != NULL && $row['UserWhoBookmarked'] == $userID)
			$bookmarkStatus = true;
		if($row['LikeStatus'] != NULL && $row['UserWhoLiked'] == $userID)
			$likeStatus = true;
		
		$offer = null;
		$offerStatus = null;
		
		if($row['Offer'] != NULL)
		{
			$offer = $row['Offer'];
			if($row['OfferStatus'] == "Accepted")
				$offerStatus = "has been <strong style=\"color:#73b3ac;\">accepted</strong>!";
			else if($row['OfferStatus'] == "Rejected")
				$offerStatus = "has been rejected";
			else 
				$offerStatus = "is pending...";
		}
		
		$img_row[] = array(
			"id" => addslashes($row['Post_PK']),
			"posterid" => addslashes($row['User_FK']),
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
			"bookmarkstatus" => $bookmarkStatus,
			"likestatus" => $likeStatus,
			"offer" => $offer,
			"offerstatus" => $offerStatus
		);
	}
	echo json_encode($img_row);
	mysqli_close($con);
?>
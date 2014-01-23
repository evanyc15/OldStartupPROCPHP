<?php
	include('../../globalref/php/lock.php');
	include('../../globalref/php/sqlconf.php');
	
	$post_ID = $_GET['id'];
	$user_ID = $_SESSION['id'];
	$_SESSION['post_id'] = $post_ID;
	
	$sql = "SELECT * FROM Posts WHERE Post_PK = '$post_ID'";
	if($result = mysqli_query($con,$sql)){}
	if($row = mysqli_fetch_array($result)){}
	
	$subject = $row['Subject'];
	$description = $row['Description'];
	$price = $row['CurrentPrice'];
	$city = $row['City'];
	$state = $row['State'];
	$likes = $row['Likes'];
	
	$img_row = array();
	
	$i = 0;	
	$img_query = "SELECT * FROM Posts_IMG WHERE Post_FK = '$post_ID'";
	$img_result = mysqli_query($con,$img_query);
	while($array = mysqli_fetch_array($img_result))
	{
		$img_row[$i] = $array['Source'];
		$i++;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript">
			<?php
				echo "var idpost= '".$_GET['id']. "';";
				echo "var session= '".$_SESSION['id']. "';";
			?>
		</script>
		<link rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="../../globalref/js/jquery-1.9.1.min.js"></script>
		<script type='text/javascript' src='https://cdn.firebase.com/v0/firebase.js'></script>
		<script type="text/javascript" src="js/lightbox.js"></script>
		<!--<script type="text/javascript">
		var $textbox = $('.post-box').clone(true,true);
		var jsonObj;
		var exists;
		var comment;
			setTimeout(function(){
				if(typeof(EventSource)!=="undefined"){
					var source = new EventSource("php/get_comment_SSE.php");
					source.onmessage=function(event){
						jsonObj = JSON.parse(event.data);
						exists = jsonObj.Exists;
						//alert(exists);
						if(exists == "full"){
							comment = jsonObj.Comment;
							var $newbox = $textbox.clone(true,true);
							$newbox.find('#post-text').val(comment);
				      		$newbox.appendTo('#comment-display-box');
							//alert(jsonObj.Comment);
							//alert(event.data);
						}
					}
				}
				else{
					alert("error");
				}
			},2000);
		</script>-->
	</head>
	<body>
	    <div class="lightbox-picpopup">
			<div id="image-box"><img id="lightbox-image" src="<?php echo $img_row[0]; ?>"></div>
			<div id="save-like-share">
				<div id="save">Save</div>
				<div id="like">Like</div>
				<div id="share">Share</div>
			</div>
			<div id="right-column">
				<div id="current-user"></div>
				<div id="info-box">
						<textarea id="subject" disabled><?php echo $subject; ?></textarea>
						<textarea id="price" disabled><?php echo $price; ?></textarea>
						<textarea id="description" disabled><?php echo $description; ?></textarea>
					</div>
				<div id="comment-display-box">
					<div class="post-box">
						<textarea id="name-date" disabled></textarea>
						<div id="pic-like-box">
							<div id="comment-pic"></div>
							<div id="like-link"></div>
						</div>
						<textarea id="post-text" disabled></textarea>
					</div>
				</div>
				<form>
					<div id="commenting-box">
						<textarea id="input-box" placeholder="Type here"></textarea>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>

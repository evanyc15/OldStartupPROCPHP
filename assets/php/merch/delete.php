<?php
$userID = $_SESSION['id'];
$postID = mysqli_real_escape_string($con,$_GET['postid']);

$query = mysqli_query($con,"DELETE FROM Posts WHERE Post_PK = '$postID'");

?>
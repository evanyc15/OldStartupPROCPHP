
<?php 

$user_id = $_SESSION['id'];
$post_id = $_POST['pid'];

if(isset($_POST['unbookmark']))
{ //When button above pressed
echo "Sent to server";
echo "<br />\n";//new line

$query = "SELECT * FROM Bookmarks_Users_Posts WHERE User_FK = '$user_id' AND Post_FK = '$post_id'";
$result = mysqli_query($con, $query);

if($result && (mysqli_num_rows($result) > 0))
{
	//echo "the query worked";
	$query = "DELETE FROM Bookmarks_Users_Posts WHERE User_FK = '$user_id' AND Post_FK ='$post_id'"; 
	mysqli_query($con, $query);
	
	header("Location: /bookmarks/");
	
}
mysqli_close($con);

}
?>

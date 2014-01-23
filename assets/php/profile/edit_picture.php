<?php 
$user_id = $_SESSION['id']; //this is the id of the user

$file_path = array(); // Represents the array of paths to each uploaded file
$allowedExts = array(".gif", ".jpeg", ".jpg", ".png");
 
$file_path = generateFilePaths($_FILES,$allowedExts,$user_id,'../../../',$con,false);
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

$query = "SELECT User_PK FROM Users WHERE User_PK = '$user_id'";
$result = mysqli_query($con,$query);
 
if($result)
{
        $newPicture = $file_path[0][0];
        $query = "UPDATE Users SET ProfilePicture = '$newPicture' WHERE User_PK = '$user_id'";
        if(mysqli_query($con,$query))
        {
                echo "<br/><br/>You updated your picture!";
                echo "<br/> $newPicture";
        } //if
        else
        {
                echo "<br/><br/>You didnt update your picture!";
        } //else
} //if
    header("Location: /profile/");
?>
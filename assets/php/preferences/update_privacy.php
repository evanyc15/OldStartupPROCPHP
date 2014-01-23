
<?php 

$user_id = $_SESSION['id'];

if(isset($_POST['submit']))
{ //When button above pressed
	echo "Sent to server";
	echo "<br />\n";//new line
	$genderFlag = 0;
	$birthdateFlag = 0;
	
	if (isset($_POST['gender']))
		$genderFlag = mysqli_real_escape_string($con,$_POST['gender']);
	if (isset($_POST['birthday']))
		$birthdateFlag = mysqli_real_escape_string($con,$_POST['birthday']);
	
	
	$sql = ("UPDATE Users SET ShowGender = ?, ShowBirthdate = ? WHERE User_PK = ?");
	$stmt = $con->prepare($sql);
	$stmt->bind_param('ddd', $dateofbirth,$selected_radio, $user_id);
	$stmt->execute();
	//check functionality later
	
	
	header("Location: /preferences/");
	
}
?>

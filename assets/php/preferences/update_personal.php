
<?php 

$user_id = mysqli_real_escape_string($con,$_SESSION['id']);

if(isset($_POST['submit']))
{ //When button above pressed
echo "Sent to server";
echo "<br />\n";//new line

//$passwordnew = mysqli_real_escape_string($con, md5($_POST['password_new_text']));


$firstName = mysqli_real_escape_string($con,$_POST["firstname_text"]);
$lastName = mysqli_real_escape_string($con,$_POST["lastname_text"]);
$email = mysqli_real_escape_string($con,$_POST["email_text"]);
$city = mysqli_real_escape_string($con,$_POST["city_text"]);
$state = mysqli_real_escape_string($con,$_POST["state_text"]);
$birthdate = strtotime($_POST["birth_text_new"]);
//echo $_POST['birth_text_new']; 
$dateofbirth = mysqli_real_escape_string($con,date('Y-m-d',$birthdate));

$male_status = 'unchecked';
$female_status = 'unchecked';

//Check for which radio button was pressed
$selected_radio = mysqli_real_escape_string($con,$_POST['optionsRadios2']);//

if ($selected_radio == 'M') 
{
	$male_status = 'checked';		
}

else if ($selected_radio == 'F') 
{
	$female_status = 'checked';
}

$sql =("UPDATE Users SET FirstName = ?, LastName = ?, Email = ?, City = ?, State = ?, Birthdate = ?, Gender = ? WHERE User_PK = ?");
$stmt = $con->prepare($sql);
$stmt->bind_param('sssssssd', $firstName, $lastName, $email, $city,$state, $dateofbirth,$selected_radio, $user_id);

$stmt->execute();

//original $query = "UPDATE Users SET FirstName = '$firstName', LastName = '$lastName', Email = '$email', City = '$city', State = '$state', Birthdate = '$dateofbirth', Gender = '$selected_radio' WHERE User_PK = '$user_id'";

//if($con->query($query))
//{
	//echo "the query worked";
header("Location: /preferences/");
//}


}
?>

<?php 


$firstName = mysqli_real_escape_string($con,$_POST['firstname']);
$lastName =mysqli_real_escape_string($con,$_POST['lastname']);
$city = mysqli_real_escape_string($con,$_POST['city']);
$state = mysqli_real_escape_string($con,$_POST['state']); //But really state
$email = $_POST['email'];
$password = mysqli_real_escape_string($con,md5($_POST['password']));

$user_info_query = mysqli_query($con,"INSERT INTO Users (User_PK,Email,Password,
		FirstName,LastName,City,State,About,ProfilePicture) VALUES
		(NULL,'$email','$password','$firstName','$lastName','$city','$state','','/globalref/images/pfdefault.jpg')");
if($user_info_query)
{
$_SESSION['email'] = $email;
$_SESSION['FirstName'] = $firstName;
$_SESSION['LastName'] = $lastName;
$_SESSION['id'] = mysqli_insert_id($con);
$_SESSION['password'] = $password;

$query = "SELECT * FROM Users WHERE Email = '$email'
AND FirstName = '$firstName' AND LastName = '$lastName'";
$result = mysqli_query($con,$query);
$row = mysqli_fetch_array($result);
$userpk = $row['User_PK'];

$queryTutorial = "INSERT INTO Tutorials (User_FK) VALUES ('$userpk')";
mysqli_query($con, $queryTutorial);

$size = 10;//10 digits long
$code = "";
for($i = 0; $i < $size; $i++)
{
$code.= chr(mt_rand(0,255));
}
$code = preg_replace("/[^A-Za-z0-9 ]/", '', base64_encode($code));//get rid of all the crap chars

$query = "UPDATE Users SET Validation = '$code' WHERE User_PK = '$userpk'";
$result = mysqli_query($con, $query);


//require('../../globalref/phpmailer/class.phpmailer.php');
require('../../../assets/php/globalref/phpmailer/class.phpmailer.php');



$mail = new PHPMailer;

$mail->IsSMTP();                                       // Set mailer to use SMTP
$mail->Host = 'mail.anilum.com';
$mail->Port='26';
// Specify main and backup server
$mail->Username = 'shahar.marom@anilum.com';                // SMTP username
$mail->Password = 'getonmylevel345';       // SMTP password
$mail->SMTPSecure = 'tls';                         // Enable encryption, 'ssl' also accepted

$mail->From = 'shahar.marom@anilum.com';
$mail->FromName = 'Anilum: Email Validation';
$mail->AddAddress($email);  // Add a recipient
$mail->AddReplyTo('shahar.marom@anilum.com', 'Information');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = 'The Social Market: Email Validation Code';
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Body    = "Welcome to the Social Market. You are one of our first testers! validate your email  <a href = 'http://www.anilum.com/preferences?code=$code'>Validate Here</a></br>Thanks,</br>The Team";
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->Send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
exit;
}

echo 'Message has been sent';

include ('validate_email.php');


echo $userpk;
header("Location: /interests/");

}
else
{
header("Location: /login/signup_error.php");
}

?>

<?php 
$email = $_POST['email'];// Represents the email which the user typed in

echo $email;

$query = "SELECT * FROM Users WHERE Email = '$email'";// To get the password of the user
if ($result = mysqli_query($con, $query))
{// If the email exists...

// Fetch the password
$row = mysqli_fetch_array($result);
$password = $row['Password'];
$email = $row['Email'];

// Encrypt the email
$size = 15;//256 bit == 32byte.
$code = "";
for($i = 0; $i < $size; $i++)
{
$code.= chr(mt_rand(0,255));
/*if((mt_rand(1,255) % ($i + 1)) == 0)
{
	$code.=$password[$i];
}
	else
{
	$code.=$email[$i];
}*/
	}
$code = preg_replace("/[^A-Za-z0-9 ]/", '', base64_encode($code));
$userId = $row['User_PK'];

//echo($code);

$query = "INSERT INTO ResetPassword (User_FK,Code) VALUES ('$userId','$code')";
if(mysqli_query($con, $query))
{
echo("Oh baby");
}
else
{
$query = "UPDATE ResetPassword SET Code = '$code' WHERE User_FK = '$userId'";
mysqli_query($con, $query);
}

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
$mail->FromName = 'Password Recovery';
$mail->AddAddress($email);  // Add a recipient
$mail->AddReplyTo('shahar.marom@anilum.com', 'Information');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->IsHTML(true);   
                               // Set email format to HTML
$mail->Subject = 'Password Recovery';
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Body    = "Click to reset your password: <b>http://www.anilum.com/retrieve?code=".$code."</b>";
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


if(!$mail->Send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
header("Location: /login/");
//exit;
}

echo 'Message has been sent';
header("Location: /login/");

}// end if

?>
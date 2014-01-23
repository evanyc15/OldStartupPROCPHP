<?php

$user_id = $_SESSION['id'];

$suggestion = $_POST['suggestion'];

$query = "INSERT INTO Suggestions (User_FK, Suggestion) VALUES ('$user_id','$suggestion')";
$result = mysqli_query($con, $query);

if($result)
{
	$query = "SELECT FirstName,Email FROM Users WHERE User_PK = '$user_id'";
	$result = mysqli_query($con, $query);
	if($row = mysqli_fetch_array($result))
	{
		$email = $row['Email'];
		$firstname = $row['FirstName'];
	} //if
} //if

else{
	
	header("Location: /error/");
	
}


//require '../globalref/phpmailer/class.phpmailer.php';
require('../../../assets/php/globalref/phpmailer/class.phpmailer.php');

	
	
	$mail = new PHPMailer;
	
	$mail->IsSMTP();                                       // Set mailer to use SMTP
	$mail->Host = 'mail.anilum.com';  	
	$mail->Port='26';   
	// Specify main and backup server
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username ='justin@anilum.com';                // SMTP username
	$mail->Password = '1a233b455c6d567ee98395f290';       // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
	
	$mail->From = $email;
	$mail->FromName = $firstname . "'s Suggestion";
	$mail->AddAddress('frey.conner24@gmail.com');  // Add a recipient
	$mail->AddAddress('shahar.m23@gmail.com');  // Add a recipient
	$mail->AddReplyTo('justin@anilum.com', 'Information');
	
	$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
	$mail->IsHTML(true);                                  // Set email format to HTML
	
	$mail->Subject = $firstname . "'s Suggestion";
	$mail->Body    = $suggestion;
	//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	if(!$mail->Send()) {
	echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
		exit;
	}
	
	echo 'Message has been sent';
	
	//include ('validate_email.php');
	
	
	echo $userpk;
	//header("Location: /home/");

header("Location: /suggestions/thanks.php");
?>
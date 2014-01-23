<?php 
session_start();
	$userpk = $_SESSION['id'];
	
	$query = "SELECT Validation, Email FROM Users WHERE User_PK = '$userpk'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	$code = $row['Validation'];
	$email = $row['Email'];
	
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
	
	if(!$mail->Send())
	{
	echo 'Message could not be sent.';
	echo 'Mailer Error: ' . $mail->ErrorInfo;
	exit;
	}
	
	echo 'Message has been sent';
	include ('validate_email.php');
	
	
	//echo $userpk;
	//header("Location: /home/");
	?>
<?php 

session_start();
require('../../assets/php/globalref/sqlconf.php');
require("../../assets/php/login/header.php");  //this file already has a mysqli_close()

 //Check if they are already logged in, and if so, then send them to home
require('../../assets/php/globalref/sqlconf.php');
 
if (isset($_SESSION['email']))
{
	$user_check = $_SESSION['email'];
	$user_id = $_SESSION['id'];
	$ses_query = mysqli_query($con,"SELECT Email FROM Users WHERE Email = '$user_check'");
	$row = mysqli_fetch_array($ses_query);
	$login_session = $row['Email'];
	if(isset($login_session))
	{
		header("Location: /home/");
	}
}

mysqli_close($con);

?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>Anilum| Login</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/css/custom.css" rel="stylesheet" type="text/css" id="style_color"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons/css/glyphicons.css" rel="stylesheet" />

	<link rel="shortcut icon" href="favicon.ico" />

<style>
#login-box1 {
	position: fixed;
	top: 50%; 
	left: 50%; 
	margin-top: -170px; 
	margin-left: -250px; 
	width: 500px; 
	height: 340px; 
	background: white;
	border: 1px solid gray;
}

#email-error {
	position: relative; left: 5px; top: 7px; color: #B80000; display: none;
}

#password-error {
	position: relative; left: 5px; top: 7px; color: #B80000; display: none;
}

@media screen and (min-width: 400px) and (max-width: 480px) {
	#login-box1 {
	position: fixed; 
	top: 50%; 
	left: 50%; 
	margin-top: -170px; 
	margin-left: -180px; 
	width: 360px; 
	height: 340px; 
	background: white;	
	border: 1px solid gray;
	}
	
	#email {
		display: block;
		margin-left: auto;
		margin-right: auto;
	}
	
	#password {
		display: block;
		margin-left: auto;
		margin-right: auto;
	}
	
	#submit-button {
		text-align: center;
	}
	
	#text-me {
		position: absolute; right: 270px; margin-top: 8px; text-align: center;
	}
	
	#email-error {
		position: absolute; left: 275px; top: 7px; color: #B80000; display: none; vertical-align: top;
	}
	#password-error {
		position: absolute; left: 275px; top: 7px; color: #B80000; display: none; vertical-align: top;
	}

}

.page-full-width
{
	background-image:url('../images/heathe.jpg');
	background-repeat:repeat;
}

</style>


</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-full-width">

	<div id='login-box1' >
		<div style='position: relative;'>
			<form action="php/login.php" id="signup-form" class="form-horizontal" method="POST" onsubmit="return validateForm_login()">
				<h2 style='position: relative; text-align: center; padding-top: 10px; margin-bottom: 0px;'>Sign-In <span style='font-size: 14px;'> Enjoy the social market</span></h2>
				
				<div style="text-align: center; padding-bottom: 12px;">
					<span id="user-password-error" style='position: relative;  text-align: center;color: #B80000; '><i>Incorrect email or password</i></span>
				</div>
				
				<!--<div id='submit-button' class="control-group" >
					<div class="controls">
						<button id='facebook' type="submit" class="btn blue" style='background-color: #3B5998; color: white;'><i class="icon-facebook"></i> &nbsp Login With Facebook</button>
					</div>
				</div> -->
				
				<div class="control-group">
					<label id='text-me' class="control-label">Email</label>
					<div class="controls" style='position: relative;'>
						<input id='email' type="text" placeholder="Email..." class="m-wrap medium" name='email'/>
						<span id="email-error"><i>*</i></span>
					</div>
					
				</div>
				<div class="control-group">
					<label id='text-me' class="control-label text-me">Password</label>
					<div class="controls" style='position: relative;'>
						<input id='password' type="password" placeholder="Password..." class="m-wrap medium" name='password'/>
						<span id="password-error"><i>*</i></span>
					</div>
					
				</div>
				<div id='submit-button' class="control-group" >
					<div class="controls">
						<button  type="submit" class="btn-seafoam"><i class="icon-ok"></i> Login</button>
						<button type='button' onclick="location.href='/'" class='btn-gray'>Cancel</button>
					</div>
				</div>
			</form>
			
			<h5 style='text-align: center; padding-top: 10px;'>New to Anilum?  <a href='/login/signup_page.php'>Create an account!</a></h5>
			<h5 style='text-align: center;'>Forgot your password?  <a href='/login/forgot_page.php'>No worries!</a></h5>
		</div>
	</div>
	
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js"></script>     
	
	<script type="text/javascript" src='js/validate.js'></script>
	
	<script>
		jQuery(document).ready(function() {   
		   // initiate layout and plugins
		   App.init();
		});
	</script>
	<!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>
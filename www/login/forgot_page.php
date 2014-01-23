<?php 

//include('../globalref/php/sqlconf.php');
//include('../globalref/php/sessionstart.php');

session_start();
require('../../assets/php/globalref/sqlconf.php');
require("../../assets/php/login/forgot_page.php"); //this file already has a mysqli_close()

?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>Anilum | Reset Password</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
<!----> <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<!---->	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
<!---->	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<!---->	<link href="../globalref/metronic1.4/admin/template_content/assets/css/style-metro.css" rel="stylesheet" type="text/css"/>
<!---->	<link href="../globalref/metronic1.4/admin/template_content/assets/css/style.css" rel="stylesheet" type="text/css"/>
<!---->	<link href="../globalref/metronic1.4/admin/template_content/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
		<link href="../globalref/css/custom.css" rel="stylesheet" type="text/css" id="style_color"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
	
<style>
#login-box1 {
	position: fixed; 
	top: 50%; 
	left: 50%; 
	margin-top: -170px; 
	margin-left: -250px; 
	width: 500px; 
	height: 210px; 
	background: white;
	border: 1px solid gray;
}

#email-error {
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
	height: 210px; 
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
	
	<div id='login-box1'>
		<div style='position: relative;'>
			<form action="php/forgot.php" id="signup-form" class="form-horizontal" method="POST" onsubmit="return validateForm_forgot()">
				<h2 style='position: relative; text-align: center; padding-top: 13px'>Recovery<span style='font-size: 14px;'> We got your back</span></h2>
				
				<div class="control-group" style='padding-top: 10px; padding-bottom: 10px;'>
					<label id='text-me' class="control-label">Email</label>
					<div class="controls">
						<input id='email' type="text" placeholder="Email..." class="m-wrap medium" name='email'/>
						<span id="email-error"><i>*</i></span>
					</div>
				</div>
				
				<div class="control-group" >
					<div id='submit-button' class="controls">
						<button type="submit" class="btn-seafoam"><i class="icon-ok"></i> Submit</button>
						<button type='button' onclick="location.href='/login/'" class='btn-gray'>Cancel</button>
					</div>
				</div>
			</form>
			
		</div>
	</div>
	
	
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<!--[if lt IE 9]>
	<![endif]-->   
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
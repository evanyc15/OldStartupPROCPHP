<?php 

session_start();
require('../../assets/php/globalref/sqlconf.php');
require("../../assets/php/login/signup_page.php");

?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>Anilum | Signup</title>
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
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/css/custom.css" rel="stylesheet" type="text/css" id="style_color"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />


<style>
#login-box1 {
	position: fixed; 
	top: 50%; 
	left: 50%; 
	margin-top: -280px; 
	margin-left: -250px; 
	width: 500px; 
	height: 560px; 
	background: white;
	border: 1px solid gray;
}

#firstname-error {
	position: relative; left: 5px; top: 7px; color: #B80000; display: none;
}
#lastname-error {
	position: relative; left: 5px; top: 7px; color: #B80000; display: none;
}
#city-error {
	position: relative; left: 5px; top: 7px; color: #B80000; display: none;
}
#state-error {
	position: relative; left: 5px; top: 7px; color: #B80000; display: none;
}
#email-error {
	position: relative; left: 5px; top: 7px; color: #B80000; display: none;
}
#password-error {
	position: relative; left: 5px; top: 7px; color: #B80000; display: none;
}
#re-password-error {
	position: relative; left: 5px; top: 7px; color: #B80000; display: none;
}

@media screen and (min-width: 400px) and (max-width: 480px) {
	#login-box1 {
	position: absolute; 
	top: 50%; 
	left: 50%; 
	margin-top: -280px; 
	margin-left: -180px; 
	width: 360px; 
	height: 560px; 
	background: white;	
	border: 1px solid gray;
	}
	
	#firstname { display: block; margin-left: auto; margin-right: auto; }
	#lastname { display: block; margin-left: auto; margin-right: auto; }
	#city { display: block; margin-left: auto; margin-right: auto; }
	#state { display: block; margin-left: auto; margin-right: auto; }
	#email { display: block; margin-left: auto; margin-right: auto; }
	#password { display: block; margin-left: auto; margin-right: auto; }
	#re-type-password { display: block; margin-left: auto; margin-right: auto; }
	#agree { text-align: center; }
	
	#submit-button {
		text-align: center;
	}
	
	#text-me {
		position: absolute; right: 270px; margin-top: 8px; text-align: center;
	}
	#text-me-2 {
		position: absolute; right: 270px; margin-top: -2px; text-align: center;
	}
	
	#firstname-error {
		position: absolute; left: 275px; top: 7px; color: #B80000; display: none; vertical-align: top;
	}
	#lastname-error {
		position: absolute; left: 275px; top: 7px; color: #B80000; display: none; vertical-align: top;
	}
	#city-error {
		position: absolute; left: 275px; top: 7px; color: #B80000; display: none; vertical-align: top;
	}
	#state-error {
		position: absolute; left: 275px; top: 7px; color: #B80000; display: none; vertical-align: top;
	}
	#email-error {
		position: absolute; left: 275px; top: 7px; color: #B80000; display: none; vertical-align: top;
	}
	#password-error {
		position: absolute; left: 275px; top: 7px; color: #B80000; display: none; vertical-align: top;
	}
	#re-password-error {
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
<body class='page-full-width'>
									
	<div id='login-box1'>
		<div style='position: relative;'>
			
			<form action="php/signup.php" id="signup-form" class="form-horizontal" method="POST" onsubmit="return validateForm_signup()">
				<h2 style='position: relative; text-align: center; padding-top: 13px;'>Sign-Up <span style='font-size: 14px;'>Make sure to fill out every field</span></h2>
				
				<div class="control-group">
					<label id='text-me' class="control-label">First Name</label>
					<div class="controls" style='position: relative;'>
						<input id='firstname' type="text" placeholder="First name..." class="m-wrap medium" name='firstname'/>
						<span id="firstname-error"><i>*</i></span>
					</div>
				</div>
				
				<div class="control-group">
					<label id='text-me' class="control-label">Last Name</label>
					<div class="controls" style='position: relative;'>
						<input id='lastname' type="text" placeholder="Last name..." class="m-wrap medium" name='lastname'/>
						<span id="lastname-error"><i>*</i></span>
					</div>
				</div>
				
				<div class="control-group">
					<label id='text-me' class="control-label">City</label>
					<div class="controls" style='position: relative;'>
						<input id='city' type="text" placeholder="City..." class="m-wrap medium" name='city'/>
						<span id="city-error"><i>*</i></span>
					</div>
				</div>
				
				
				
				<div class="control-group">
					<label id='text-me' class="control-label">State</label>
					<div class="controls" style='position: relative;'>
						<select id="state" name="state" id="select2_sample4" class="medium m-wrap">
							<option value=""></option>
							<option value="AL">Alabama</option>
							<option value="AK">Alaska</option>
							<option value="AZ">Arizona</option>
							<option value="AR">Arkansas</option>
							<option value="CA">California</option>
							<option value="CO">Colorado</option>
							<option value="CT">Connecticut</option>
							<option value="DE">Delaware</option>
							<option value="FL">Florida</option>
							<option value="GA">Georgia</option>
							<option value="HI">Hawaii</option>
							<option value="ID">Idaho</option>
							<option value="IL">Illinois</option>
							<option value="IN">Indiana</option>
							<option value="IA">Iowa</option>
							<option value="KS">Kansas</option>
							<option value="KY">Kentucky</option>
							<option value="LA">Louisiana</option>
							<option value="ME">Maine</option>
							<option value="MD">Maryland</option>
							<option value="MA">Massachusetts</option>
							<option value="MI">Michigan</option>
							<option value="MN">Minnesota</option>
							<option value="MS">Mississippi</option>
							<option value="MO">Missouri</option>
							<option value="MT">Montana</option>
							<option value="NE">Nebraska</option>
							<option value="NV">Nevada</option>
							<option value="NH">New Hampshire</option>
							<option value="NJ">New Jersey</option>
							<option value="NM">New Mexico</option>
							<option value="NY">New York</option>
							<option value="NC">North Carolina</option>
							<option value="ND">North Dakota</option>
							<option value="OH">Ohio</option>
							<option value="OK">Oklahoma</option>
							<option value="OR">Oregon</option>
							<option value="PA">Pennsylvania</option>
							<option value="RI">Rhode Island</option>
							<option value="SC">South Carolina</option>
							<option value="SD">South Dakota</option>
							<option value="TN">Tennessee</option>
							<option value="TX">Texas</option>
							<option value="UT">Utah</option>
							<option value="VT">Vermont</option>
							<option value="VA">Virginia</option>
							<option value="WA">Washington</option>
							<option value="WV">West Virginia</option>
							<option value="WI">Wisconsin</option>
							<option value="WY">Wyoming</option>
						</select>
						<span id="state-error"><i>*</i></span>
					</div>
				</div>
				
				
				<div class="control-group">
					<label id='text-me' class="control-label">Email</label>
					<div class="controls" style='position: relative;'>
						<input id='email' type="text" placeholder="Email..." class="m-wrap medium" name='email'/>
						<span id="email-error"><i>*</i></span>
					</div>
				</div>
				
				<div class="control-group">
					<label id='text-me' class="control-label">Password</label>
					<div class="controls" style='position: relative;'>
						<input id='password' type="password" placeholder="Password..." class="m-wrap medium" name='password'/>
						<span id="password-error"><i>*</i></span>
					</div>
				</div>
				
				<div class="control-group">
					<label id='text-me-2' class="control-label">Re-Type Password</label>
					<div class="controls" style='position: relative;'>
						<input id='re-type-password' type="password" placeholder="Password..." class="m-wrap medium" name='re_password'/>
						<span id="re-password-error"><i>*</i></span>
					</div>
				</div>
				
				<div class="control-group">
					<label id='text-me-2' class="control-label"> <a href='terms.php' >Terms & Conditions</a></label>
					<div id='agree' class="controls">
						<label class="checkbox">
						<input id='checkbox' type="checkbox" value="" />Agree
						</label>
						<span id="checkbox-error" style='position: relative; left: 5px; top: -3px; color: #B80000; display: none;'><i>*</i></span>
					</div>
				</div>
				
				<div class="control-group" >
					<div id='submit-button' class="controls">
						<button type="submit" class="btn-seafoam"><i class="icon-ok"></i>Sign-Up</button>
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
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
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
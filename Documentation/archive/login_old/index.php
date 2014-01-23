<?php 

include('../globalref/php/sqlconf.php');
include('../globalref/php/sessionstart.php');

// Check if they are already logged in, and if so, then send them to home
if (isset($_SESSION['email']))
{
	$user_check = $_SESSION['email'];
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
	<title>Anilum | The Social Market</title>
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
	<link href="../globalref/metronic1.4/admin/template_content/assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2_metro.css" />
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="../globalref/metronic1.4/admin/template_content/assets/css/pages/login-soft.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
	<!-- BEGIN LOGO -->
	<div class="logo">
		<img src="../globalref/metronic1.4/admin/template_content/assets/img/logo-big.png" alt="" /> 
	</div>
	<!-- END LOGO -->
	<!-- BEGIN LOGIN -->
	<div class="content">
		<!-- BEGIN LOGIN FORM -->
		<form class="form-vertical login-form" action="php/login.php" method="post">
			<h3 class="form-title">Enter the Market</h3>
			<?php 
				if(isset($_SESSION['error']))
				{
					if ($_SESSION['error'] == "1")
					{
						echo"<div class='alert alert-error'>"
						."<button class='close' data-dismiss='alert'></button>"
						."<span>Incorrect Password/Email Combination.</span>"
						."</div>";
					}
					else if ($_SESSION['error'] == "2")
					{
						echo"<div class='alert alert-error'>"
								."<button class='close' data-dismiss='alert'></button>"
								."<span>Invalid Email.</span>"
							."</div>";
					}
					$_SESSION['error'] = 0;
				}
			?>
			<div class="alert alert-error hide">
				<button class="close" data-dismiss="alert"></button>
				<span>Enter email and password.</span>
			</div>
			<div class="control-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">Username</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-user"></i>
						<input class="m-wrap placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">Password</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-lock"></i>
						<input class="m-wrap placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
					</div>
				</div>
			</div>
			<div class="form-actions">
				<label class="checkbox">
				<input type="checkbox" name="remember" value="1"/> Remember me
				</label>
				<button type="submit" class="btn blue pull-right">
				Login <i class="m-icon-swapright m-icon-white"></i>
				</button>            
			</div>
			<div class="forget-password">
				<h4>Forgot your password ?</h4>
				<p>
					no worries, click <a href="javascript:;"  id="forget-password">here</a>
					to reset your password.
				</p>
			</div>
			<div class="create-account">
				<p>
					Don't have an account yet ?&nbsp; 
					<a href="javascript:;" id="register-btn" >Create an account</a>
				</p>
			</div>
		</form>
		<!-- END LOGIN FORM -->        
		<!-- BEGIN FORGOT PASSWORD FORM -->
		<form class="form-vertical forget-form" action="index.html" method="post">
			<h3 >Forget Password ?</h3>
			<p>Enter your e-mail address below to reset your password.</p>
			<div class="control-group">
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-envelope"></i>
						<input class="m-wrap placeholder-no-fix" type="text" placeholder="Email" autocomplete="off" name="email" />
					</div>
				</div>
			</div>
			<div class="form-actions">
				<button type="button" id="back-btn" class="btn">
				<i class="m-icon-swapleft"></i> Back
				</button>
				<button type="submit" class="btn blue pull-right">
				Submit <i class="m-icon-swapright m-icon-white"></i>
				</button>            
			</div>
		</form>
		<!-- END FORGOT PASSWORD FORM -->
		<!-- BEGIN REGISTRATION FORM -->
		<form class="form-vertical register-form" action="index.html" method="post">
			<h3 >Sign Up</h3>
			<p>Enter your personal details below:</p>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">First Name</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-font"></i>
						<input class="m-wrap placeholder-no-fix" type="text" placeholder="First Name" name="firstName"/>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">Last Name</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-ok"></i>
						<input class="m-wrap placeholder-no-fix" type="text" placeholder="Last Name" name="lastName"/>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">City</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-location-arrow"></i>
						<input class="m-wrap placeholder-no-fix" type="text" placeholder="City" name="city"/>
					</div>
				</div>
			</div>
			<div class="control-group">
				<div class="row-fluid">
					<label class="control-label visible-ie8 visible-ie9">State</label>
					<div class="controls">
						<select name="state" id="select2_sample4" class="span12 select2">
							<option value=""></option>
							<option value="">Alabama</option>
							<option value="">Alaska</option>
							<option value="">Arizona</option>
							<option value="">Arkansas</option>
							<option value="">California</option>
							<option value="">Colorado</option>
							<option value="">Connecticut</option>
							<option value="">Delaware</option>
							<option value="">Florida</option>
							<option value="">Georgia</option>
							<option value="">Hawaii</option>
							<option value="">Idaho</option>
							<option value="">Illinois</option>
							<option value="">Indiana</option>
							<option value="">Iowa</option>
							<option value="">Kansas</option>
							<option value="">Kentucky</option>
							<option value="">Louisiana</option>
							<option value="">Maine</option>
							<option value="">Maryland</option>
							<option value="">Massachusetts</option>
							<option value="">Michigan</option>
							<option value="">Minnesota</option>
							<option value="">Mississippi</option>
							<option value="">Missouri</option>
							<option value="">Montana</option>
							<option value="">Nebraska</option>
							<option value="">Nevada</option>
							<option value="">New Hampshire</option>
							<option value="">New Jersey</option>
							<option value="">New Mexico</option>
							<option value="">New York</option>
							<option value="">North Carolina</option>
							<option value="">North Dakota</option>
							<option value="">Ohio</option>
							<option value="">Oklahoma</option>
							<option value="">Oregon</option>
							<option value="">Pennsylvania</option>
							<option value="">Rhode Island</option>
							<option value="">South Carolina</option>
							<option value="">South Dakota</option>
							<option value="">Tennessee</option>
							<option value="">Texas</option>
							<option value="">Utah</option>
							<option value="">Vermont</option>
							<option value="">Virginia</option>
							<option value="">Washington</option>
							<option value="">West Virginia</option>
							<option value="">Wisconsin</option>
							<option value="">Wyoming</option>
						</select>
					</div>
				</div>
			</div>
			<p>Enter your account details below:</p>
			<div class="control-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">Email</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-envelope"></i>
						<input class="m-wrap placeholder-no-fix" type="text" placeholder="Email" name="email"/>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">Password</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-lock"></i>
						<input class="m-wrap placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password"/>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-ok"></i>
						<input class="m-wrap placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword"/>
					</div>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<label class="checkbox">
					<input type="checkbox" name="tnc"/> I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
					</label>  
					<div id="register_tnc_error"></div>
				</div>
			</div>
			<div class="form-actions">
				<button id="register-back-btn" type="button" class="btn">
				<i class="m-icon-swapleft"></i>  Back
				</button>
				<button type="submit" id="register-submit-btn" class="btn green pull-right">
				Sign Up <i class="m-icon-swapright m-icon-white"></i>
				</button>            
			</div>
		</form>
		<!-- END REGISTRATION FORM -->
	</div>
	<!-- END LOGIN -->
	<!-- BEGIN COPYRIGHT -->
	<div class="copyright">
		2013 &copy; Anilum - The Social Market.
	</div>
	<!-- END COPYRIGHT -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->  
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
	<!--[if lt IE 9]>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/excanvas.min.js"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/respond.min.js"></script>  
	<![endif]-->   
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
	<!--<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>-->
	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2.min.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js" type="text/javascript"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/login-soft.js" type="text/javascript"></script>      
	<!-- END PAGE LEVEL SCRIPTS --> 
	<script>
		jQuery(document).ready(function() {     
		  App.init();
		  Login.init();
		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
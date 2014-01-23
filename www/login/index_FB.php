<?php 

//include('../globalref/php/sqlconf.php');
//include('../globalref/php/sessionstart.php');
require("../../assets/php/globalref/sessionstart.php");
require('../../assets/php/globalref/sqlconf.php');
require("../../assets/php/login/index_FB.php");
//mysqli_close($con);

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
	<link href="../globalref/metronic1.4/admin/template_content/assets/css/pages/login.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
	<div id="fb-root"></div>
	<script>
	  	window.fbAsyncInit = function() 
	  	{
	    		FB.init({
	      			appId      : '650030508341988', // Set YOUR APP ID
	      			channelUrl : 'localhost/login/channel.html', // Channel File
	      			status     : true, // check login status
	      			cookie     : true, // enable cookies to allow the server to access the session
	      			xfbml      : true // parse XFBML
	    		});
	 
	    	/*FB.Event.subscribe('auth.authResponseChange', function(response) 
	    	{
	    		console.log("Authorization Change");
	     		if (response.status === 'connected') 
	    		{
	        		console.log("Connected to FaceBook");
	        		//SUCCESS
	 			}    
	    		else if (response.status === 'not_authorized') 
	    		{
	        		console.log("Logged into Facebook but not us");
	        		FacebookLogin();
	 				//FAILED
	    		} 
	    		else 
	    		{
	        		console.log("Logged out of both");
	        		FacebookLogin();
	        		//UNKNOWN ERROR
	    		}
	    	}); */
	    };	 
	    function checkLoginStatus()
	    {
	    	FB.getLoginStatus(function(response)
	    	{
	    		if(response.status == 'connected')
	    		{	
	    			window.location = 'test.php';
	    		}
	    		else if(response.status == 'not_authorized')
	    		{
	    			FacebookLogin();
	    			//window.location = 'test.php';
	    		}
	    		else
	    		{
	    			FacebookLogin();
	    		}
	    	});
	    }
	    function FacebookLogin()
	    {
	        FB.login(function(response) 
	        {
	            if (response.authResponse) 
	            {
	            	//console.log(response.authResponse);
	                //getUserInfo(); //KEEEEEP
	                window.location = "test.php";
	            } 
	            else 
	            {
	            	console.log('User cancelled login or did not fully authorize.');
	            }
	        },{scope: 'email,user_birthday,read_friendlists'});
	    }
	 
	  	/*function getUserInfo() 
	  	{
	  		var user_info = new Object();
			FB.api('/me/',function(response)
			{
				user_info.user_id = response.id;
				user_info.email = response.email;
				user_info.firstName = response.first_name;

				user_info.lastName = response.last_name;
				user_info.gender = (response.gender[0] == 'm') ? 'M' : 'F';

				user_info.birthday = response.birthday;
				var locationSplit = response.location['name'].split(', ');
				user_info.city = locationSplit[0];
				user_info.state = locationSplit[1];

				FB.api('/me/?fields=picture.type(large)',function(response)
				{
					user_info.picture = response.picture.data.url;
					/*$.ajax(
	    			{
		    			type: 'GET',
		    			url: 'php/fb_login.php',
		    			data: {fb: JSON.stringify(user_info)},
		    			success: function(response)
		    			{
		    				window.location = "../../home/";
		    			}
	    			});
	    		});

			});
	    }*/
	  	// Load the SDK asynchronously
	  	(function(d){
	    	var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
	    	if (d.getElementById(id)) {return;}
	    	js = d.createElement('script'); js.id = id; js.async = true;
	    	js.src = "//connect.facebook.net/en_US/all.js";
	    	ref.parentNode.insertBefore(js, ref);
	    }(document));
 
	</script>
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
			<button type="button" onclick="FB.logout()">Logout</button>
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
					<!--<fb:login-button show-faces="true" width="200" max-rows="1" onclick="FacebookLogin()"></fb:login-button>-->
				</p>
			</div>
			<hr>
				<button type="button" onclick="checkLoginStatus()" style="margin-left:auto;margin-right:auto;">Login</button>
		</form>
		<!-- END LOGIN FORM -->        
		<!-- BEGIN FORGOT PASSWORD FORM -->
		<form class="form-vertical forget-form" action="php/forgot.php" method="post">
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
		<form action="php/signup.php" id="signup-form" method="POST" class="form-vertical register-form"  onsubmit="return validateForm_login()">
			<h3 >Sign Up</h3>
			<p>Enter your personal details below:</p>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">First Name</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-font"></i>
						<input id="firstname" class="m-wrap placeholder-no-fix" type="text" placeholder="First Name" name="firstName"/>
					</div>
					<div>
						<h6 id="firstname-error" style="color: #B80000; display: none;">This field must be filled out</h6>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">Last Name</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-ok"></i>
						<input id="lastname" class="m-wrap placeholder-no-fix" type="text" placeholder="Last Name" name="lastName"/>
					</div>
					<div>
						<h6 id="lastname-error" style="color: #B80000; display: none;">This field must be filled out</h6>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">City</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-location-arrow"></i>
						<input id="city" class="m-wrap placeholder-no-fix" type="text" placeholder="City" name="city"/>
					</div>
					<div>
						<h6 id="city-error" style="color: #B80000; display: none;">This field must be filled out</h6>
					</div>
				</div>
			</div>
			<div class="control-group">
				<div class="row-fluid">
					<label class="control-label visible-ie8 visible-ie9">State</label>
					<div class="controls">
						<select id="state" name="country" id="select2_sample4" class="span12 select2">
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
					</div>
					<div>
						<h6 id="state-error" style="color: #B80000; display: none;">You must select a state</h6>
					</div>
				</div>
			</div>
			<p>Enter your account details below:</p>
			<div class="control-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">Email</label>
				<div class="controls" id="emailField">
					<div class="input-icon left">
						<i class="icon-envelope"></i>
						<input id="emailInput" class="m-wrap placeholder-no-fix" type="text" placeholder="Email" name="email"/>
					</div>
					<div>
						<h6 id="email-error" style="color: #B80000; display: none;">This field must be filled out with a valid email</h6>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">Password</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-lock"></i>
						<input id="password" class="m-wrap placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password"/>
					</div>
					<div>
						<h6 id="password-error" style="color: #B80000; display: none;">This field must be filled out</h6>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-ok"></i>
						<input class="m-wrap placeholder-no-fix" id="re-type-password" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword"/>
					</div>
					<div>
						<h6 id="re-password-error" style="color: #B80000; display: none;">This field must match the previous field</h6
					</div>
					<div>
						<h6 id="re-password-approve" style="color: green; display: none;">Passwords match!</h6
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
				<button id="register-back-btn-no-fb" type="button" class="btn">
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
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-2.0.3.js" type="text/javascript"></script>
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
	<!-- <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-validation/dist/jquery.validate.test.js" type="text/javascript"></script> -->
	<!--<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>-->
	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2.min.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script type='text/javascript' src='https://cdn.firebase.com/v0/firebase.js'></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js" type="text/javascript"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/login-fb.js" type="text/javascript"></script>
	
	<script type='text/javascript' src='js/validate.js'></script>
	<script src="js/initFirebase.js" type="text/javascript"></script>      
	<!-- END PAGE LEVEL SCRIPTS --> 
	<script>
		jQuery(document).ready(function() {     
		  App.init();
		  Login.init();
		 $(' #signup-form').validate();
		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
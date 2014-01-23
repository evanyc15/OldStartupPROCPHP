
<?php 

//include('../globalref/php/sqlconf.php');
//include('../globalref/php/sessionstart.php');
//require("../assets/php/globalref/sessionstart.php");
session_start();
require('../assets/php/globalref/sqlconf.php');
require("../assets/php/login/signup_page.php"); //this file already has a mysqli_close() 

?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>Social Market | Welcome</title>
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
<!---->	<link href="globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<!---->	<link href="globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
<!---->	<link href="globalref/metronic1.4/admin/template_content/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<!---->	<link href="globalref/metronic1.4/admin/template_content/assets/css/style.css" rel="stylesheet" type="text/css"/>
<!---->	<link href="globalref/metronic1.4/admin/template_content/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	
	<link href="globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons/css/glyphicons.css" rel="stylesheet" />

	<link rel="shortcut icon" href="favicon.ico" />

<style>

.btn-1{
	border: none;
	font-family: helvetica;
	background-color: #3B5998; 
	color: white;
	padding: 7px 17px 7px 17px;
}
.btn-1:hover {
	background-color : #2f4779;
}

.btn-2{
	border: none;
	font-family: helvetica;
	background-color: #B0B0B0; 
	color: black;
	padding: 7px 17px 7px 17px;
}
.btn-2:hover {
	background-color : #A0A0A0;
}

		.tutorial-box {
	   		display: block;
	   		margin-left: auto;
			margin-right: auto;
			height: 410px; 
			width: 700px;
			background-color: #73b3ac;
	   }
	   

	   .inner-box {
	   		z-index: 10;
	   		position: relative;
			left: 2px;
			height: 357px; 
			width: 696px;
			background-color: white;
	   }

	   .title-1 {
	   		font-size: 22px;
	   		color: white;
	   		text-align: center;
	   		padding: 14px 0px 7px 0px;
	   }




</style>


</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body style='background-color: white;'>
	<!-- BEGIN HEADER -->   
	<!-- END HEADER -->
	<!-- BEGIN CONTAINER -->
	
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
	 
	    };	 
	    function checkLoginStatus()
	    {
	    	FB.getLoginStatus(function(response)
	    	{
	    		if(response.status == 'connected')
	    		{	
	    			window.location = 'test_FB.php';
	    		}
	    		else if(response.status == 'not_authorized')
	    		{
	    			FacebookLogin();
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
	                window.location = "test_FB.php";
	            } 
	            else 
	            {
	            	console.log('User cancelled login or did not fully authorize.');
	            }
	        },{scope: 'email,user_birthday,read_friendlists'});
	    }
	 
	  	
	  	// Load the SDK asynchronously
	  	(function(d){
	    	var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
	    	if (d.getElementById(id)) {return;}
	    	js = d.createElement('script'); js.id = id; js.async = true;
	    	js.src = "//connect.facebook.net/en_US/all.js";
	    	ref.parentNode.insertBefore(js, ref);
	    }(document));
 
	</script>
	
	
	
	
	
	
	
	
	
		<div style='background-color: white; padding-bottom: 5px; padding-top: 1px;'>
			<h1 style='display: block; color: black; position: relative; text-align: center; padding-top: 15px; margin-bottom: 0px; margin-left: auto; margin-right: auto'>Welcome to the Social Market</h1>
			<div id='' style='text-align: center; margin-top: 20px;  margin-bottom: 13px;' class="control-group" >
				<div class="controls">
					<a href='/login/test_FB.php'><button id='facebook' type="submit" onclick="checkLoginStatus()" class="btn-1"><i class="icon-facebook"></i> &nbsp Sign up With Facebook</button></a>
					<a href='/login/signup_page.php'><button  class='btn-2' onclick="checkLoginStatus()"><i class="icon-ok"></i> Sign up with email</button></a>
				</div>
			</div>
			
			<p style='text-align: center; padding-top: 10px; color: black; font-size: 14px;'>Already have an account?  <a href='/login/' style='color: red;' >Sign in!</a></p>
			
			<!--<div id='pic-div' style='background-color: #eee; border: 1px solid lightgray;'>
				<div ></div>
			</div> -->   <!-- DO NOT DELETE THIS COMMENT!  IT IS IMPORTANT TO INCLUDE THE VIDEO -->
		</div>

		<img src='images/logoblack.jpg' style='height: 400px; width: 400px; display: block; margin-left: auto; margin-right: auto;'>
		 <!--	<div id='box-1' class='tutorial-box'>
		 		<p class='title-1'>Welcome to the family!</p>
		 		<div class='inner-box'>
		 			
		 		</div>
		 	</div> -->  <!-- DO NOT DELETE THIS COMMENT!  IT IS IMPORTANT TO INCLUDE THE VIDEO -->
	
	
	
	
	
	
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<!--[if lt IE 9]>
	<script src="assets/plugins/excanvas.min.js"></script>
	<script src="assets/plugins/respond.min.js"></script>  
	<![endif]-->   
	<!-- END CORE PLUGINS -->
	
	<script type='text/javascript' src='https://cdn.firebase.com/v0/firebase.js'></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js" type="text/javascript"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/login-fb.js" type="text/javascript"></script>
	
	<script src="login/js/initFirebase.js" type="text/javascript"></script>   
	
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
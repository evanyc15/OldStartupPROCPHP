<?php 
require '../../assets/php/globalref/sqlconf.php';
require '../../assets/php/retrieve/header.php';
//mysqli_close($con);
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>Anilum | Set New Password</title>
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
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="../globalref/metronic1.4/admin/template_content/assets/css/pages/lock.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
	
	<style>
    	.center-cropped { 
    	width: 190px; 
    	height: 190px; 
    	background-position: center center; 
    	background-size: cover;
    	background-repeat: no-repeat; 
    	background-image: url("<?php echo 'php/image_proxy.php?image=' . $ProfilePicture;?>");
    	border-style:solid black;
    	display:inline-block;
    	}
    </style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body>
	<div class="page-lock">
		<div class="page-logo">
			<!--<a class="brand" href="index.html">-->
			<!--  <img src="../globalref/metronic1.4/admin/template_content/assets/img/logo-big.png" alt="logo" />-->
			<!--</a>-->
		</div>
		<div class="page-body">
			<div class="page-lock-img center-cropped">
			</div>
			<!-- <img class="page-lock-img" src="../globalref/metronic1.4/admin/template_content/assets/img/profile/profile.jpg" alt=""> -->
			<div class="page-lock-info" style="display:inline-block;margin-top:20px">
				<h1>Set New Password</h1>
				<span><?php echo $row['FirstName']." ".$row['LastName']; ?></span>
				<span><em> </em></span>
				<form class="form-search" action="php/newpassword.php" method="post">
					<div class="input-append">
							<input type="password" class="m-wrap" placeholder="New Password">
					</div>
					<div class="input-append">
						<input type="password" class="m-wrap" placeholder="Confirm New Password" name="password">
						<button type="submit" class="btn blue icn-only"><i class="m-icon-swapright m-icon-white"></i></button>
					</div>
				</form>
			</div>
		</div>
		<div class="page-footer">
			2013 &copy; Anilum.
		</div>
	</div>
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
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS -->   
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js"></script>  
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/lock.js"></script>      
	<script>
		jQuery(document).ready(function() {    
		   App.init();
		   Lock.init();
		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
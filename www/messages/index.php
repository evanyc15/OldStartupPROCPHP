<?php
	session_start();
	require("../../assets/php/globalref/sqlconf.php");
	require("../../assets/php/globalref/lock.php");
	//mysqli_close($con);
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<script type="text/javascript">
		<?php
			$userchat = null;
			if(isset($_GET['user'])){
				$userchat = $_GET['user'];
			}
			echo "var userchat = '".$userchat. "';";
			echo "var session= '".$_SESSION['id']. "';";
		?>
	</script>
	<meta charset="utf-8" />
	<title>Anilum - Messages</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- Styling for your grid blocks -->
   <!--<link href="../globalref/css/reset.css" rel="stylesheet" type="text/css"/>-->
   <link href="../globalref/css/main.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/css/style-metro.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/css/custom.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
   <!-- END GLOBAL MANDATORY STYLES -->
   <!-- BEGIN PAGE LEVEL STYLES --> 
    <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons/css/glyphicons.css" rel="stylesheet" />
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons_halflings/css/halflings.css" rel="stylesheet" /> 
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<!-- BEGIN:File Upload Plugin CSS files-->
	<!-- END:File Upload Plugin CSS files-->     
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2_metro.css" />
	<link href="../globalref/metronic1.4/admin/template_content/assets/css/pages/inbox.css" rel="stylesheet" type="text/css" />
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
	<style>
		.personImg
		{
			width:30px;
			height:30px;
			display:inline-block;
			margin-right:10px;
		}
		.personText
		{
			display:inline-block;
		}
	</style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-sidebar-fixed page-full-width">
	<!-- BEGIN HEADER -->   
	<?php 
		ob_start();
		include("../globalref/header/index.php");
		ob_end_flush();
	?><!--HEADER-->
	<!-- END HEADER -->
	<!-- BEGIN CONTAINER -->   
	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
		<?//php include("../globalref/sidebar/index.php");?> <!--SIDEBAR-->
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>Widget Settings</h3>
				</div>
				<div class="modal-body">
					Widget settings form goes here
				</div>
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE CONTAINER-->
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN STYLE CUSTOMIZER -->
						<div class="color-panel hidden-phone">
							<div class="color-mode-icons icon-color"></div>
							<div class="color-mode-icons icon-color-close"></div>
							<div class="color-mode">
								<p>THEME COLOR</p>
								<ul class="inline">
									<li class="color-black current color-default" data-style="default"></li>
									<li class="color-blue" data-style="blue"></li>
									<li class="color-brown" data-style="brown"></li>
									<li class="color-purple" data-style="purple"></li>
									<li class="color-grey" data-style="grey"></li>
									<li class="color-white color-light" data-style="light"></li>
								</ul>
								<label>
									<span>Layout</span>
									<select class="layout-option m-wrap small">
										<option value="fluid" selected>Fluid</option>
										<option value="boxed">Boxed</option>
									</select>
								</label>
								<label>
									<span>Header</span>
									<select class="header-option m-wrap small">
										<option value="fixed" selected>Fixed</option>
										<option value="default">Default</option>
									</select>
								</label>
								<label>
									<span>Sidebar</span>
									<select class="sidebar-option m-wrap small">
										<option value="fixed">Fixed</option>
										<option value="default" selected>Default</option>
									</select>
								</label>
								<label>
									<span>Footer</span>
									<select class="footer-option m-wrap small">
										<option value="fixed">Fixed</option>
										<option value="default" selected>Default</option>
									</select>
								</label>
							</div>
						</div>
						<!-- END BEGIN STYLE CUSTOMIZER -->    
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<div style="visibility:hidden;">spacer</div>
						<div style="visibility:hidden;">spacer</div>
						<h3 class="page-title">
							Messages <small>Chat with your friends below!</small>
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="index.html">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="#">Messages</a></li>
							<li class="pull-right no-text-shadow">
								<div id="dashboard-report-range" class="dashboard-date-range tooltips no-tooltip-on-touch-device responsive" data-tablet="" data-desktop="tooltips" data-placement="top" data-original-title="Change dashboard date range">
									<i class="icon-calendar"></i>
									<span></span>
									<i class="icon-angle-down"></i>
								</div>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
					<div class="clearfix"></div>
					<div class="row-fluid">	
						<div class="span2">		
							<div class="portlet paddingless">
								<div class="portlet-title line">
									<div class="caption"><i class="icon-group"></i>Friends</div>
								</div>
								<div class="portlet-body">
										<div class="tabbable tabbable-custom tabbable-full-width">
											<ul class="nav nav-tabs">
												<!-- <li class="active"><a data-toggle="tab" href="#tab_1_5">User Search </a></li> -->
											</ul>
											<div id="tab_1_5" class="tab-pane">
												<form action="" method="GET">
													<div class="control-group">
														<label class="control-label">Search</label>
														<div class="controls">
															<input type="hidden" id="select2-sample2" class="span6 select2" value="">
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
							</div>
						</div>
						<div class="span10">
							<!-- BEGIN PORTLET-->
							<div class="portlet">
								<div class="portlet-title line">
									<div class="caption"><i class="icon-comments"></i>Chats</div>
								</div>
								<div class="portlet-body" id="chats">
									<div class="scroller" style="height:435px" data-always-visible="1" data-rail-visible1="1">
										<ul class="chats" id="message-box">
											<li class="in" id="message-list" style="visibility:hidden;">
												<img class="avatar" alt="" src="" />
												<div class="message">
													<span class="arrow"></span>
													<a href="" class="name"></a>
													<span class="datetime"></span>
													<span class="body"></span>
												</div>
											</li>
											<li class="in" id="message-from" style="visibility:hidden;">
												<img class="avatar" alt="" src="" />
												<div class="message">
													<span class="arrow"></span>
													<a href="#" class="name"></a>
													<span class="datetime"></span>
													<span class="body"></span>
												</div>
											</li>
											<li class="out" id="message-to" style="visibility:hidden;">
												<img class="avatar" alt="" src="" />
												<div class="message">
													<span class="arrow"></span>
													<a href="#" class="name"></a>
													<span class="datetime"></span>
													<span class="body"></span>
												</div>
											</li>
										</ul>
									</div>
									<div class="chat-form">
										<div class="input-cont">   
											<form id="input-form">
												<input id="input-message" class="m-wrap" type="text" placeholder="Type a message here..." />
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- END PORTLET-->
						</div>
					</div>
				</div>
			</div>
			<!-- Starts Here-->
			
			<!-- END PAGE CONTAINER-->    
		</div>
		<!-- END PAGE -->
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		<div class="footer-inner">
			2013 &copy; Metronic by keenthemes.
		</div>
		<div class="footer-tools">
			<span class="go-top">
			<i class="icon-angle-up"></i>
			</span>
		</div>
	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
	<!--[if lt IE 9]>
	<script src="assets/plugins/excanvas.min.js"></script>
	<script src="assets/plugins/respond.min.js"></script>  
	<![endif]-->   
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-tag/js/bootstrap-tag.js" type="text/javascript" ></script> 
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript" ></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript" ></script> 
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript" ></script>
	<!-- BEGIN:File Upload Plugin JS files-->
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
	<!-- The Templates plugin is included to render the upload/download listings -->
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-file-upload/js/vendor/tmpl.min.js" type="text/javascript"></script>
	<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-file-upload/js/vendor/load-image.min.js" type="text/javascript"></script>
	<!-- The Canvas to Blob plugin is included for image resizing functionality -->
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js" type="text/javascript"></script>
	<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
	<!-- The basic File Upload plugin -->
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
	<!-- The File Upload file processing plugin -->
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-file-upload/js/jquery.fileupload-fp.js" type="text/javascript"></script>
	<!-- The File Upload user interface plugin -->
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>
	<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
	<!--[if gte IE 8]><script src="assets/plugins/jquery-file-upload/js/cors/jquery.xdr-transport.js"></script><![endif]-->
	<!-- END:File Upload Plugin JS files-->
	<!-- END PAGE LEVEL PLUGINS -->
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js" type="text/javascript"></script>      
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/inbox.js" type="text/javascript"></script>  
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/index.js" type="text/javascript"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/tasks.js" type="text/javascript"></script>
	<script src='https://cdn.firebase.com/v0/firebase.js' type="text/javascript"></script>      
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/search.js" type="text/javascript"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-tags-input/jquery.tagsinput.min.js" type="text/javascript" ></script>       
    <script src="../globalref/header/js/notifications.js" type="text/javascript"></script>
    <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2.js" type="text/javascript"></script>
    <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/form-components.js" type="text/javascript"></script>
    <script src="js/friends.js" type="text/javascript"></script>  
    <script src="/globalref/header/js/messages.js" type="text/javascript"></script>
	<script>
		jQuery(document).ready(function() {       
		   // initiate layout and plugins
		   App.init();
		   Inbox.init();
		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
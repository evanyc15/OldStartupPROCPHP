<?php

	session_start();
	require('../../assets/php/globalref/sqlconf.php');
	require('../../assets/php/globalref/lock.php');
	require("../../assets/php/globalref/get_user_info.php");
	//require("../../assets/php/preferences/header.php");
	//mysqli_close($con);
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
   <title>Anilum</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <!-- BEGIN GLOBAL MANDATORY STYLES -->
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/css/style-metro.css" rel="stylesheet" type="text/css" />
   <link href="../globalref/css/style.css" rel="stylesheet" type="text/css" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/css/style-responsive.css" rel="stylesheet" type="text/css" />
   <link href="../globalref/css/custom.css" rel="stylesheet" type="text/css" id="style_color" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
   <!-- END GLOBAL MANDATORY STYLES -->
   <!-- BEGIN PAGE LEVEL STYLES --> 
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons/css/glyphicons.css" rel="stylesheet" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons_halflings/css/halflings.css" rel="stylesheet" />
   <!-- END PAGE LEVEL STYLES -->
   <link rel="shortcut icon" href="favicon.ico" />
</head>
<body class="page-header-fixed page-boxed">
		<!-- BEGIN HEADER -->   
	<?php 
	ob_start();
	require("../globalref/header/index.php");
	ob_end_flush();
	?><!--HEADER-->
	<!-- END HEADER -->
	<div class="container">
		<!-- BEGIN CONTAINER -->  
		<div class="page-container row-fluid">
			<!-- BEGIN SIDEBAR -->
			<?php require("../globalref/sidebar/index.php");?> <!--SIDEBAR-->
			<!-- END SIDEBAR -->
			<!-- BEGIN PAGE -->
			<div class="page-content">
				<!-- BEGIN PAGE CONTAINER-->
				<div class="container-fluid">
					<!-- BEGIN PAGE HEADER-->
					<div class="row-fluid">
						<div class="span12">
							<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
							Suggest Ideas and Report Bugs <small>help us make Anilum into your dream site</small>
						</h3>
						<ul class="breadcrumb">
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
						</div>
					</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<!-- ***************************************************************** -->  
						<!-- BEGIN SAMPLE FORM PORTLET--> 
							<div class="portlet box tabbable" style="border: solid 1px #73b3ac;background:#73b3ac;">
								<div class="portlet-title">
									<div class="caption">
										<i class="icon-reorder"></i>
										<span class="hidden-480">Talk to Us</span>
									</div>
								</div>
								<div class="portlet-body form">
									<div class="tabbable portlet-tabs">
										<ul class="nav nav-tabs">
											<li class="active"><a href="#portlet_tab1" data-toggle="tab">Suggest and Report</a></li>
										</ul>
										<div class="tab-content">
											<!-- This is tab number 1 -->
											<div class="tab-pane active" id="portlet_tab1">
												<!-- BEGIN FORM-->
												<form action="php/update_suggestion.php" id="suggest" name="suggestion" method="POST" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validateForm_sell()">
													<div class="control-group">
														<label class="control-label">Message:</label>
														<div class="controls" style="">
															<div class="large m-wrap" style="">
																<textarea id="suggestion-input" class="large m-wrap" name="suggestion" maxlength="350" placeholder="Help us shape our website into something great..." rows="3" style="resize: none; height: 125px; width: 350px;"></textarea>
															</div>
															<div id="charnum"></div>
														</div>
													</div>
													
													<div class="form-actions">
														<button id="submit-button" type="submit" class="btn-seafoam"><i class="icon-ok"></i> Submit</button>
														<button type="button" class="btn-gray">Cancel</button>
														<i id="description-error" style="display: inline-block; padding-left: 13px; color: red;"></i>
													</div>
												</form>
												<!-- END FORM-->  
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- END SAMPLE FORM PORTLET-->
							<!-- ************************************************************ -->
					</div>
				</div>
				<!-- END PAGE CONTENT-->
					
				</div>
				<!-- END PAGE CONTAINER--> 
			</div>
			<!-- END PAGE -->          
		</div>
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		<div class="container">
			<div class="footer-inner">
				2013 &copy; Anilum.
			</div>
			<div class="footer-tools">
				<span class="go-top">
				<i class="icon-angle-up"></i>
				</span>
			</div>
		</div>
	</div>
	<!-- END FOOTER -->
   
   <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
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
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script type='text/javascript' src='https://cdn.firebase.com/v0/firebase.js'></script>
   <!--<script type="text/javascript" src="js/search.js"></script>-->
   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js" type="text/javascript"></script>           
   <script src="../globalref/header/js/notifications.js" type="text/javascript"></script>
   <script src="../globalref/underscore.js" type="text/javascript"></script>
   <!-- END PAGE LEVEL SCRIPTS -->  
   <script type="text/javascript">
		function performClick(node) 
		{
				var evt = document.createEvent("MouseEvents");
				evt.initEvent("click", true, false);
				node.dispatchEvent(evt);
		}
   </script>
   <script>
      jQuery(document).ready(function() {    
         App.init(); // initlayout and core plugins    
     /* CHARACTER COUNT */      
         var text_max = 350;
		    $('#charnum').html(text_max + ' characters remaining');
		    $('#suggestion-input').keyup(function() {
		        var text_length = $('#suggestion-input').val().length;
		        var text_remaining = text_max - text_length;
		        $('#charnum').html(text_remaining + ' characters remaining');
		    });
      });
   </script>
  <!-- END JAVASCRIPTS -->
</body>
</html>
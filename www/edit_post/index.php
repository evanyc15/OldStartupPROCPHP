<?php
	session_start();
	require('../../assets/php/globalref/sqlconf.php');
	require('../../assets/php/globalref/lock.php');
	require("../../assets/php/globalref/get_user_info.php");
	require('../../assets/php/edit_post/header.php');
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
   <link href="../globalref/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/css/style-responsive.css" rel="stylesheet" type="text/css" />
   <link href="../globalref/css/custom.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
   <!-- END GLOBAL MANDATORY STYLES -->
   <!-- BEGIN PAGE LEVEL STYLES --> 
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons/css/glyphicons.css" rel="stylesheet" type="text/css" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons_halflings/css/halflings.css" rel="stylesheet" type="text/css" /> 
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
								Edit<small></small>
							</h3>
							
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
										<span class="hidden-480">Update Your Stuff</span>
									</div>
								</div>
								<div class="portlet-body form">
									<div class="tabbable portlet-tabs">
										<ul class="nav nav-tabs">
											<li class="active"><a href="#portlet_tab3" data-toggle="tab">Edit</a></li>
											<!--  <li><a href="#portlet_tab2" data-toggle="tab">Grid</a></li>
											<li class="active"><a href="#portlet_tab1" data-toggle="tab">Sell</a></li>-->
										</ul>
										<div class="tab-content">
											<!-- This is tab number 1 -->
											<div class="tab-pane active" id="portlet_tab1">
												<!-- BEGIN FORM-->
												<form action="php/update_post.php?pid=<?php echo $post_id; ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
													<div class="control-group">
														<label class="control-label">Title</label>
														<div class="controls">
															<input type="text" maxlength="50" name="subject" value="<?php echo $subject; ?>" placeholder="Make sure to put a '$' in front of your price" class="m-wrap large" />
															<span class="help-inline"></span> <!-- you can add some text next to the text box! -->
														</div>
													</div>
													
													<div class="control-group">
														<label class="control-label">Description</label>
														<div class="controls">
															<textarea class="large m-wrap" name="description" maxlength="350" placeholder="Tell consumers about the item being sold" rows="3" style="resize: none; height: 125px;"><?php echo $description; ?></textarea>
														</div>
													</div>
													<div class="control-group">
														<div class="controls">
														</div>
													</div>
													<div class="form-actions">
														<button type="submit" class="btn-seafoam"><i class="icon-ok"></i>Submit</button>
														<a href="javascript:history.back();"><button type="button" class="btn-gray">Cancel</button></a>
													</div>
												</form>
												<!-- END FORM-->  
											</div>
											
											
											<!-- BEGIN TAB 2 -->
											<div class="tab-pane " id="portlet_tab2">
	
											</div>
											<!-- END TAB 2 -->
											
											
											<!-- BEGIN TAB 3 -->
											<div class="tab-pane " id="portlet_tab3">
												
											</div>
											<!-- END TAB 3-->
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
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2.min.js"></script>
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/moment.min.js"></script>
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery.mockjax.js"></script>
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable-sell.js"></script>
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-editable/inputs-ext/address/address-sell.js"></script>
   <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfPt4vsT3rkjaX3Z4VMuLLmfFy6gH7dto&sensor=false"></script>-->
   <!-- END PAGE LEVEL PLUGINS -->
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/index.js" type="text/javascript"></script> 
   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/form-editable-sell.js"></script>    
   <script type='text/javascript' src='https://cdn.firebase.com/v0/firebase.js'></script>          
   <script src="../globalref/header/js/notifications.js" type="text/javascript"></script>   
   <!-- END PAGE LEVEL SCRIPTS -->  
   <script type="text/javascript">
	   jQuery(document).ready(function()
	   {    
	         App.init(); // initlayout and core plugins
	         FormEditable.init();
	   });
   </script>
  <!-- END JAVASCRIPTS -->
</body>
</html>
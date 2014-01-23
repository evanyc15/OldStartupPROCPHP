
<?php
session_start();
require('../../assets/php/globalref/sqlconf.php');
require("../../assets/php/globalref/get_user_info.php");

	
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
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/css/style-metro.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/css/themes/custom.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
   <!-- END GLOBAL MANDATORY STYLES -->
   <!-- BEGIN PAGE LEVEL STYLES --> 
	 <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons/css/glyphicons.css" rel="stylesheet" />
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons_halflings/css/halflings.css" rel="stylesheet" /> 
	
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2_metro.css" />
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-datepicker/css/datepicker.css" />
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-timepicker/compiled/timepicker.css" />
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css" />

	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css"/>
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-editable/inputs-ext/address/address.css"/>

   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
   <!--<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" media="screen"/>-->
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
   
   
  <link href='../globalref/mentions-input/jquery.mentionsInput.css' rel='stylesheet' type='text/css'>
   <!-- END PAGE LEVEL STYLES -->
   <link rel="shortcut icon" href="favicon.ico" />
</head>
<body class="page-sidebar-fixed">
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
		<?php include("../globalref/sidebar/index.php");?> <!--SIDEBAR-->
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN PAGE CONTAINER-->
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<br/><br/>
						<h3 class="page-title">
							Confirmation <small>your email has been sent</small>
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
							<h2 style="text-align: center;">Thanks for the input!</h2>
							<h3 style="text-align: center;">We look forward to reading your email</h3>
							<h4 style="text-align: center;">Back to <a href="/browse/">Marketplace</a></h4>
							<!-- END SAMPLE FORM PORTLET-->
							<!-- ************************************************************ -->
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
			<!-- END PAGE CONTAINER-->  <!--PUT STUFF HERE-->
		</div>
		<!-- END PAGE -->    
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		<div class="footer-inner">
			2013 &copy; Anilum.
		</div>
		<div class="footer-tools">
			<span class="go-top">
			<i class="icon-angle-up"></i>
			</span>
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
   <!-- BEGIN PAGE LEVEL PLUGINS -->
   <!--<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>   
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>-->  
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2.min.js"></script>
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/moment.min.js"></script>
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery.mockjax.js"></script>
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable-sell.js"></script>
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-editable/inputs-ext/address/address-sell.js"></script>
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js"></script>  

   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-daterangepicker/date.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>     
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script>  
   <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7nRARc0Uc_tE_KYtcZe-58Bl7lCC36k4&sensor=false"></script>
   <!-- END PAGE LEVEL PLUGINS -->
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script type='text/javascript' src='https://cdn.firebase.com/v0/firebase.js'></script>
   <script type="text/javascript" src="js/search.js"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/form-editable-sell.js"></script>            
   <script src="../globalref/header/js/notifications.js" type="text/javascript"></script>
   
   <script src="js/validate.js" type="text/javascript"></script>
   
	<script src="../globalref/underscore.js" type="text/javascript"></script>
	<!--<script src='lib/jquery.events.input.js' type='text/javascript'></script>-->
	<script src='../globalref/mentions-input/lib/jquery.elastic.js' type='text/javascript'></script>
	<script src='../globalref/mentions-input/jquery.mentionsInput.js' type='text/javascript'></script>
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
         Index.init();
         FormEditable.init();
         Index.initDashboardDaterange();
         Index.initIntro();
         getPosition();
    
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
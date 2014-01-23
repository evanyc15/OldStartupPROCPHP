<?php
	require("../globalref/php/get_user_info.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
   <title>Metronic | Admin Dashboard Template</title>
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
   <!-- END PAGE LEVEL STYLES -->
   <link rel="shortcut icon" href="favicon.ico" />
</head>
<body class="page-sidebar-fixed">
	<!-- BEGIN HEADER -->   
	<?php include("../globalref/header/backup.php");?><!--HEADER-->
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
							Sell Your Stuff <small>one man's junk is another man's treasure</small>
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
							<div class="portlet box blue tabbable">
								<div class="portlet-title">
									<div class="caption">
										<i class="icon-reorder"></i>
										<span class="hidden-480">Sell Your Stuff</span>
									</div>
								</div>
								<div class="portlet-body form">
									<div class="tabbable portlet-tabs">
										<ul class="nav nav-tabs">
											<li><a href="#portlet_tab3" data-toggle="tab">Inline</a></li>
											<li><a href="#portlet_tab2" data-toggle="tab">Grid</a></li>
											<li class="active"><a href="#portlet_tab1" data-toggle="tab">Sell</a></li>
										</ul>
										<div class="tab-content">
											
											
											<!-- This is tab number 1 -->
											<div class="tab-pane active" id="portlet_tab1">
												<!-- BEGIN FORM-->
												<form action="upload_sell.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
													<div class="control-group">
														<label class="control-label">Title</label>
														<div class="controls">
															<input type="text" maxlength="80" name="subject" placeholder="Make sure to put a '$' in front of your price" class="m-wrap large" />
															<span class="help-inline"></span> <!-- you can add some text next to the text box! -->
														</div>
													</div>
													
													<div class="control-group">
														<label class="control-label">Description</label>
														<div class="controls">
															<textarea class="large m-wrap" name="description" maxlength="350" placeholder="Tell consumers about the item being sold" rows="3" style="resize: none; height: 125px;"></textarea>
														</div>
													</div>
													
													<div class="control-group">
														<div class="controls">
															<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
															<input  type="file" name="file[]" multiple/>
															<a href="#" class="glyphicons no-js camera" style="margin-bottom:5px;"><i></i></a>
															<a href="#" id="address" data-type="address" data-original-title="Please, fill address"><i></i></a>
															<input type="hidden" value="" name="address" id="sellerAddress" />
														</div>
													</div>
													
	
													<div class="form-actions">
														<button type="submit" class="btn blue"><i class="icon-ok"></i> Submit</button>
														<button type="button" class="btn">Cancel</button>
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
						</form>
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
   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/index.js" type="text/javascript"></script> 
   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/form-editable-sell.js"></script>       
   <!-- END PAGE LEVEL SCRIPTS -->  
   <script>
	   	function getPosition()
		{

			if(navigator.geolocation)
			{
	   			navigator.geolocation.getCurrentPosition(success,failure);
	    	}
	   		else
	    	{
				alert("Your browser doesn't support geolocation!");
	    	}
	    }

	    function success(location)
		{

			var address = new google.maps.LatLng(location.coords.latitude,location.coords.longitude);
			geocode(address);
		}

		function failure(error)
		{
			alert("Could not find your location!");
		}

		function geocode(latLng)
		{
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode({
			"location": latLng
			},
			function(results,status)
			{
				if(status == google.maps.GeocoderStatus.OK)
				{
					if(results[0])
					{
						var state = "";
						var city = "";

						for(var i=0;i < results[0].address_components.length;i++)
						{
							var addr = results[0].address_components[i];

							if(addr.types[0] == ['administrative_area_level_1'])
							{
								state = addr.long_name;
							}
							else if(addr.types[0] == ['locality'])
							{
								city = addr.long_name;
							}
						}
						document.getElementById("address").innerHTML = city + ', ' + state;
						document.getElementById("sellerAddress").value = city + ', ' + state;
					}
				}
				else
				{
					document.getElementById("location").innerHTML = "N/A";
				}
			});
		}  
      jQuery(document).ready(function() {    
         App.init(); // initlayout and core plugins
         Index.init();
         //Index.initJQVMAP(); // init index page's custom scripts
         //Index.initCalendar(); // init index page's custom scripts
         //Index.initCharts(); // init index page's custom scripts
         //Index.initChat();
         //Index.initMiniCharts();
         FormEditable.init();
         Index.initDashboardDaterange();
         Index.initIntro();
         getPosition();
      });

   </script>

  <!-- END JAVASCRIPTS -->
</body>
</html>
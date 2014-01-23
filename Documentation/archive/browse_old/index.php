<?php
	require("../globalref/php/lock.php");
	require("../globalref/php/sqlconf.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
   <title>Anilum Marketplace</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <!-- BEGIN GLOBAL MANDATORY STYLES -->
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <!-- CSS Reset -->
   <link rel="stylesheet" href="css/reset.css">
   <!-- Styling for your grid blocks -->
   <link href="../globalref/css/reset.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/css/main.css" rel="stylesheet" type="text/css"/>
   <link rel="stylesheet" href="../globalref/css/colorbox.css" />
   <link href="css/style.css" rel="stylesheet" type="text/css"/>
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
   
   <link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css" />
   <link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/chosen-bootstrap/chosen/chosen.css" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
   <link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/clockface/css/clockface.css" />
    <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2_metro.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-datepicker/css/datepicker.css" />
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-timepicker/compiled/timepicker.css" />
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-colorpicker/css/colorpicker.css" />
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" />
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
   <!--<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" media="screen"/>-->
   <link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css"/>
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-editable/inputs-ext/address/address.css"/>

   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
   <!--<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" media="screen"/>-->
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
   <!-- **********************************************SELECT2 IMPLEMENTATION**************************************** -->
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
   <link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-multi-select/css/multi-select-metro.css" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css" rel="stylesheet" type="text/css"/>
   <link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-tags-input/jquery.tagsinput.css" />
   <link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/fancybox/source/jquery.fancybox.css" />
<!-- **********************************************SELECT2 IMPLEMENTATION**************************************** -->
    <!-- **********************************************SELECT2 IMPLEMENTATION**************************************** -->  
   <!-- END PAGE LEVEL STYLES -->
   <link rel="shortcut icon" href="favicon.ico" />
</head>
<body class="page-sidebar-fixed page-sidebar-closed">
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
							@AnilumMarketplace <small>goldrush the market</small>
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
						<!-- BEGIN FORM-->
						<div class="row-fluid">
							<div class="span6" >
								<form action="" method="POST" enctype="multipart/form-data" id="searchtags">
									<div class="control-group">
										<label class="control-label">Search by Tags</label>
										<div class="controls">
											<input type="text" id="tags" class="m-wrap span12 select2" multiple>
										</div>
									</div>
								</form>
							</div>
							<!--/span-->
							<!--<div class="span6">
								<form action="" method="POST" enctype="multipart/form-data" id="searchall">
									<div class="control-group">
										<label class="control-label">Search All</label>
										<div class="controls">
											<input type="text" id="searchall" class="m-wrap span12" multiple>
										</div>
									</div>
								</form>
							</div>-->
							<!--/span-->
						</div>
						<hr/>
						<!-- END FORM-->  
						<div id="container" style="z-index:0;padding-top:0px;margin-top:-11px; padding:0px 0px 0px 0px;">
							<img id="load-spinner" src="../images/ajaxSpinner.gif">
						    <div id="main" role="main" style="padding:0px 0px 0px 0px;">
						      <ul id="tiles" style="">
						      	<div style="visibility:hidden;">shove</div>
						        <!-- These are our grid blocks -->
						        <li class="span3" id="picture-boxes" style="">
									<div class="item" style="margin-bottom:4px;">
										<a id="fancybox-out" class="fancybox-button" data-rel="fancybox-button" title="Photo" href="">
											<div class="zoom">
												<img src="" alt="Photo" />                    
												<div class="zoom-icon" style="background-color:#73b3ac;"></div>
											</div>
										</a>
										<div class="details" style="background-color:#73b3ac;">
											<a href="#" class="icon"><i class="icon-paper-clip" style="color:#fff;"></i></a>
											<a href="#" class="icon"><i class="icon-link" style="color:#fff;"></i></a>
											<a href="#" class="icon"><i class="icon-pencil" style="color:#fff;"></i></a>   
										</div>
										<h5 id="tile-subject"></h5>
										<img id="tile-image" src="">
										<h9 id="tile-name"></h9>
					        			<h9 id="tile-loc"></h9>
									</div>
								</li>
						      </ul>
						    </div>
						</div>
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
   <script type="text/javascript" src="../globalref/js/jquery.imagesloaded.js"></script>
   <script type="text/javascript" src="../globalref/js/jquery.wookmark.min.js"></script>
   <script type="text/javascript" src="../globalref/js/jquery.colorbox-min.js"></script>
    <script type='text/javascript' src='https://cdn.firebase.com/v0/firebase.js'></script>
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
   
   
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/ckeditor/ckeditor.js"></script>  
	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/clockface/js/clockface.js"></script>
	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-daterangepicker/date.js"></script>
	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script> 
	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>  
	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>   
	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>   
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript" ></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript" ></script> 
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery.pwstrength.bootstrap/src/pwstrength.js" type="text/javascript" ></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-switch/static/js/bootstrap-switch.js" type="text/javascript" ></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-tags-input/jquery.tagsinput.min.js" type="text/javascript" ></script>

  
  <!-- END CORE PLUGINS -->
   <!-- BEGIN PAGE LEVEL PLUGINS -->
   <!--<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>   
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>-->  
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-daterangepicker/date.js" type="text/javascript"></script>    
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/fancybox/source/jquery.fancybox.js" type="text/javascript"></script>
   <!-- END PAGE LEVEL PLUGINS -->
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/index.js" type="text/javascript"></script>        
   <script src="../globalref/header/js/notifications.js" type="text/javascript"></script>
   <!-- END PAGE LEVEL SCRIPTS -->  
   <!-- **********************************************SELECT2 IMPLEMENTATION**************************************** -->
	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
	<!-- **********************************************SELECT2 IMPLEMENTATION**************************************** -->
	   
	    <!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	   
	    <!-- **********************************************SELECT2 IMPLEMENTATION**************************************** -->
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/form-components.js"></script>    
	<!-- **********************************************SELECT2 IMPLEMENTATION**************************************** -->
   <script>
   //Globally defining the wookmark reapply layout so that browse.js can use it
   		function applyLayout(){
	        var handler = $('#tiles li');
	         var options = {
	          autoResize: true, // This will auto-update the layout when the browser window is resized.
	          container: $('#main'), // Optional, used for some extra CSS styling
	          offset: 5, // Optional, the distance between grid items
	          outerOffset: 10, // Optional, the distance to the containers border
	          itemWidth: 210 // Optional, the width of a grid item
	        };
	        
	    	// Destroy the old handler
	        if (handler.wookmarkInstance) {
	          handler.wookmarkInstance.clear();
	        }
	         // Create a new layout handler.
	        handler = $('#tiles li');
	        handler.wookmark(options);
	    }
  
      jQuery(document).ready(function() {    
         App.init(); // initlayout and core plugins
         Index.init();
         //Index.initJQVMAP(); // init index page's custom scripts
         //Index.initCalendar(); // init index page's custom scripts
         //Index.initCharts(); // init index page's custom scripts
         //Index.initChat();
         //Index.initMiniCharts();
         Index.initDashboardDaterange();
         Index.initIntro();
         $('#fancybox-out').fancybox();
      });
   </script>
   <!-- Once the page is loaded, initalize the plug-in. -->
  <script type="text/javascript">
    (function ($){
      $('#tiles').imagesLoaded(function() {
        // Prepare layout options.
        var $tile_pic = $('#picture-boxes').clone(true,true);
        var options = {
          autoResize: true, // This will auto-update the layout when the browser window is resized.
          container: $('#main'), // Optional, used for some extra CSS styling
          offset: 5, // Optional, the distance between grid items
          outerOffset: 10, // Optional, the distance to the containers border
          itemWidth: 210 // Optional, the width of a grid item
        };
        


        // Get a reference to your grid items.
        var handler = $('#tiles li');
        
        $('#tags').on('change',function(){
        	// Destroy the old handler
            if (handler.wookmarkInstance) {
              handler.wookmarkInstance.clear();
            }
             // Create a new layout handler.
            handler = $('#tiles li');
            handler.wookmark(options);
        });
        
        function onScroll(event) {
          // Check if we're within 100 pixels of the bottom edge of the broser window.
          var winHeight = window.innerHeight ? window.innerHeight : $(window).height(); // iphone fix
          var closeToBottom = ($(window).scrollTop() + winHeight > $(document).height() - 100);

          if (closeToBottom) {

            // Destroy the old handler
            if (handler.wookmarkInstance) {
              handler.wookmarkInstance.clear();
            }

            // Create a new layout handler.
            handler = $('#tiles li');
            handler.wookmark(options);
          }
        };

        // Capture scroll event.
        $(window).bind('scroll', onScroll);

        // Call the layout function.
        handler.wookmark(options);
      });
    })(jQuery);
  </script>
   <script type="text/javascript" src="js/browse.js"></script>
</body>
</html>
<?php
	require("../globalref/php/lock.php");
	require("../globalref/php/sqlconf.php");
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
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <!-- CSS Reset -->
   <link rel="stylesheet" href="css/reset.css">
   <!-- Styling for your grid blocks -->
   <link rel="stylesheet" href="../globalref/css/colorbox.css" />
   <link href="css/style.css" rel="stylesheet" type="text/css"/>
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
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
   <!--<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" media="screen"/>-->
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
   <!-- END PAGE LEVEL STYLES -->
   <link rel="shortcut icon" href="favicon.ico" />
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
   <script type='text/javascript' src='https://cdn.firebase.com/v0/firebase.js'></script>
   <script type="text/javascript" src="../globalref/js/jquery.wookmark.min.js"></script>
   <script src="js/populate.js" type="text/javascript"></script>
   <script type="text/javascript" src="../globalref/js/jquery.colorbox-min.js"></script>
   <script type="text/javascript" src="../globalref/js/jquery.imagesloaded.js"></script>
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
				<div class="button-more">
					<button class="btn blue btn-block">See More... 
						<i class="m-icon-swapright m-icon-white">
						</i>
					</button>
				</div>
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
						<div id="container">
							<div id="hidden-num" style="display:none;"></div>
						    <div id="main" role="main">
						      <ul id="tiles">
						        <!-- These are our grid blocks -->
						        <li id="pic-tiles"><a class="to-colorbox" href=""><img id="click-img" src="" alt=""></a></li>
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
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
   <!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
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
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-daterangepicker/date.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>     
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script>  
   <!-- END PAGE LEVEL PLUGINS -->
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/index.js" type="text/javascript"></script>        
   <script src="../globalref/header/js/notifications.js" type="text/javascript"></script>
   <!-- END PAGE LEVEL SCRIPTS -->  
   <script>
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
      });
   </script>
   <script type="text/javascript">
    (function ($){
      $('#tiles').imagesLoaded(function() {
        var handler = null;

        // Prepare layout options.
        var options = {
          autoResize: true, // This will auto-update the layout when the browser window is resized.
          container: $('#main'), // Optional, used for some extra CSS styling
          offset: 2, // Optional, the distance between grid items
          itemWidth: 210 // Optional, the width of a grid item
        };

        /**
         * When scrolled all the way to the bottom, add more tiles.
         */
        function onScroll(event) {
          // Check if we're within 100 pixels of the bottom edge of the broser window.
          var winHeight = window.innerHeight ? window.innerHeight : $(window).height(); // iphone fix
          var closeToBottom = ($(window).scrollTop() + winHeight > $(document).height() - 100);

          if (closeToBottom) {
            // Get the first then items from the grid, clone them, and add them to the bottom of the grid.
            var items = $('#tiles li'),
                firstTen = items.slice(0, 10);
            $('#tiles').append(firstTen.clone(true,true));

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
        handler = $('#tiles li');
        handler.wookmark(options);
     
  
          
      });
    })(jQuery);
    
    
 </script>
  <!-- END JAVASCRIPTS -->
</body>
</html>
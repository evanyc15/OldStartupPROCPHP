<?php 
//include "../globalref/header/index.php";
include("../globalref/php/get_user_info.php");
?>


<!-- CONNER CHECKING BACK IN!  -->



<!DOCTYPE html>
<html>
<head>
	<title>Post to Anilum</title>
	<link rel="stylesheet" href="style.css" type="text/css">
	
	<!-- 1 -->
	<link rel="stylesheet" href="css/dropzone.css" type="text/css"/>

 	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
    <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="../globalref/metronic1.4/admin/template_content/assets/css/style-metro.css" rel="stylesheet" type="text/css"/>
    <link href="../globalref/metronic1.4/admin/template_content/assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../globalref/metronic1.4/admin/template_content/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
    <link href="../globalref/metronic1.4/admin/template_content/assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- 2 -->
	<script src="dropzone.min.js"></script>
	<script type="text/javascript" src="../globalref/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6xFFfMa5j9j7XiDM_vX1JGupQrrvqprk&sensor=false"></script>
	<script type="text/javascript">
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

					document.getElementById("location").value = city + ',' + state;
				}
			}
			else
			{
				document.getElementById("location").innerHTML = "N/A";
			}
		});
	}
	window.onload = getPosition;
	</script>

</head>
<body class="page-sidebar-fixed">
	<script>
		$(document).ready(function() {
		    var text_max = 350;
		    $('#charnum').html(text_max + ' characters remaining');
		    $('#chars').keyup(function() {
		        var text_length = $('#chars').val().length;
		        var text_remaining = text_max - text_length;
		        $('#charnum').html(text_remaining + ' characters remaining');
		    });
		});
	</script>
	
	<script>
			$(function(){
				$(".border-box,#chars,#book_3,.description").autosize({append: "\n"});
			});
	</script>
	<?php include("../globalref/header/backup.php");?>

	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
		<?php include("../globalref/sidebar/index.php");?> <!--SIDEBAR-->
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>portlet Settings</h3>
				</div>
				<div class="modal-body">
					<p>Here will be a configuration form</p>
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
						<br/><br/>
						<h3 class="page-title">
							Post to Anilum <small>blank page</small>
						</h3>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<form action="image_upload.php" method="POST" enctype="multipart/form-data">
							<div class="border-box">
								<table id="table">
									<img id="book_1" src="../globalref/images/signup_bowtie.png"/>
									<img id="book_2" src="../globalref/images/signup_bowtie.png"/>
									<tr>
										<td id="subject-row">
											<input type="text" id="subject" maxlength="80" name="subject" placeholder="What are you selling?" value="Shoes">
										</td>

										<td id="second">
											<input type="number" name="price" min="0" id="price" maxlength="9" placeholder="$" value="15">
										</td>
									</tr>	
								</table>
							<div id="spacer"></div>
							<div class="description">
								<div>
									<img id="book_3"src="../globalref/images/signup_bowtie.png"/>
									<textarea name="description" id="chars" maxlength="350" placeholder="Describe your item. Let us help you advertise with hashtags!">This is my item</textarea>
									<div id="charnum"></div>
								</div>
							</div>
							<div id="spacer"></div>
								<table id="table2">
									<img id="book_4"src="../globalref/images/signup_bowtie.png"/>
									<img id="book_5"src="../globalref/images/signup_bowtie.png"/>
									<tr>
										<td id="first">
											<input type="text" name="location" id="location" maxlength="25" placeholder="City, State"/>
										</td>
										
										<td id="second">
											<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
											<input type="file" name="file[]" multiple/>
											<!--<input type="file" name="file"/>-->
										</td>
									</tr>
								</table>
							</div>
							<input id="submit-all" type="submit" name="submit"/>	
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
	<!--<form action="image_upload.php" class="dropzone" id="myAwesomeDropzone"></form>
	<script>
	Dropzone.options.myAwesomeDropzone = 
	{
		maxFilesize: 10,
  		autoProcessQueue: true, //Prevents Dropzone from uploading dropped files immediately
		acceptedFiles: "image/gif,image/jpeg,image/jpg,image/pjpeg,image/x-png,image/png",
		addRemoveLinks: true,
		dictFileTooBig: "File is too big!",
		dictResponseError: "Could not upload to server!",
		dictInvalidFileType: "That is the wrong type of file!",	
  		init: function() 
  		{
    		var submitButton = document.getElementById("submit-all");
        	//myDropzone = this; // closure

    		submitButton.addEventListener("click", function() 
    		{
      			myAwesomeDropzone.processQueue(); // Tell Dropzone to process all queued files.
    		});

    		// You might want to show the submit button only when 
    		// files are dropped here:
    		//this.on("addedfile", function() {
      		// Show submit button here and/or inform user to click it.
    		//})
    	}
    };
	</script>-->
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
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

   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/index.js" type="text/javascript"></script>        
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
</body>
</html>
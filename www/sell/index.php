<?php
	session_start();
	//require('../../assets/php/globalref/lock.php');
	require('../../assets/php/globalref/sqlconf.php');
	require('../../assets/php/globalref/lock.php');
	require("../../assets/php/globalref/get_user_info.php");
if($newUser == 1)
{
	require("../../assets/php/globalref/tutorials.php");
	if($tutorialCount >= 5)
		updateNewUser($user_id_Tut, $con);
} //if
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
   <link href="../globalref/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/css/custom.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
   <!-- END GLOBAL MANDATORY STYLES -->
   <!-- BEGIN PAGE LEVEL STYLES --> 
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons/css/glyphicons.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons_halflings/css/halflings.css" rel="stylesheet" type="text/css"/> 
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2_metro.css" rel="stylesheet" type="text/css" />
   <link href='../globalref/mentions-input/jquery.mentionsInput.css' rel='stylesheet' type='text/css'>
   <!-- END PAGE LEVEL STYLES -->
   <link rel="shortcut icon" href="favicon.ico" />
   <link href="../globalref/css/tutorial.css" rel="stylesheet" type="text/css"/>

   <style>
	   .successStyle
	   {
	   		display:inline-block;
	   		margin:7px 0px 0px 25px;
	   		color: green;
	   }
	   .errorStyle
	   {
	   		display:inline-block;
	   		margin:7px 0px 0px 25px;
	   		color:#B80000;
	   }
   </style>
</head>
<body class="page-header-fixed page-boxed">
	<!-- BEGIN HEADER -->   
	<?php 
	ob_start();
	include("../globalref/header/index.php");
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
							Sell Your Stuff <small>one man's junk is another man's treasure</small>
						</h3>
						<ul
							class="breadcrumb">
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


						<?php
						if($newUser == 1 && $sellTutorial == 1)
						{
							echo "<div class='blackout'></div>";
							echo 	"<div id='box-1' class='tutorial-box'>";
							echo 			"<p class='title-1'>Making the Money</p>";
							echo 		"<div class='inner-box'>";
							echo 			"<p class='body-text'>Our site helps you safely sell used stuff so that you can make some extra cash.  Use a \"<b>Cashtag '$'</b>\" for the price in the Title and use \"<b>Hashtags '#'</b>\" in the Description to help others find your post.  Remember, your trash is another's treasure!</p>";
							echo 			"<p class='signature'>Create a post and start making the bucks!</p>";
							echo 			"<div>";
							echo 				"<button id='button-1' class='btn-seafoam bottom-right' style='z-index: 11;'><i class='icon-check'></i> Got It!</button>";
							echo 			"</div>";
							echo 		"</div>";
							echo 	"</div>";
							echo	"<div id='alert' class='alert alert-info' style='font-size: 15px;'>";
							echo		"<button class='close' data-dismiss='alert'></button>";
							echo		"<strong>Help us sell your item!</strong> Write a concise title and description and make sure to uplaod clear, flattering pictures...";
							echo	"</div>";
						} //if
					?>



							<div class="portlet box tabbable" style="border: solid 1px #73b3ac;background:#73b3ac;">
								<div class="portlet-title">
									<div class="caption">
										<i class="icon-reorder"></i>
										<span class="hidden-480">Sell Your Stuff</span>
									</div>
								</div>
								<div class="portlet-body form">
									<div class="tabbable portlet-tabs">
										<ul class="nav nav-tabs">
											<!-- <li><a href="#portlet_tab3" data-toggle="tab">Inline</a></li>
											<li><a href="#portlet_tab2" data-toggle="tab">Status</a></li> -->
											<li class="active"><a href="#portlet_tab1" data-toggle="tab">Sell</a></li>
										</ul>
										<div class="tab-content">
											<!-- This is tab number 1 -->
											<div class="tab-pane active" id="portlet_tab1">
												<!-- BEGIN FORM-->
												<form action="php/upload_sell.php" id="sell" method="POST" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validateForm_sell()">
													<div class="control-group">
														<label class="control-label">Title</label>
														<div class="controls">
															<input id="subject-input" type="text" maxlength="50" name="subject" placeholder="Title and Price" class="m-wrap large" />
															<i id="title-error" style="display: inline-block; padding-left: 9px; padding-top: 7px; color: #B80000;"></i>
															<span class="help-inline"></span> <!-- you can add some text next to the text box! -->
															<!-- Hello ! -->
														</div>
													</div>
													
													<div class="control-group">
														<label class="control-label">Description</label>
														<div class="controls" style="">
															<div class="large m-wrap" style="">
																<textarea id="description-input" class="m-wrap large" name="description" maxlength="350" placeholder="Tell consumers about your item..." rows="3" style="resize: none; height: 125px; width: 320px;"></textarea>
															</div>
															<div id="charnum"></div>
														</div>
													</div>
													<div class="control-group" style="margin-top:-20px;">
														<div class="controls">
															<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
															<a href="#" class="glyphicons no-js camera" onclick="performClick(document.getElementById('theFile'));"><i></i></a>
															<!--<a href="#" class="glyphicons no-js google_maps" id=""><i></i></a>NEED TO IMPLEMENT http://jsfiddle.net/tt9MC/
																																					http://jsfiddle.net/UGWWA/2/-->
															<a href="#" id="address" data-type="address" data-original-title="Please, fill address"><i></i></a>
															<input type="hidden" value="" name="address" id="sellerAddress" />
															<input type="hidden" value="" name="latitude" id="latitude"/>
															<input type="hidden" value="" name="longitude" id="longitude"/>
															<input type="file" id="theFile" name="file[]" style="position:fixed;top:-1000px" multiple/>
															<i id="location-error" style="display: inline-block; padding-left: 9px; padding-top: 7px; color: #B80000;"></i>
														</div>
													</div>
													<div class="form-actions">
														<button id="submit-button" type="submit" class="btn-seafoam"><i class="icon-ok"></i> Submit</button>
														<button type="button" class="btn-gray">Cancel</button>
														<i id="description-error" style="display: inline-block; padding-left: 13px; color: #B80000;"></i>
													</div>
												</form>
												<!-- END FORM-->  
												
											</div>
											
											
											<!-- BEGIN TAB 2 -->
											<!-- <div class="tab-pane " id="portlet_tab2">
												<form action="upload_sell.php" id="sell" method="POST" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validateForm_status()">
													<div class="control-group">
														<label class="control-label">Status</label>
														<div class="controls">
															<textarea id="description-input2" class="large m-wrap" name="description" maxlength="350" placeholder="Make a status to communicate with sellers..." rows="3" style="resize: none; height: 100px;"></textarea>
															<i id="description-error2" style="display: inline-block; padding-left: 9px; padding-top: 7px; color: red;"></i>
															<div id="charnum2"></div>
														</div>
													</div>
													<div class="control-group">
														<div class="controls">
															<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
															<a href="#" class="glyphicons no-js camera" onclick="performClick(document.getElementById('theFile'));"><i></i></a>
															<a href="#" id="address" data-type="address" data-original-title="Please, fill address"><i></i></a>
															<input type="hidden" value="" name="address" id="sellerAddress" />
															<input type="hidden" value="" name="latitude" id="latitude"/>
															<input type="hidden" value="" name="longitude" id="longitude"/>
															<input type="file" id="theFile" name="file[]" style="position:fixed;top:-1000px" multiple/>
															<i id="location-error" style="display: inline-block; padding-left: 9px; padding-top: 7px; color: red;"></i>
														</div>
													</div>
													<div class="form-actions">
														<button id="submit-button" type="submit" class="btn blue"><i class="icon-ok"></i>Submit</button>
														<button type="button" class="btn">Cancel</button>
													</div>
												</form>
											</div> -->
											<!-- END TAB 2 -->
											
											
											<!-- BEGIN TAB 3 -->
											<!-- <div class="tab-pane " id="portlet_tab3">
												
											</div> -->
											<!-- END TAB 3-->
											
										</div>
									</div>
								</div>
							</div>
							<!-- END SAMPLE FORM PORTLET-->
							<!-- ************************************************************ -->
												<?php
												require('../../assets/php/globalref/sqlconf.php');
												if($newUser == 1  && $sellTutorial == 1)
												{
													updateTutorials("SellTutorial", $user_id_Tut, $con);
													tutorialCounter($user_id_Tut, $tutorialCount, $con);
													
													echo	"<div id='alert-2' class='alert alert-info' style='font-size: 15px;'>";
													echo		"<button class='close' data-dismiss='alert'></button>";
													echo		"<strong>Next,</strong> lets check out the <a href='/browse/?type=browse' style='color: #B80000;'>Marketplace</a>!</strong>";
													echo	"</div>";

													
												} //if
												mysqli_close($con);
												?>
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
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2.min.js"></script>
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery.mockjax.js"></script>
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable-sell.js"></script>
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-editable/inputs-ext/address/address-sell.js"></script>
   <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfPt4vsT3rkjaX3Z4VMuLLmfFy6gH7dto&sensor=false"></script>
   <!-- END PAGE LEVEL PLUGINS -->
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script type='text/javascript' src='https://cdn.firebase.com/v0/firebase.js'></script>
   <script type="text/javascript" src="js/search.js"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/form-editable-sell.js"></script>            
   <script src="../globalref/header/js/notifications.js" type="text/javascript"></script>
   
   <script src="js/validate.js" type="text/javascript"></script>
   <script src="js/geolocation.js" type="text/javascript"></script>
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
         //Index.init();
         //Index.initJQVMAP(); // init index page's custom scripts
         //Index.initCalendar(); // init index page's custom scripts
         //Index.initCharts(); // init index page's custom scripts
         //Index.initChat();
         //Index.initMiniCharts();
         FormEditable.init();
         //Index.initDashboardDaterange();
         //Index.initIntro();
         getPosition();




        $('#box-2').hide();
		$('#alert').hide();
		$('#alert-2').hide();
		
		$('#button-1').live('click', function(){
				$('#box-1').slideUp('slow');
				$('.blackout').fadeOut(1500);
				$('#alert').fadeIn(2500);	
				$('#alert-2').fadeIn(2500);			
			});

				
    
     /* CHARACTER COUNT */
       
         var text_max = 350;
		    $('#charnum').html(text_max + ' characters remaining');
		    $('#description-input').keyup(function() {
		        var text_length = $('#description-input').val().length;
		        var text_remaining = text_max - text_length;
		        $('#charnum').html(text_remaining + ' characters remaining');
		    });
    
    	var text_max = 350;
		    $('#charnum2').html(text_max + ' characters remaining');
		    $('#description-input2').keyup(function() {
		        var text_length = $('#description-input2').val().length;
		        var text_remaining = text_max - text_length;
		        $('#charnum2').html(text_remaining + ' characters remaining');
		    });
      });
   </script>
   
   <script> //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& THIS SCRIPT IS WHY THE TEXTAREA DOES NOT MATCH THE INPUT LABEL!!!!!
		$('#description-input').mentionsInput({
		  onDataRequest:function (mode, query, callback)
		  {
		    $.ajax(
		    {
		    	type: 'GET',
		    	url: 'php/get_mentions.php',
		    	dataType: 'json',
		    	data: {input: query},
		    	success: function(response)
		    	{
		   			callback.call(this, response);
		    	}
		    });
	
		  }
		});
   </script>
  <!-- END JAVASCRIPTS -->
</body>
</html>
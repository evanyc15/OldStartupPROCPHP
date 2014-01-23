<?php
	session_start();
	require ("../../assets/php/globalref/sqlconf.php");
	require('../../assets/php/globalref/lock.php');	
	require("../../assets/php/globalref/get_user_info.php");
	if($newUser == 1)
	{
		require("../../assets/php/globalref/tutorials.php");
		echo "HELLO $ifNewUser";
		if($tutorialCount >= 5)
			updateNewUser($user_id_Tut, $con);
	} //if
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
   <title>Anilum | Interests</title>
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
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons/css/glyphicons.css" rel="stylesheet" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons_halflings/css/halflings.css" rel="stylesheet" /> 
   <!-- **********************************************SELECT2 IMPLEMENTATION**************************************** -->
   <link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2_metro.css" />
   <!-- **********************************************SELECT2 IMPLEMENTATION**************************************** -->
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
							What Piques Your Fancy? <small>all your interests, all in one place</small>
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
					<?php
						if($newUser == 1 && $interestsTutorial == 1)
						{
							updateTutorials("InterestsTutorial", $user_id_Tut, $con);
							tutorialCounter($user_id_Tut, $tutorialCount, $con);
							
							echo "<div class='blackout'></div>";
							echo 	"<div id='box-1' class='tutorial-box'>";
							echo 			"<p class='title-1'>Welcome to the family!</p>";
							echo 		"<div class='inner-box'>";
							echo 			"<p class='body-text'>Hello!  If you are seeing this message, then you are one of our hand-picked Alpha Users!  You were personally selected by one of the five developers of this website because your feedback is highly valued and trusted.  Thank you for helping us test the site!</p>";
							echo 			"<p class='signature'>Sincerely, </br>Shahar, Conner, Derek, Evan, and Justin</p>";
							echo 			"<div>";
							echo 				"<button id='button-1' class='btn-seafoam bottom-right' style='z-index: 11;'><i class='icon-check'></i> No Prob!</button>";
							echo 			"</div>";
							echo 		"</div>";
							echo 	"</div>";

							echo 	"<div id='box-2' class='tutorial-box'>";
							echo 			"<p class='title-1'>Get Some Interests</p>";
							echo 		"<div class='inner-box'>";
							echo 			"<p class='body-text'>Enough talk!  Grab some interests!  Whenever a post is tagged with one of your interests in your local area, you will get a notification at the top. </p>";
							echo 			"<p class='body-text'>We started you off with <b>bikes</b> and <b>textbooks</b>!</p>";
							echo 			"<div>";
							echo 				"<button id='button-2' class='btn-seafoam bottom-right' style='z-index: 11;'><i class='icon-check'></i> Got it!</button>";
							echo 			"</div>";
							echo 		"</div>";
							echo 	"</div>";

							echo	"<div id='alert' class='alert alert-info' style='font-size: 15px;'>";
							echo		"<button class='close' data-dismiss='alert'></button>";
							echo		"<strong>When you are done,</strong> go to <b>\"Add to Marketplace\"</b> at the top.  Or just click <a href='/sell/' style='color: #B80000;'>here</a>!</strong>";
							echo	"</div>";
							
						} //if
					?>




						<!-- BEGIN SAMPLE FORM PORTLET--> 
							<div class="portlet box tabbable" style="border: solid 1px #73b3ac;background:#73b3ac;">
								<div class="portlet-title">
									<div class="caption">
										<i class="icon-reorder"></i>
										<span class="hidden-480">Your Interests</span>
									</div>
								</div>
								<div class="portlet-body form">
									<div class="tabbable portlet-tabs">
										<ul class="nav nav-tabs">
											<li><a href="#portlet_tab2" data-toggle="tab" id="viewInterestTab">View Interests</a></li>
											<li class="active"><a href="#portlet_tab1" data-toggle="tab" id="addInterestTab">Add Interests</a></li>		
										</ul>
									
										<div class="tab-content">
											<!-- This is tab number 1 -->
											<div class="tab-pane active" id="portlet_tab1">
												<!-- BEGIN FORM-->
												<form action="" method="POST" enctype="multipart/form-data" class="form-horizontal" id="addInterestsForm">
													<div class="control-group">
														<label class="control-label">Interests: </label>
														<div class="controls">
															<input type="hidden" id="tags" class="span6 select2" value="" name="selectedInterests" multiple>
															<p id="popupMessage" class="successStyle"></p>
														</div>
													</div>
													<div class="form-actions">
														<button type="submit" class="btn-seafoam"><i class="icon-ok"></i> Submit</button>
														<button type="button" class="btn-gray">Cancel</button>
													</div>
												</form>
												<!-- END FORM-->  
											</div>
											
											
											<!-- BEGIN TAB 2 -->
											<div class="tab-pane " id="portlet_tab2">
												<form action="" method="POST" enctype="multipart/form-data" class="form-horizontal" id="viewInterestsForm">
													<div class="control-group">
														<label class="control-label">Your Interests: </label>
														<div class="controls">
															<input type="hidden" id="interests" class="span6 select2" value="">
															<p id="editMessage" class="successStyle"></p>
														</div>
													</div>
												</form>
											</div>
											<!-- END TAB 2 -->
											
										
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
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2.js"></script>
   <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
   <!-- END PAGE LEVEL PLUGINS -->
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <!--<script src="../globalref/sidebar/js/search_results.js" type="text/javascript"></script>-->
   <script src="../globalref/assets/js/app_sidebar.js" type="text/javascript"></script> <!--We need to include this in all files that use the sidebar to search-->
   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/form-components.js"></script>
   <script type='text/javascript' src='https://cdn.firebase.com/v0/firebase.js'></script>      
   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/search.js"></script>       
   <script src="../globalref/header/js/notifications.js" type="text/javascript"></script>
   <!-- END PAGE LEVEL SCRIPTS -->  

   <script>
		jQuery(document).ready(function() {       
		   // initiate layout and plugins
		   App.init();
		   //FormComponents.init();
		   /*$('#interests').select2({
		   		multiple:true,
		   		tags: 
		   });*/
			
			$('#box-2').hide();
			$('#alert').hide();
			$('#button-1').live('click', function(){
				$('#box-1').slideUp('slow');
				$('#box-2').slideDown('slow');
			});

			$('#button-2').live('click', function(){
				$('#box-2').slideUp('slow');
				$('.blackout').fadeOut(1500);
				$('#alert').fadeIn(2500);
			});
	
		   $('#popupMessage').hide();
		   $('#editMessage').hide();
		   /*----------Adding Interests--------------*/
		   var tags = new Array();
		   $("#tags").select2({
		   		multiple:true,
	            query: function (query) {
	                var data = {results: []};
	                $.ajax({
	                	type: 'GET',
	                	url: 'php/get_tags.php',
	                	dataType: 'json',
	                	data: {currentText: query.term},
	                	success: function(response)
	                	{
	                		for(var i=0;i < response.length;i++)
	                			//data.results.push({id: "\"" + response[i]['Tag'] + "\"",text: "\"" + response[i]['Tag'] + "\""});
	                			data.results.push({id: response[i]['Tag_ID'],text:response[i]['Tag']});
	     					
	                		query.callback(data);
	                	}
	                });
	            }
       		});
       		
       		//if(newUser == 1)
       		//{
       			//$('#tags').select2('data',[{id:'bikes',text:'bikes'},{id:'textbooks',text:'textbooks'}]);
		  	 //} //if
		   $('#addInterestsForm').submit(function() //Adding interests form submission
		   {
		   		var inputInterests = $('#tags').select2("data");
		   		$.ajax(
		   		{
		   			type: 'GET',
		   			url: 'php/update_tags.php',
		   			dataType: "text",
		   			data: {json: JSON.stringify(inputInterests)},
		   			success: function(response)
		   			{
		   				if(response == "Success")
		   				{
		   					//$('#added').show();
		   					$('#popupMessage').removeClass();
		   					$('#popupMessage').html("Added");
		   					$('#popupMessage').addClass('successStyle');
		   					$('#popupMessage').fadeIn(800);
		   					setTimeout(function()
		   					{
		   						$('#popupMessage').fadeOut(800);
		   					},3000);
		   					$('#tags').select2("val","");
		   				}
		   				else //They tried to insert interests that they already have
		   				{
		   					$('#popupMessage').removeClass();
		   					$('#popupMessage').html("You are already interested in that");
		   					$('#popupMessage').addClass('errorStyle');
		   					$('#popupMessage').fadeIn(800);
		   					setTimeout(function()
		   					{
		   						$('#popupMessage').fadeOut(800);
		   					},3000);
		   					$('#tags').select2("val","");
		   				}
		   			}
		   		});
		   		return false;
		   });
		   /*---------[END] Adding Interests---------*/

		   /*---------Viewing Interests--------------*/
		   $('#interests').select2(
		   	{
		   		multiple:true,
		   		tags: []
		   	});
		   $('#interests').on("select2-open",function()
		   {
		   		$('#interests').select2("close");
		   });
		   $('#viewInterestTab').on('click',function(){
			   $.ajax({
			   		type: 'GET',
			   		url: 'php/get_user_tags.php',
			   		dataType: 'json',
			   		data: {},
			   		success: function(response)
			   		{
			   			var data = {results: []};
			   			for(var i=0;i<response.length;i++)
			   			{
			   				if(response[i]['Deleted'] != 1)
			   				{
			   					data.results.push({id: response[i]['Tag_ID'],text: response[i]['Tag']});
			   				}
			   			}
			   			$('#interests').select2("data",data.results);
			   		}
			   });
			});
		   $('#interests').on("change",function(e)
		   	{
		   		$.ajax({
		   			type: 'GET',
		   			url: 'php/edit_interests.php',
		   			dataType: 'text',
		   			data: {json: e.removed},
		   			success: function(response)
		   			{
		   				if(response == "Success")
		   				{
		   					$('#editMessage').removeClass();
		   					$('#editMessage').html("Deleted");
		   					$('#editMessage').addClass("successStyle");
		   					$('#editMessage').fadeIn(300);
		   					setTimeout(function()
		   					{
		   						$('#editMessage').fadeOut(300);
		   					},200);
		   				}
		   				else
		   				{
		   					$('#editMessage').removeClass();
		   					$('#editMessage').html("Unsuccessful");
		   					$('#editMessage').addClass("errorStyle");
		   					$('#editMessage').fadeIn(300);
		   					setTimeout(function()
		   					{
		   						$('#editMessage').fadeOut(300);
		   					},200);
		   				}
		   			}
		   		});
		   	});

		   /*------[END] Viewing Interests-----------------------*/
		});

	</script>
</body>
</html>

<?php 

session_start();
require("../../assets/php/globalref/sqlconf.php");
require('../../assets/php/globalref/lock.php');
require('../../assets/php/globalref/get_user_info.php');
require('../../assets/php/myshop/header.php');
if($newUser == 1)
{
	require("../../assets/php/globalref/tutorials.php");
	if($tutorialCount >= 5)
		updateNewUser($user_id_Tut, $con);
} //if
//mysqli_close($con);
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<script>
		<?php echo "var session = {$_SESSION['id']};";?>
	</script>
	<meta charset="utf-8" />
	<title>Anilum | My Shop</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/css/custom.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/css/squarecrop.css" rel="stylesheet" type="text/css"> 
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES --> 
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-datepicker/css/datepicker.css" />
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
	<link href="../globalref/metronic1.4/admin/template_content/assets/css/pages/search.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
	<link href="../globalref/css/tutorial.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons/css/glyphicons.css" rel="stylesheet" type="text/css"/>
	
	<style>
		.opacity-level {
			opacity: .2;
		} 
	</style>

	<style>
	   .gray {
	 		background-color: #e5e5e5;
	   }
	    .gray:hover {
	   		background-color: #cccccc;
	   }
	   
	   .seafoam {
	   		background-color: #73b3ac;
	   }
   </style>

	
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
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
							My Shop <small>your items for all to see</small>
						</h3>
						<ul class="breadcrumb">
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
						</div>
					</div>
					<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					
					<?php
						if($newUser == 1 && $myshopTutorial == 1)
						{
							updateTutorials("MyshopTutorial", $user_id_Tut, $con);
							tutorialCounter($user_id_Tut, $tutorialCount, $con);
							
							echo "<div class='blackout'></div>";
							echo 	"<div id='box-1' class='tutorial-box'>";
							echo 			"<p class='title-1'>Welcome to Your Shop</p>";
							echo 		"<div class='inner-box'>";
							echo 			"<p class='body-text'>The \"My Shop\" page allows you to view all of your posts and offers in one coherent page.  You can edit your posts, mark items as sold, and accept monetary offers from other users!</p>";
							echo 			"<p class='signature'>Poke around your shop and familiarize yourself with the flow!</p>";
							echo 			"<div>";
							echo 				"<button id='button-1' class='btn-seafoam bottom-right' style='z-index: 11;'><i class='icon-check'></i> Will Do!</button>";
							echo 			"</div>";
							echo 		"</div>";
							echo 	"</div>";

							echo 	"<div id='box-2' class='tutorial-box'>";
							echo 			"<p class='title-1'>Words of Wisdom</p>";
							echo 		"<div class='inner-box'>";
							echo 			"<p class='body-text'>Remember, this is a second-hand goods market&mdash;we can help you find great deals, but you ultimately have to go out and buy the item.  For your safety, always meet at a mutual location with plenty of people milling about.  We will do our best to thwart bad sellers, but they may be out there.</br>On a brighter note, good luck, happy selling, and keep the wind in your sales!</br><em><b>Truly yours, the Developers</b></em></p>";
							echo 			"<div>";
							echo 				"<button id='button-2' class='btn-seafoam bottom-right' style='z-index: 11;'><i class='icon-check'></i> Got It!</button>";
							echo 			"</div>";
							echo 		"</div>";
							echo 	"</div>";

							echo	"<div id='alert' class='alert alert-info' style='font-size: 15px;'>";
							echo		"<button class='close' data-dismiss='alert'></button>";
							echo		"<strong>Congratulations!</strong> You are now an honorary member.  Give us feedback by clicking on <a href='/suggestions/' style='color: #B80000;'>Suggest and Report</a> at the top!</strong>";
							echo	"</div>";
						} //if 
					?>


					<div class="tabbable tabbable-custom tabbable-full-width">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab_1_2" data-toggle="tab">Items</a></li>
							<li><a href="#tab_1_3" data-toggle="tab">Offers</a></li>
						</ul>
						<div class="tab-content">
							<div id="tab_1_2" class="tab-pane active">
								<div class="row-fluid search-forms search-default"></div> <!-- THIS ADDS A LITTLE SPACE AT THE TOP -->
									<div style='margin-bottom: 20px; margin-top: -30px;'>
										<button id='btn-all' type="button" class="btn-gray seafoam" name='All' >All</button> 
										<button id='btn-available' type="button" class="btn-gray gray" name='Available'>Available</button> 
										<button id='btn-sold' type="button" class="btn-gray gray" name='Sold'>Sold</button> 
									</div>
									
									<?php
										$num_posts = 0;
										$postidarray = array();	
										
										if(mysqli_num_rows($result) == 0)
										{
											echo "<h3 style='text-align: center;'>You haven't posted any items yet!</h3>";
											echo "<h4 style='text-align: center;'>Check out the <a href='/sell/'>Sell Page</a> to add to the marketplace!</h4>";
										} //if
										while($currentRow = mysqli_fetch_array($result))
										{
											$post_id = $currentRow['Post_FK'];		
											array_push($postidarray,$post_id);
											
											if($currentRow['Sold'] == 0)
												echo "<div id='pic-$post_id' class='row-fluid portfolio-block not-sold' style='background-color: #F0F0F0;'>";
											else
												echo "<div id='pic-$post_id' class='row-fluid portfolio-block sold opacity-level' style='background-color: #F0F0F0;'>";
											
											echo 	"<div class='span5 portfolio-text'>";
											echo 		"<div class='center-cropped' style=\"width:77px;height:77px;background-image: url('php/image_proxy.php?image=".$currentRow['Source']."');display:inline-block;vertical-align:top;\">";
											echo			"<a href='/merch/?pid=".$currentRow['Post_FK']."'><span class='link-spanner' style='height:100%;width:100%;'></span></a>";
											echo		"</div>";
											echo		"<div class='portfolio-text-info' style='display:inline-block;vertical-align:top;padding-left:10px;'>";
											echo			"<h4>" .$currentRow['Subject']. "</h4>";									
											echo		"</div>";
											echo	"</div>";
											echo	"<div class='span5' style='margin-right: -30px;'>";
											echo		"<div class='portfolio-info'>";
											echo	"	Likes";
											echo			"<span>".$currentRow['Likes']."</span>";
											echo		"</div>";
											echo		"<div class='portfolio-info'>";
											echo			"Comments";
											echo			"<span>" .$currentRow['Comment_Count']. "</span>";
											echo		"</div>";
											echo		"<div class='portfolio-info'>";
											echo			"Offers";
											echo			"<span>" .$currentRow['Offer_Count']. "</span>";
											echo		"</div>";
											echo	"</div>";
											
											if($currentRow['Sold'] == 0)
											{
												echo 	"<div style='margin-top: 22px; margin-right: 21px; margin-bottom: 10px; float: right;'>";
												echo		"<label class='checkbox'>";
												echo 	"<a href='/edit_post/?pid=".$currentRow['Post_FK']."' style='display: inline-block; text-decoration:none; margin-right: 22px;' class='btn-seafoam'><i class='icon-list icon-white' style=' color: white;'> Edit</i></a>";
												echo		"<input id='availability' name ='$post_id' type='checkbox' value='' /> Sold";
												echo		"</label>";
												echo 	"</div>";
											} //if
											else if($currentRow['Sold'] == 1)
											{
												echo 	"<div style='margin-top: 22px; margin-right: 21px; margin-bottom: 10px; float: right;'>";
												echo		"<label class='checkbox'>";
												echo 	"<a href='/edit_post/?pid=".$currentRow['Post_FK']."' style='display: inline-block; text-decoration:none; margin-right: 22px;' class='btn-seafoam'><i class='icon-list icon-white' style=' color: white;'> Edit</i></a>";
												echo		"<input id='availability' name ='$post_id' type='checkbox' value='' checked='yes'/> Sold";
												echo		"</label>";
												echo 	"</div>";
											} //else if
											
											//echo "<div style='margin-top: 21px; margin-right: 21px; margin-bottom: 5px; float: right;'>";
											//echo 	"<a href='/edit_post/?pid=".$currentRow['Post_FK']."' style='display: inline-block; text-decoration:none;' class='btn-seafoam'><i class='icon-list icon-white' style=' color: white;'> Edit</i></a>";
										 	//echo "</div>";
										 	
										 	echo	"<div style='display: none; margin-left: 0; right: 0;' class='span1 portfolio-btn'>";
											echo		"<a href='/merch/?pid=".$currentRow['Post_FK']."' class='btn bigicn-only'><span>View</span></a>";                      
											echo	"</div>";
											echo	"<div style='display: none; margin-left: 0; right: 0;' class='span1 portfolio-btn'>";
											echo		"<a href='/edit_post/?pid=".$currentRow['Post_FK']."' class='btn bigicn-only' style='margin-right'><span>Edit</span></a>";                      
											echo	"</div>";
											echo "</div>";
											
											++$num_posts;
										} //while
									?>
									<script type="text/javascript">
										var post_array = '<?php echo json_encode($postidarray);?>';
										var num_posts = '<?php echo $num_posts;?>';
									</script>
									
							</div>					
							<!--end tab-pane-->
							<div id="tab_1_3" class="tab-pane">
								<div class="portlet-body">
									<div class="accordion" id="accordion1">
									<?php 
										$increment_post = 0;
										$query = "SELECT Subject,Post_PK FROM Posts WHERE User_FK = '$user_id' ORDER BY Post_PK";
										$result = mysqli_query($con, $query);

										//mysqli_close($con);
										
										$postidarray = array();										
										while($row = mysqli_fetch_array($result))
										{
											$post_id = $row['Post_PK'];
											array_push($postidarray,$post_id);
											
											
											echo "<div class='accordion-group' id='post-bar'>";
												echo "<div id='postid' style='display:none;'>$post_id</div>";
												echo "<div class='accordion-heading'>";
													echo "<a class='accordion-toggle collapsed' data-toggle='collapse' data-parent='#accordion1' href='#collapse_$increment_post'>";
													echo "<i class='icon-angle-left'></i>";
													echo " " . $row['Subject'];
													echo "</a>";
												echo "</div>";
												
												echo "<div id='collapse_$increment_post' class='accordion-body collapse '>";//in
													echo "<div class='accordion-inner' id='offersList'>";
														echo "<div class='portlet-body' id='offers-inner_$increment_post'>";
															echo "<div id='offersBlock' class='alert' style='border:1px solid #73b3ac;color:black;background:#fafafa;margin-top:1px;margin-bottom:0px;padding-top:4px;padding-right:3px;'>";
																echo "<b id='offerName' style='display:inline-block;margin:0px;'></b><em> has made an offer for </em><b> &nbsp$</b><b id='offerPrice' style='margin:0px;'></b>";
																echo "<a href='#' class='btn red icn-only reject' style='float:right; margin-top: 3.5px;' id='rejectButton'><i class='icon-remove icon-white'></i></a>";
																echo "<a href='#' class='btn accept' style='background-color:#73b3ac;float:right; margin-top: 3.5px;' id='acceptButton'><i class='icon-ok' style='color:white;'></i></a>";
																echo "<p id='offerMessage' style='display:block;margin:0px 0px 7px 10px;padding:0px;width:300px;height:10px;'></p>";
															echo "</div>";
														echo "</div>";
													echo "</div>";
												echo "</div>";
											echo "</div>";
											
											++$increment_post;
										} //while											
									?>		
									
										<script type="text/javascript">
											var postarray = '<?php echo json_encode($postidarray);?>';
											var numberOfPosts = '<?php echo $increment_post;?>';
										</script>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end tabbable-->           
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
	<!-- BEGIN CORE PLUGINS -->   <script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
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
	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/search.js"></script>   
	<script type='text/javascript' src='https://cdn.firebase.com/v0/firebase.js'></script>          
   <script src="../globalref/header/js/notifications.js" type="text/javascript"></script>
   <!-- END PAGE LEVEL SCRIPTS --> 
	<script src="js/offers.js" type="text/javascript"></script>
	<script src='js/availability.js' type='text/javascript'></script>
	<script>
		jQuery(document).ready(function() {    
		   App.init();
		   Search.init();

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


		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
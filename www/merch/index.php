<?php 
session_start();
require("../../assets/php/globalref/sqlconf.php");
require('../../assets/php/globalref/lock.php');
require("../../assets/php/merch/header.php");
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
	<script type="text/javascript">
		<?php
			echo "var idpost= '".$postID. "';";
			echo "var session= '".$_SESSION['id']. "';";
		?>
	</script>
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
    
    <!-- CONNER'S INCLUDES BEGIN-->
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons/css/glyphicons.css" rel="stylesheet" />
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons_halflings/css/halflings.css" rel="stylesheet" /> 
	<link href="../globalref/css/tutorial.css" rel="stylesheet" type="text/css"/>
    <!-- CONNER'S INCLUDES END-->
    <style>
	    #nameAndDate
	    {
	    	display:inline-block;
	    	margin: 0px;
	    	padding:0px;
	    	width: 100%;
	    }
	    #profileLink
	    {
	    	float:left;
	    	margin: 5px 0px 0px 5px;
	    }
	    #fullname
	    {
	    	display:inline-block;
	    	padding: 0px;
	    	margin: 0px 5px 0px 5px;
	    	font-weight: bold;
	    }
	    #date
	    {
	    	padding:0px;
	    	font-size:9px;
	    	margin: 0px 0px 0px 40px;
	    	color: grey;
	    	font-style:italic;
	    }
	    #comment
	    {
	    	margin: 0px 5px 5px 38px;
	    	padding: 0px 0px 5px 0px;	
	    	font-size:11px;
	    	line-height: 120%;
	    	overflow: hidden;
	    	word-wrap: break-word;
	    }
	    .well
	    {
	    	margin: 3px 0px 3px 0px;
	    }
	    .center-cropped { 
	    	width: 125px; 
	    	height: 125px; 
	    	background-position: center center; 
	    	background-size: cover;
	    	background-repeat: no-repeat; 
	    	position: relative;
	    	}
	    	/*Important:*/
		.link-spanner{
		  position:absolute; 
		  width:100%;
		  height:100%;
		  top:0;
		  left: 0;
		  z-index: 1;
		  background-image: url('empty.gif');
		}   
		/* Make the buttons invisible */
		#yesButton
		{
			visibility: hidden;
		}
		#noButton
		{
			visibility: hidden;
		}
		#button-visibility {
			position:absolute; 
			top:0;
		  	left: 0;
			height: 100%;
			width: 100%;
		}

		#button-visibility button {
			visibility: hidden;
			-webkit-opacity: 0;
		  	-moz-opacity: 0;
		  	opacity: 0;
			-webkit-transition: all .25s ease;
			  -moz-transition: all .25s ease;
			  -ms-transition: all .25s ease;
			  -o-transition: all .25s ease;
			  transition: all .25s ease;
		}

		#button-visibility:hover button {
			visibility: visible;
			-webkit-opacity: 1;
			  -moz-opacity: 1;
			  opacity: 1;
		}
    </style>
<!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&  TUTORIAL STYLES &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
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
	   .text-seafoam {
	   		color: #73B3AC;
	   }
	   
	   .text-black {
	   		color: #666;
	   }
    </style>
   <!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&  TUTORIAL STYLES &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
</head>

<body class="page-header-fixed page-boxed page-full-width">
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
			<?php //if($getdata == 'newsfeed') require("../globalref/sidebar/index.php");?> <!--SIDEBAR-->
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
								<!-- Blog Post <small>blog post samples</small> -->
								<h2><?php echo $subject;?></h2>
							</h3>

							<ul class="breadcrumb">
							</ul>
							<!-- END PAGE TITLE & BREADCRUMB-->
						</div>
					</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN PAGE CONTENT-->
					<div class="row-fluid">
						<div class="span12 blog-page">
							
						<?php
							if($newUser == 1 && $merchTutorial == 1)
							{
								echo "<div class='blackout'></div>";
								echo 	"<div id='box-1' class='tutorial-box'>";
								echo 			"<p class='title-1'>Comment and Offer</p>";
								echo 		"<div class='inner-box'>";
								echo 			"<p class='body-text'>The Social Market is simple: make an offer on something that piques your fancy and the seller will either reject or accept your offer.  Only the seller gets to see the price of the offer--so that means no bid wars!  Just offer what feels right.</p>";
								echo 			"<p class='signature'>When you offer, make sure to put a \"<b>Cashtag '$'</b>\" for the price... Like this: \"<b>$600</b>\"</p>";
								echo 			"<div>";
								echo 				"<button id='button-1' class='btn-seafoam bottom-right' style='z-index: 1001;'><i class='icon-check'></i> Sweet!</button>";
								echo 			"</div>";
								echo 		"</div>";
								echo 	"</div>";
	
								echo	"<div id='alert' class='alert alert-info' style='font-size: 15px;'>";
								echo		"<button class='close' data-dismiss='alert'></button>";
								echo		"<strong>Make an offer!</strong> And make it good... this is Grumpy Cat we are talking about here!  When you are all done, check out \"<a href='/myshop/'><b style='color: #B80000;'>My Shop</b></a>\"!";
								echo	"</div>";
								
								updateTutorials("MerchTutorial", $user_id_Tut, $con);
								tutorialCounter($user_id_Tut, $tutorialCount, $con);
							} //if
						?>
					
						<div class="row-fluid">
								<div class="span9 article-block">
									<div class="blog-tag-data" style="position: relative;">
										
										<span id='button-visibility'>   
											<div>
												<?php 
													
													if($alreadyBookmarked && ($irrelevantBookmark == false))
													{
														if($newUser != 1)
															echo "<button style='margin: 5px 0px 0px 5px;' class='text-seafoam btn-white' id='bookmarkButton'>Bookmark <i class='icon-bookmark'></i></button>";
														else
															echo "<button style='margin: 5px 0px 0px 5px;' id='bookmarkButton' class='text-seafoam btn-white popovers' data-trigger='hover' data-container='body' data-placement='right' data-content='You can bookmark posts that you make offers on and view them in Bookmarks' data-original-title='Bookmarking'>Bookmark <i class='icon-bookmark'></i></button>";
													}
													else if(($alreadyBookmarked == false) && ($irrelevantBookmark == false))
													{
														if($newUser != 1)
															echo "<button style='margin: 5px 0px 0px 5px;' class='text-black btn-white' id='bookmarkButton'>Bookmark <i class='icon-bookmark-empty'></i></button>";
														else
															echo "<button style='margin: 5px 0px 0px 5px;' id='bookmarkButton' class='text-black btn-white popovers' data-trigger='hover' data-container='body' data-placement='right' data-content='You can bookmark posts that you make offers on and view them in Bookmarks' data-original-title='Bookmarking'>Bookmark <i class='icon-bookmark-empty'></i></button>";
													}
													
													?> 
													
												<?php
													if($alreadyLiked) 
													{
														if($newUser != 1)
															echo "<button style='margin: 5px 0px 0px 5px;' class='text-seafoam btn-white' id='likeButton'>Like <i class='icon-heart'></i></button>"; 
														else
															echo "<button style='margin: 5px 0px 0px 5px;' id='likeButton'  class='text-seafoam btn-white popovers' data-trigger='hover' data-container='body' data-placement='right' data-content='In the Social Marketplace, Liking posts is a selfless act.  If you see a good deal, help the seller out and Like it!' data-original-title='Liking'>Like <i class='icon-heart'></i></button>";
													} //if
													else 
													{
														if($newUser != 1)
															echo "<button style='margin: 5px 0px 0px 5px;' class='text-black btn-white' id='likeButton'>Like <i class='icon-heart-empty'></i></button>"; 
														else
															echo "<button style='margin: 5px 0px 0px 5px;' id='likeButton'  class='text-black btn-white popovers' data-trigger='hover' data-container='body' data-placement='right' data-content='In the Social Marketplace, Liking posts is a selfless act.  If you see a good deal, help the seller out and Like it!' data-original-title='Liking'>Like <i class='icon-heart-empty'></i></button>";
													} //else
												?> 
												
												<button style='margin: 5px 0px 0px 5px;' class="btn-white">Share <i class="icon-collapse-top"></i></button>
												
												<?php
													$query = "SELECT Post_PK,User_FK FROM Posts WHERE Post_PK = '$postID'";
													$result = mysqli_query($con, $query);
													$row = mysqli_fetch_array($result);
													$poster_id = $row['User_FK'];
													$noBookmark = false;
													if($poster_id == $userID)
													{
														$noBookmark = true;
														echo	"<a style='margin: 5px 5px 5px 5px; float: right;' class='btn red' id='deleteButton' >Delete <i class='icon-remove'></i></a>";
														echo	"<button style='visibility: hidden;margin: 5px 5px 5px 5px; float: right;' class='btn-seafoam' id='yesButton' >Yes <i class='icon-check'></i></button>";
														echo	"<button style='visibility: hidden;margin: 5px 5px 5px 5px; float: right;' class='btn-seafoam' id='noButton' >No <i class='icon-remove'></i></button>";
													} //if
												?>
											</div>	
										</span>
										
										<?php
											echo "<img src='php/image_proxy.php?image=$pictureSrc' alt='' style='width:100%;' id='main_pic'>";
										?>
										<div class="space20"></div>
										<div class="row-fluid">
											<div class="span6">
												<ul class="unstyled inline blog-tags">
												</ul>
											</div>
											<!--<div class="span6 blog-tag-data-inner">
												<ul class="unstyled inline">
													<li><i class="icon-calendar"></i> <a href="#"><?php //echo $dateCreated;?></a></li>
													<li><i class="icon-comments"></i> <a href="#"><?php //echo $comments;?></a></li>
												</ul>
											</div>-->
										</div>
									</div>

									<!--end news-tag-data-->
									<div>
										
										<ul class="unstyled blog-images">
											<!--<li><a href="#"><img class='pictureClick' alt='' src="image_proxy.php?image=8be8f265bc70e8d247acb4eb2c765f340_lg.jpg"></a></li>-->
											<?php
												echo "<li><a href='#'><img class='pictureClick' alt='' src='php/image_proxy.php?image=$pictureSrc'></a></li>";
												while($picture = mysqli_fetch_array($postResult))
												{
													$pictureSrc = $picture['Source'];
													echo "<li><a href='#'><img class='pictureClick' alt='' src='php/image_proxy.php?image=$pictureSrc'></a></li>";
												}
											?>
										</ul>									
									</div>
									<hr>
									<!--end media-->
								</div>
								<!--end span9-->
								<div class="span3 blog-sidebar">
									<!--<h3><?php echo $subject;?></h3> -->
									<?php 
										//echo "<a href='../profile/?user=$posterID' style='display:inline-block;vertical-align:top;margin-bottom:10px;border:1px solid black;'><img src='$sellerPicture' style='width:100px;height:100px;'/></a>";
										echo 	"<div class='center-cropped' style=\"width:43px;height:43px;background-image: url('php/image_proxy.php?image=".$sellerPicture."');display:inline-block;\">";
										echo		"<a href='../profile/?user=$posterID'><span class='link-spanner' style='height:100%;width:100%;'></span></a>";
										echo	"</div>";

									?>
									

									<div style="display:inline-block;margin:0px;">
										<h4 style="margin-left:10px;"><?php echo $firstName . ' ' . $lastName;?></h4>
										<h5 style="margin-left:10px;"><?php echo $city . ', ' . $state; ?></h5>
									</div>

									<div class="space20">
										<i class="icon-calendar"></i> <a href="#"><?php echo $timeCreated;?> &nbsp;</a>
										<i class="icon-comments"></i> <a href="#"><?php echo $comments;?> &nbsp;</a>
										<i class="icon-dollar"></i> <a href="#"><?php echo $offerCount;?></a>
										<div class="space20"></div>
									</div>
									<hr>
									<div class="space20"></div>
									<div class="tabbable tabbable-custom">
										<ul class="nav nav-tabs">
											<li class="active"><a data-toggle="tab" href="#descriptionTab">Description</a></li>
											<li ><a data-toggle="tab" href="#commentsTab">Comments</a></li>
											<li ><a data-toggle="tab" href="#offersTab">Offers</a></li>
										</ul>
										<div class="tab-content">
											<div id="descriptionTab" class="tab-pane active">
												<p><?php echo $description;?></p>
								
												<ul class="unstyled inline sidebar-tags">
												<?php
													for($i = 0;$i < count($tags);$i++)
													{
														echo "<li><a href='/browse/?q={$tags[$i]['Tag']}&type=browse'><i class='icon-tags'></i> {$tags[$i]['Tag']} </a></li>";
													}
												?>
												</ul>
											</div>
											<div id="commentsTab" class="tab-pane">
												<div class="well" id="commentBox" style="padding:0px;width:100%;">
													<div id="nameAndDate">
															<a href='' id="profileLink"><img src='' style='width:30px;height:30px;' id="profileImg" /></a>
															<p id="fullname"><b></b></p>
															<p id="date"></p>
															<p id="comment"></p>
													</div>	
												</div>
												<i id="comment-error" style="text-align: center;display: inline-block; padding: 5px 5px 13px 5px; color: #B80000;"></i>
												<div class="well" id="comment_form">
													<textarea rows="5" style="width:92%;height:50px; resize: none;" name="comments" placeholder='Inquire about the item being sold...'></textarea>
													<input type="hidden" value="" name="pid" />
												</div>
											</div>
											
											<div id="offersTab" class="tab-pane">
													<i id="offer-error" style="text-align: center;display: inline-block; padding: 5px 5px 13px 5px; color: #B80000;"></i>
													<?php
														if($myPost == 0)
															echo "<textarea id='offersInput' rows='3' style='width:82%; height: 50px; resize: none;' placeholder='Make sure to use a Cashtag when you offer...' name='offers'></textarea>";
													?>
													<div id="offersBlock" class="alert alert-info" style="margin-top:5px;margin-bottom:5px;">
														<b id="offerName" style="display:inline-block;"></b><em> has made an offer</em>
													</div>
											</div>
										</div>
										<div class="space20"></div>
								<!--end span3-->
									</div>
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
				</div>
				</div>
	
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
   <!-- END PAGE LEVEL PLUGINS -->
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src='https://cdn.firebase.com/v0/firebase.js' type="text/javascript"></script>
   <!--<script type="text/javascript" src="js/search.js"></script>-->
   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js" type="text/javascript"></script>
   <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/index.js" type="text/javascript"></script>      
   <script src="../globalref/header/js/notifications.js" type="text/javascript"></script>     
   <script src="/merch/js/comments.js" type="text/javascript"></script>  
   <!-- END PAGE LEVEL SCRIPTS -->  
   <script>
      jQuery(document).ready(function() 
      {
      	App.init(); 
        Index.init();

		$('#alert').hide();
		
		$('#button-1').live('click', function(){
			$('#box-1').slideUp('slow');
			$('.blackout').fadeOut(1500);
			$('#alert').fadeIn(2500);	
		});
  	});
 </script>
</body>
</html>
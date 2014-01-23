<?php 
	session_start();
	require("../../assets/php/globalref/sqlconf.php");
	require('../../assets/php/globalref/lock.php');
	require('../../assets/php/globalref/get_user_info.php');
	require('../../assets/php/profile/header.php');
	//mysqli_close($con);
?>
<!DOCTYPE html>
<html>
	<head>
	<script type="text/javascript">
	<?php
		echo "var u_id= '".$user_id_P. "';";
		echo "var session= '".$_SESSION['id']. "';";
	?>
	</script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- Refrence Style Sheet -->
	<title><?php echo $firstName_P." ".$lastName_P."'s Anilum"; ?></title>
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
    <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="../globalref/metronic1.4/admin/template_content/assets/css/style-metro.css" rel="stylesheet" type="text/css"/>
    <link href="../globalref/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../globalref/metronic1.4/admin/template_content/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
    <link href="../globalref/css/custom.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <link href="../globalref/metronic1.4/admin/template_content/assets/css/pages/search.css" rel="stylesheet" type="text/css"/>
    <style>
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

		#button-visibility {
			position:absolute; 
			top:0;
		  	left: 0;
			height: 100%;
			width: 100%;
		}

		#button-visibility #update-photo-button {
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

		#button-visibility:hover #update-photo-button {
			visibility: visible;
			-webkit-opacity: 1;
			  -moz-opacity: 1;
			  opacity: 1;

		}
    </style>
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
			<?php // require("../globalref/sidebar/index.php");?> <!--SIDEBAR-->
			<!-- END SIDEBAR -->
			<!-- BEGIN PAGE -->
			<div class="page-content">
				<!-- BEGIN PAGE CONTAINER-->
				<div class="container-fluid">
					<!-- BEGIN PAGE HEADER-->
					<div class="row-fluid">
						<div class="span12">
							
						</div>
					</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid profile">
					<div class="span12">
						<!--BEGIN TABS-->
						<div class="tabbable tabbable-custom tabbable-full-width">
							<ul class="nav nav-tabs">
								<!--<li class="active"><a href="#tab_1_1" data-toggle="tab">Overview</a></li>-->
							</ul>
							<div class="tab-content">
								<div class="tab-pane row-fluid active" id="tab_1_1">
									<ul class="unstyled profile-nav span3" >
										<li style="position: relative;">												
											<?php
											//include ("../../assets/php/globalref/sqlconf.php");
												echo "<img src='php/image_proxy.php?image=$profilePicture_P' />";
												if($showEdit)
												{
													echo "<form action='php/edit_picture.php' id='update-photo-form' method='POST' enctype='multipart/form-data' class='form-horizontal'>";
													echo "	<span id='button-visibility'>";
													echo "		<div>";
													echo "			<a href='#' style='margin: 5px 0px 0px 5px;' class='btn' id='update-photo-button' onclick=\"performClick(document.getElementById('theFile'));\">Edit <i class='icon-camera'></i></a>";
													echo "		</div>";
													echo "	</span>";
													echo "	<input type='hidden' name='MAX_FILE_SIZE' value='5000000'/>";
													echo "	<input type='file' id='theFile' name='file' style='position:fixed;top:-1000px'/>";
													echo " </form>";
												} //if
												//mysqli_close($con);
											?>
											<hr/>
										</li>
										<li >
											<h5>Followers <a href="/friends/?user=<?php echo $user_id_P;?>&tab=followers" style="display: inline-block; font-size: 13px; padding-left: 20px; font-color: ">See All</a></h5>
											<hr/>
											<div>
												<?php 
												include ("../../assets/php/globalref/sqlconf.php");
												$count = 0;
												while(($temp = mysqli_fetch_row($followers)) && $count < 5)
												{
													$query = "SELECT uu.User2_FK, u.FirstName,u.LastName,u.ProfilePicture,uu.Weight FROM Users AS u INNER JOIN Users_Users AS uu ON uu.User2_FK = u.User_PK WHERE uu.User2_FK = '$temp[0]' ORDER BY Weight";
													$name_result = mysqli_query($con,$query);
													$name_row = mysqli_fetch_row($name_result);
													
													$followerUser_ID = mysqli_real_escape_string($con,$name_row[0]);
													$followerFirstName = mysqli_real_escape_string($con,$name_row[1]);
													$followerLastName = mysqli_real_escape_string($con,$name_row[2]);
													$followerProfilePicture = mysqli_real_escape_string($con,$name_row[3]);
												
													echo "<div class='friend' style='margin-top: 6px;'>";
													echo 	"<div class='center-cropped' style=\"width:30px;height:30px;background-image: url('php/image_proxy.php?image=" . $followerProfilePicture . "');display:inline-block;\">";
													echo		"<a href='/profile/?user=$followerUser_ID'><span class='link-spanner' style='height:100%;width:100%;'></span></a>";
													echo	"</div>";
													echo	"<div style='padding-top:5px;display:inline-block;vertical-align:top;'><a href='/profile/?user=$followerUser_ID' style='margin-left: 8px;'>  $followerFirstName $followerLastName</a></div>";
													echo "</div>";
													
													$count++;
												}
												//mysqli_close($con);
												?>
												<hr/>
											</div>
										</li>
										<li>
											<h5>Following <a href="/friends/?user=<?php echo $user_id_P;?>&tab=following" style="display: inline-block; font-size: 13px; padding-left: 20px; font-color: ">See All</a></h5>
											<hr/>
											<div>
												<?php 
													//include ("../../assets/php/globalref/sqlconf.php");
													$count = 0;
													$query = "SELECT uu.User2_FK, u.FirstName,u.LastName,u.ProfilePicture,uu.Weight FROM Users AS u INNER JOIN Users_Users AS uu ON uu.User2_FK = u.User_PK WHERE uu.User1_FK = '$user_id' ORDER BY Weight DESC LIMIT 5";
													$followingList = mysqli_query($con,$query);
													while($temp = mysqli_fetch_row($followingList))
													{
											
														$followingUser_ID = $temp[0];
														$followingFirstName = mysqli_real_escape_string($con,$temp[1]);
														$followingLastName = mysqli_real_escape_string($con,$temp[2]);
														$followingProfilePicture = mysqli_real_escape_string($con,$temp[3]);
														
														//echo $followingUser_ID;
														//echo $followerFirstName;
														//echo $followerLastName;
													
														
													/*	echo 	"<div class='center-cropped' style=\"width:30px;height:30px;background-image:url('php/image_proxy.php?image=".$followingProfilePicture."');display:inline-block;\">";
														echo		"<a href='/profile/?user=$followingUser_ID'><span class='link-spanner' style='height:100%;width:100%;'></span></a>";
														echo	"</div>";
														echo	"<div style='padding-top:5px;display:inline-block;vertical-align:top;'><a href='/profile/?user=$followingUser_ID' style='margin-left: 8px;'>  $followingFirstName $followingLastName</a></div>";
													*/
														
														echo "<div class='friend' style='margin-top: 6px;'>";
														echo "	<a href='/profile/?user=$followingUser_ID'><img src='php/image_proxy.php?image=$followingProfilePicture' alt='$followingFirstName $followingLastName' style='width:30px;height:30px;margin:5px;/></a>
														<span class='friendly'>
														<a href='/profile/?user=$followingUser_ID'>$followingFirstName $followingLastName</a>
														</span>";
														echo "</div>";

													
														
														
													/**********************************************
													 * 
													 * 
													 */
														/*echo "<div class='friend'>";
														echo "	<a href='/profile/?user=$followingUser_ID'><img src='$followingProfilePicture' alt='$followingFirstName $followingLastName' style='width:30px;height:30px;margin:5px;/></a>
																	<span class='friendly'>
																		<a href='/profile/?user=$followingUser_ID'>$followingFirstName $followingLastName</a>
																	</span>";
														echo "</div>";*/
													
														$count++;
													} //while
													//mysqli_close($con);
												?>
												<hr/>
											</div>
										</li>
									</ul>
									<div class="span9">
										<div class="row-fluid">
											<div class="span8 profile-info">
												<h3 style='color: #666;'>
													<?php 
														echo $firstName_P . " " . $lastName_P;
														if($showFollow)
														{
															echo "<button id='followButton' class='btn-seafoam' style='margin-left:20px;'>$followText</button>";
														}
													?>
												</h3>
											
												<ul class="unstyled inline">
													<li style='font-size: 14px; color: #666;' class='dark-gray'><i class="icon-map-marker"></i><?php echo $city_P . ', ' . $state_P;?></li>
													<!--<li><i class="icon-calendar"></i> 18 Jan 1982</li>
													<li><i class="icon-briefcase"></i> Design</li>
													<li><i class="icon-star"></i> Top Seller</li>
													<li><i class="icon-heart"></i> BASE Jumping</li>-->
												</ul>
											</div>

											<!--end span8-->
											<div class="span4">
												<!-- <p>Hello there</p> This is a cool spot to put things like ratings -->
											</div>
											<div class="space10"></div>
											<!--end span4-->
										</div>
										<!--end row-fluid-->
										<div class="tabbable tabbable-custom tabbable-custom-profile">
											<ul class="nav nav-tabs">
												<li class="active"><a href="#tab_1_22" data-toggle="tab">My Shop</a></li>
											
												<!--  <li ><a href="#tab_1_11" data-toggle="tab">Wall</a></li>  not for alpha, shahar edit-->
											</ul>
											<div class="tab-content">
												<div class="tab-pane " id="tab_1_11">
													<div class="tab-pane active">
														<ul class="nav nav-tabs">
															<!--  <li><a href="#wallpost" data-toggle="tab">Comment</a></li>
															<li><a href="#picturepost">Post Picture</a></li>-->
														</ul>
													</div>
												</div>
												<!--tab-pane-->
												<div class="tab-pane active" id="tab_1_22">
													<div class="tab-pane active" id="tab_1_1_1">
														<div class="row-fluid margin-bottom-20" id="rowBlock" style="">
															<div class="span6 booking-blocks" id="itemBlock" style="background-color: #f6f6f6;">
																<div class="pull-left booking-img" style="padding: 5px 0px 5px 5px;width:125px;height:125px;">
																	<div class="center-cropped" id="postPic">
																		<a href="#" id="imageLink"><span class="link-spanner" style="height:100%;width:100%;"></span></a>
																	</div>
																	<!-- <img src="" alt="" id="postPic" style="width:100%;"> -->
																</div>
																<div style="overflow:hidden;padding: 10px 15px 10px 7px;">
																		<h2 ><a href="#" style='font-size: 17px;' id='postSubjectLink'></a></h2>
																		<!-- <h3 id="postPrice"></h3> -->
																	<div style="border-top: 1px solid grey;padding-top:5px;">
																		<p style='height: 40px;' id="postDescription"></p>
																	</div>
																</div>
															</div>

														</div>
													</div>
												</div>
												<!--tab-pane-->
											</div>
										</div>
									</div>
									<!--end span9-->
								</div>
								<!--end tab-pane-->
							</div>
						</div>
						<!--END TABS-->
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
	<!-- BEGIN PAGE LEVEL SCRIPTS -->  
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
	<script type='text/javascript' src='https://cdn.firebase.com/v0/firebase.js'></script>          
    <script src="../globalref/header/js/notifications.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/following.js"></script>
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
         $("#theFile:file").change(function(){
			$('#update-photo-form').submit();
		});
      });
    </script>       
		<!-- END PAGE LEVEL SCRIPTS -->  
	</body>
</html>
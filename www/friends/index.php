<?php
	session_start();
	require("../../assets/php/globalref/sqlconf.php");
	require('../../assets/php/globalref/lock.php');
	require("../../assets/php/globalref/get_user_info.php");
	require("../../assets/php/friends/header.php");
	//mysqli_close($con);
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title><?php echo "$firstName's "; ?>Friends</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/css/squarecrop.css" rel="stylesheet" type="text/css"> 
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons/css/glyphicons.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/css/custom.css" rel="stylesheet" type="text/css" id="style_color"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES --> 
	<link href="../globalref/metronic1.4/admin/template_content/assets/css/pages/search.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
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
						
						<?php
							if($firstName == $currentName)
							{
								echo "<h3 class='page-title'>";
								echo	"Your Network <small>view your connections</small>";
								echo "</h3>";
							} //if	
							else
							{
								$current_user_id = $_GET['user'];
								echo "<h3 class='page-title'>";
								echo	"$currentName's Network <small>connect with more people</small>";
								echo "</h3>";
							} //else
						?>
						
						<ul class="breadcrumb">
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					
						</div>
					</div>
					<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="tabbable tabbable-custom tabbable-full-width">
						<ul class="nav nav-tabs">
							<li <?php if(!$followersTabState) echo "class='active'";?>><a data-toggle="tab" href="#tab_1_3">Following</a></li>
							<li <?php if($followersTabState) echo "class='active'";?>><a data-toggle="tab" href="#tab_1_2">Followers</a></li>
						</ul>
						<div class="tab-content">
							<div id="tab_1_2" class="tab-pane <?php if($followersTabState) echo "active";?>">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="" method="get">
										<div class="chat-form">
											<div class="input-cont">
												<input type="hidden" name="tab" value="followers">   
												<input type="text" placeholder="Search..." class="m-wrap" value='<?php if ($qExists && $followersTabState) echo $_GET['q'];?>' name="q"/>
												<input type="hidden" name="user" value='<?php echo $user_id_F; ?>'/>
											</div>
											<button type="button" class="btn-seafoam">Search &nbsp; <i class="m-icon-swapright m-icon-white"></i></button>
										</div>
									</form>
								</div>
								<?php 
									//require("../../assets/php/globalref/sqlconf.php");
									require('../../assets/php/friends/follower.php');
									//mysqli_close($con);
								/*	if($qExists && $followersTabState)
									{
										$queryArray = explode(" ", $_GET['q']);
										
										while($temp = mysqli_fetch_row($followers))
										{
											$query = "SELECT User_PK,FirstName,LastName,ProfilePicture,City,State FROM Users WHERE User_PK='$temp[0]'";
											$name_result = mysqli_query($con,$query);
											$name_row = mysqli_fetch_array($name_result);
												
											$followerUser_ID = $name_row['User_PK'];
											$followerFirstName = $name_row['FirstName'];
											$followerLastName = $name_row['LastName'];
											$followerProfilePicture = $name_row['ProfilePicture'];
											$followerCity = $name_row['City'];
											$followerState = $name_row['State'];
										
											// preg_grep is a case insensitive in_array function
											if(preg_grep("/$followerFirstName/i", $queryArray) || preg_grep("/$followerLastName/i", $queryArray))
											{
												echo "<div class='row-fluid portfolio-block'>";
												echo "	<div class='span5 portfolio-text'>";
												echo 		"<div class='center-cropped' style=\"width:70px;height:70px;background-image: url('php/image_proxy.php?image=".$followerProfilePicture."');display:inline-block;vertical-align:top;\">";
												echo			"<a href='/profile/?user=$followerUser_ID'><span class='link-spanner' style='height:100%;width:100%;'></span></a>";
												echo		"</div>";
												//echo "		<a href='/profile/?user=$followerUser_ID'><img src='$followerProfilePicture' alt='' style='height:70px;width:70px;'/></a>";
												echo "		<div class='portfolio-text-info' style='display:inline-block;vertical-align:top;padding-left:10px;'>";
												echo "			<h4>$followerFirstName "."$followerLastName</h4>";
												echo "			<p>$followerCity, $followerState</p>";
												echo "		</div>";
												echo "	</div>";
												//echo "</div>";
												if($session_id != $followerUser_ID)
												{
													$query = "SELECT COUNT(*) AS count FROM Users_Users WHERE User1_FK = '$sessionUser_id' AND User2_FK = '$followerUser_ID'";
													$result_ifFollowing = mysqli_query($con,$query);
													$row_ifFollowing = mysqli_fetch_array($result_ifFollowing);
														
													if($row_ifFollowing['count'] == 0)
													{
														echo 	"<div style='float: right; margin-right: 5px; margin-bottom: 5px; margin-top: 17px;'>";
														echo 		"<button id='follow-button' name='$followerUser_ID' class='btn blue'>Follow</button>";
														echo 	"</div>";
													}
												}
												echo "</div>";
											}
										}// end while
									}// end if
									else 
									{
										while($temp = mysqli_fetch_row($followers))
										{
											$query = "SELECT User_PK,FirstName,LastName,ProfilePicture,City,State FROM Users WHERE User_PK='$temp[0]'";
											$name_result = mysqli_query($con,$query);
											$name_row = mysqli_fetch_array($name_result);
										
											$followerUser_ID = $name_row['User_PK'];
											$followerFirstName = $name_row['FirstName'];
											$followerLastName = $name_row['LastName'];
											$followerProfilePicture = $name_row['ProfilePicture'];
											$followerCity = $name_row['City'];
											$followerState = $name_row['State'];
										
											echo "<div class='row-fluid portfolio-block' id=''>";
											echo "	<div class='span5 portfolio-text'>";
											echo 		"<div class='center-cropped' style=\"width:70px;height:70px;background-image: url('php/image_proxy.php?image=".$followerProfilePicture."');display:inline-block;vertical-align:top;\">";
											echo			"<a href='/profile/?user=$followerUser_ID'><span class='link-spanner' style='height:100%;width:100%;'></span></a>";
											echo		"</div>";
											//echo "		<a href='/profile/?user=$followerUser_ID'><img src='$followerProfilePicture' alt='' style='height:70px;width:70px;'/></a>";
											echo "		<div class='portfolio-text-info' style='display:inline-block;vertical-align:top;padding-left:10px;'>";
											echo "			<h4>$followerFirstName "."$followerLastName</h4>";
											echo "			<p>$followerCity, $followerState</p>";
											echo "		</div>";
											echo "	</div>";
											//echo "</div>";
											if($sessionUser_id != $followerUser_ID)
											{
												$query = "SELECT COUNT(*) AS count FROM Users_Users WHERE User1_FK = '$sessionUser_id' AND User2_FK = '$followerUser_ID'";
												$result_ifFollowing = mysqli_query($con,$query);
												$row_ifFollowing = mysqli_fetch_array($result_ifFollowing);
													
												if($row_ifFollowing['count'] == 0)
												{
													echo 	"<div style='float: right; margin-right: 5px; margin-bottom: 5px; margin-top: 17px;'>";
													echo 		"<button id='follow-button' name='$followerUser_ID' class='btn blue'>Follow</button>";
													echo 	"</div>";
												}
											}
											echo "</div>";
										}// end while
									}// end else
								*/
									?>
								<div class="space5"></div>
								<!--<div class="pagination pagination-right">
									<ul>
										<li><a href="#">Prev</a></li>
										<li><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li class="active"><a href="#">3</a></li>
										<li><a href="#">4</a></li>
										<li><a href="#">5</a></li>
										<li><a href="#">Next</a></li>
									</ul>
								</div>-->
							</div>
							<!--end tab-pane-->
							<div id="tab_1_3" class="tab-pane <?php if(!$followersTabState) echo "active";?>">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="" method="get">
										<div class="chat-form">
											<div class="input-cont">   
												<input type="hidden" name="tab" value="following">  
												<input type="text" placeholder="Search..." class="m-wrap" value='<?php if ($qExists && !$followersTabState) echo $_GET['q'];?>' name='q'/>
												<input type="hidden" name="user" value='<?php echo $user_id_F; ?>'/>
											</div>
											<button type="button" class="btn-seafoam">Search &nbsp; <i class="m-icon-swapright m-icon-white"></i></button>
										</div>
									</form>
								</div>
								<?php 
								//require("../../assets/php/globalref/sqlconf.php");
								require('../../assets/php/friends/following.php');
								//mysqli_close($con);
								
									/*if($qExists && !$followersTabState)
									{
										$queryArray = explode(" ", $_GET['q']);
										
										while($temp = mysqli_fetch_row($following))
										{
											$query = "SELECT User_PK,FirstName,LastName,ProfilePicture,City,State FROM Users WHERE User_PK='$temp[1]'";
											$name_result = mysqli_query($con,$query);
											$name_row = mysqli_fetch_array($name_result);
												
											$followingUser_ID = $name_row['User_PK'];
											$followingFirstName = $name_row['FirstName'];
											$followingLastName = $name_row['LastName'];
											$followingProfilePicture = $name_row['ProfilePicture'];
											$followingCity = $name_row['City'];
											$followingState = $name_row['State'];
										
											// preg_grep is a case insensitive in_array function
											if(preg_grep("/$followingFirstName/i", $queryArray) || preg_grep("/$followingLastName/i", $queryArray))
											{
												echo "<div class='row-fluid portfolio-block'>";
												echo "	<div class='span5 portfolio-text'>";
												echo 		"<div class='center-cropped' style=\"width:70px;height:70px;background-image: url('php/image_proxy.php?image=".$followingProfilePicture."');display:inline-block;vertical-align:top;\">";
												echo			"<a href='/profile/?user=$followingUser_ID'><span class='link-spanner' style='height:100%;width:100%;'></span></a>";
												echo		"</div>";
												//echo "		<a href='/profile/?user=$followingUser_ID'><img src='$followingProfilePicture' alt='' style='height:70px;width:70px;'/></a>";
												echo "		<div class='portfolio-text-info' style='display:inline-block;vertical-align:top;padding-left:10px;'>";
												echo "			<h4>$followingFirstName "."$followingLastName</h4>";
												echo "			<p>$followingCity, $followingState</p>";
												echo "		</div>";
												echo "	</div>";
												//echo "</div>";
												if($sessionUser_id != $followingUser_ID)
												{
													$query = "SELECT COUNT(*) AS count FROM Users_Users WHERE User1_FK = '$sessionUser_id' AND User2_FK = '$followingUser_ID'";
													$result_ifFollowing = mysqli_query($con,$query);
													$row_ifFollowing = mysqli_fetch_array($result_ifFollowing);
														
													if($row_ifFollowing['count'] == 0)
													{
														echo 	"<div style='float: right; margin-right: 5px; margin-bottom: 5px; margin-top: 17px;'>";
														echo 		"<button id='follow-button' name='$followingUser_ID' class='btn blue'>Follow</button>";
														echo 	"</div>";
													}
												}
												echo "</div>";
											}
										}// end while
									}// end if
									else 
									{
										while($temp = mysqli_fetch_row($following))
										{
											$query = "SELECT User_PK,FirstName,LastName,ProfilePicture,City,State FROM Users WHERE User_PK='$temp[1]'";
											$name_result = mysqli_query($con,$query);
											$name_row = mysqli_fetch_array($name_result);
										
											$followingUser_ID = $name_row['User_PK'];
											$followingFirstName = $name_row['FirstName'];
											$followingLastName = $name_row['LastName'];
											$followingProfilePicture = $name_row['ProfilePicture'];
											$followingCity = $name_row['City'];
											$followingState = $name_row['State'];
										
											echo "<div class='row-fluid portfolio-block' id='following-$followingUser_ID'>";
											echo "	<div class='span5 portfolio-text'>";
											echo 		"<div class='center-cropped' style=\"width:70px;height:70px;background-image: url('php/image_proxy.php?image=".$followingProfilePicture."');display:inline-block;vertical-align:top;\">";
											echo			"<a href='/profile/?user=$followingUser_ID'><span class='link-spanner' style='height:100%;width:100%;'></span></a>";
											echo		"</div>";
											//echo "		<a href='/profile/?user=$followingUser_ID'><img src='$followingProfilePicture' alt='' style='height:70px;width:70px;'/></a>";
											echo "		<div class='portfolio-text-info' style='display:inline-block;vertical-align:top;padding-left:10px;'>";
											echo "			<h4>$followingFirstName "."$followingLastName</h4>";
											echo "			<p>$followingCity, $followingState</p>";
											echo "		</div>";
											echo "	</div>";
											
											if($sessionUser_id != $followingUser_ID)
											{
												$query = "SELECT COUNT(*) AS count FROM Users_Users WHERE User1_FK = '$sessionUser_id' AND User2_FK = '$followingUser_ID'";
												$result_ifFollowing = mysqli_query($con,$query);
												$row_ifFollowing = mysqli_fetch_array($result_ifFollowing);
												
												if($row_ifFollowing['count'] == 0)
												{
													echo 	"<div style='float: right; margin-right: 5px; margin-bottom: 5px; margin-top: 17px;'>";
													echo 		"<button id='follow-button' name='$followingUser_ID' class='btn blue'>Follow</button>";
													echo 	"</div>";
												}
											}
											echo "</div>";
										}// end while
									}// end else
								*/
								?>
								<div class="space5"></div>
								<!--<div class="pagination pagination-right">
									<ul>
										<li><a href="#">Prev</a></li>
										<li><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li class="active"><a href="#">3</a></li>
										<li><a href="#">4</a></li>
										<li><a href="#">5</a></li>
										<li><a href="#">Next</a></li>
									</ul>
								</div>-->
							</div>
							<!--end tab-pane-->
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
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
	<!--<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/fancybox/source/jquery.fancybox.pack.js"></script>-->
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js"></script>
	<script type='text/javascript' src='https://cdn.firebase.com/v0/firebase.js'></script>      
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/search.js"></script>       
    <script src="../globalref/header/js/notifications.js" type="text/javascript"></script>
    <script src="js/unfollow.js" type="text/javascript"></script>
    <script src="js/following.js" type="text/javascript"></script>
   <!-- END PAGE LEVEL SCRIPTS -->      
	<script>
		jQuery(document).ready(function() {    
		   App.init();
		   Search.init();
		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
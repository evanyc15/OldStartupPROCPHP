<?php
session_start();
require('../../assets/php/globalref/sqlconf.php');
require('../../assets/php/globalref/lock.php');
require("../../assets/php/globalref/get_user_info.php");
require("../../assets/php/preferences/header.php");
//mysqli_close($con);
	//Account by Shahar
$flag = 0;
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>Anilum | Your Prefrences</title>
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
    <script type="text/javascript" src="js/search.js"></script> 
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL STYLES --> 
	<!-- **********************************************SELECT2 IMPLEMENTATION**************************************** -->
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2_metro.css" />
	<!-- **********************************************SELECT2 IMPLEMENTATION**************************************** -->
	<link rel="shortcut icon" href="favicon.ico" />
	<link href="../globalref/css/tutorial.css" rel="stylesheet" type="text/css"/>
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
							Personal <small>Account</small>
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
						<!-- BEGIN SAMPLE FORM PORTLET-->   
						<div class="portlet box tabbable" style="background:#73b3ac; border:1px #73b3ac solid;">
							<!-- BEGIN PORTLET TITLE -->
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-reorder"></i>
									<span class="hidden-480">Account</span>
								</div>
							</div>
							<!-- END PORTLET TITLE -->
							<!-- BEGIN PORTLET BODY -->
							<div class="portlet-body form">
								<!-- BEGIN TAB FORM -->
								<div class="tabbable portlet-tabs">
									<ul class="nav nav-tabs">
										<li><a href="#portlet_tab2" data-toggle="tab" >Privacy</a></li>
										<li><a href="#portlet_tab3" data-toggle="tab">Password</a></li>
										<li class="active"><a href="#portlet_tab1" data-toggle="tab">General</a></li>
									</ul>
									<!-- BEGIN TAB CONTENT -->
									<div class="tab-content">
										<!-- BEGIN TAB 1 -->
										<div class="tab-pane active" id="portlet_tab1">
											<!-- BEGIN FORM-->
											<form method="post" action="php/update_personal.php" class="form-horizontal">
												<!-- BEGIN FIRST NAME INPUT -->
												<div class="control-group">
													<label class="control-label">First Name</label>
													<div class="controls">
														<input id="first" type="text" name="firstname_text" placeholder= "First Name" value="<?php echo $firstName;?>"  class="m-wrap medium" />														
													</div>
												</div>
												<!-- END FIRST NAME INPUT -->
												<!-- BEGIN LAST NAME INPUT -->
												<div class="control-group">
													<label class="control-label">Last Name</label>
													<div class="controls">
														<input id="last" type="text" name="lastname_text" placeholder= "Last Name" value="<?php echo $lastName;?>" class="m-wrap medium" />
													</div>
												</div>
												<!-- END LAST NAME INPUT -->
												<!-- BEGIN EMAIL INPUT -->
												<div class="control-group">
													<label class="control-label">Email Address</label>
													<div class="controls">
														<input id="email" type="text" name="email_text" placeholder= "Email Address" value="<?php echo $email;?>" class="m-wrap medium" />
													</div>
												</div>
												<!-- END EMAIL INPUT -->
												<!-- BEGIN CITY INPUT -->
												<div class="control-group">
													<label class="control-label">City</label>
													<div class="controls">
														<input id="city" type="text" name="city_text" placeholder= "City" value="<?php echo $city;?>" class="m-wrap medium" />
													</div>
												</div>
												<!-- END CITY INPUT -->
												<!-- *****************************SELECT2 IMPLEMENTATION *********************************************-->
												<!-- BEGIN STATE INPUT -->
												<div class="control-group">
													<label class="control-label">State</label>
													<div class="controls">
														<select id="select2_sample1" class="span6 select2" name = "state_text" style="width: 220px;">
															<?php
																for($i = 0; $i < 50; ++$i)
																{
																	if($state == $states[$i])
																	{
																		echo $selected[$i];
																	} //if
																	else
																	{
																		echo $not_selected[$i];
																	} //else
																} //for
															?>
														</select>
													</div>
												</div>
												<!-- END STATE INPUT -->
												<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
												<!-- BEGIN METRONIC BIRTHDATE INPUT -->
												<div class="control-group">
													<label class="control-label">Birthdate</label>
													<div class="controls">
														<input class="span6 m-wrap medium" id="mask_date2" type="text" name="birth_text_new" value="<?php 
														if(isset($birthdate))
														{
															echo $birthdate;
														}
														/*else
														{
															echo "";
														}*/
														?>
														"/>
													</div>
												</div>
												<!-- END METRONIC BIRTHDATE INPUT -->
												<!-- BEGIN GENDER INPUT -->
												<div class="control-group">
													<label class="control-label">Gender</label>
													<div class="controls">
														<label class="radio line">
														<input type="radio" name="optionsRadios2" value="M" <?php echo $gender[0]; ?>/>
														Male 
														</label>
														
														<label class="radio line">
														<input type="radio" name="optionsRadios2" value="F" <?php echo $gender[1]; ?>/>
														Female
														</label>
													</div>
												</div>
												<!-- END GENDER INPUT -->
												
												<?php
												//Will be used to check for email validation
												// Begin Hidden Validate -->
													$query = "SELECT Validation,Isvalid FROM Users WHERE User_PK = '$user_id'";
													$result = mysqli_query($con, $query);
													$row = mysqli_fetch_array($result);
													$validate = $row['Validation'];//contains code from email
													$isvalid = $row['Isvalid'];//everyone is invalid by default
													
													if($isvalid == 0)
													{
														echo '<div class="control-group">';
														echo'<label class="control-label">Validate Email</label>';
														echo'<div class="controls">';	
														if(isset($_GET['code']))
														{
															$isvalid = 1;
															$query = "UPDATE Users SET Isvalid = '$isvalid' WHERE User_PK = '$user_id'";
															$result = mysqli_query($con, $query);
															echo'<input id="validate" type="text" disabled name="validate_text" placeholder = "Validate in Email" value="Validated!" class="m-wrap medium" />';
															
														}
														
														else
														{
															
															echo'<input id="validate" type="text" disabled name="validate_text" placeholder= "Validate in Email" value="Click the link we sent you." class="m-wrap medium" />';
															
															//<!-- BEGIN Resend email button BUTTON -->
															echo '<button id = "resend-button" type = "button" class="btn-seafoam"><i class="icon-ok"></i>Resend Email</button>';		
														}
														
														echo'</div>';
														echo '</div>';

													}
												
												else 
												{
													echo'<input id="validate" type="text" disabled name="validate_text" placeholder = "Validate in Email" value="Validated!" class="m-wrap medium" />';
														
												}
												
												//<!-- End Hidden Validate -->
												?>
												
												<!-- BEGIN SUBMIT BUTTON -->
												<div class="form-actions">
													<button name = "submit" type="submit" class="btn-seafoam"><i class="icon-ok"></i>Submit</button>
													<button type="button" class="btn-gray">Cancel</button>
												</div>
												<!-- END SUBMITE BUTTON -->
											</form>
											<!-- END FORM-->  
										</div>
										<!-- END TAB 1 -->
										
										
										<!-- BEGIN TAB 2 -->
										<div class="tab-pane " id="portlet_tab3">
											<h4>Change Password</h4>
											<form method="post" action="php/change_password.php">
											<?php 	
												if($flag == 1)
												{
	 											echo "<font color='red'>Incorrect password, try again.</font>";
												}
												echo '<input type="password" name="password_old_text" class="m-wrap medium" placeholder="Current Password" /><br />';
												echo '<input type="password" name="password_new_text" class="m-wrap medium" placeholder="New Password" /><br />';
												echo '<input type="password" name="password_new_confirm" class="m-wrap medium" placeholder="Confirm Password" /><br/>';
												echo '<button type="submit" name ="change" class="btn-seafoam">Change</button>';
											?>
											</form>
											<hr/>
										</div>
										<!-- END TAB 2 -->
										
										<!-- BEGIN TAB 3 -->
										<div class="tab-pane " id="portlet_tab2">
											<label class="control-label"></label>
											<!-- BEGIN FORM-->
											<form method="post" action="php/update_privacy.php" class="form-horizontal">
												<!-- BEGIN SHOW BIRTHDAY -->
												<div class="control-group">
													<label class="control-label">Display Birthday</label>
													<div class="controls">
														<div class="switch" data-on="primary" data-off="info">
															<input type="checkbox" name="birthday" value = "1" checked class="toggle"/>
														</div>
													</div>	
												</div>
												<!-- END SHOW BIRTHDAY -->
												
												<!-- BEGIN SHOW GENDER -->
												<div class="control-group">
													<label class="control-label">Display Gender</label>
													<div class="controls">
														<div class="switch" data-on="primary" data-off="info">
															<input type="checkbox" name="gender" value = "1" checked class="toggle"/>
														</div>
													</div>	
												</div>
												<!-- END SHOW GENDER -->
												<!-- BEGIN SUBMIT BUTTON -->
												<div class="form-actions">
													<button name = "submit" type="submit" class="btn-seafoam"><i class="icon-ok"></i>Submit</button>
												</div>
												<!-- END SUBMITE BUTTON -->
											</form>
											<!-- END FORM -->
										</div>
										<!-- END TAB 3 -->
									</div>
									<!-- END TAB CONTENT -->
								</div>
								<!-- END TAB FORM -->
							</div>
							<!-- END PORTLET-->
						</div>	
						<!-- END PORTLET BODY -->				
					</div>
					<!-- END SAMPLE FORM PORTLET-->
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
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src='https://cdn.firebase.com/v0/firebase.js' type='text/javascript'></script>
    <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js" type="text/javascript"></script>         
	<script src="../globalref/header/js/notifications.js" type="text/javascript"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js" type="text/javascript"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>   
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery.input-ip-address-control-1.0.min.js" type="text/javascript" ></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript" ></script>   
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-switch/static/js/bootstrap-switch.js" type="text/javascript" ></script>
	<!-- **********************************************SELECT2 IMPLEMENTATION**************************************** -->
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2.min.js" type="text/javascript"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" type="text/javascript"></script>
	<!-- **********************************************SELECT2 IMPLEMENTATION**************************************** -->
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<!-- **********************************************SELECT2 IMPLEMENTATION**************************************** -->
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js" type="text/javascript"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/form-components.js" type="text/javascript"></script>     
	<!-- **********************************************SELECT2 IMPLEMENTATION**************************************** -->
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->   
	<script src="js/preferences.js" type="text/javascript"></script>    
	<!-- END PAGE LEVEL SCRIPTS -->
	<script>
	jQuery(document).ready(function() {       
	   // initiate layout and plugins
	   App.init();
	   FormComponents.init();
	});
	</script>
	<!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>
<?php
	session_start();
	require("../../assets/php/globalref/sqlconf.php");
	require('../../assets/php/globalref/lock.php');
	require("../../assets/php/globalref/get_user_info.php");
	//mysqli_close($con);
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
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/css/themes/custom.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons/css/glyphicons.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES --> 
	<link href="../globalref/metronic1.4/admin/template_content/assets/css/pages/search.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2_metro.css" />

	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
	<style>
		.personImg
		{
			width:30px;
			height:30px;
			display:inline-block;
			margin-right:10px;
		}
		.personText
		{
			display:inline-block;
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
<!-- BEGIN PAGE TITLE-->
						<h3 class="page-title">
							Discover Folks <small>find your favorite friends &amp; peddlers</small>
						</h3>
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
							<!-- <li class="active"><a data-toggle="tab" href="#tab_1_5">User Search </a></li> -->
						</ul>
						<div id="tab_1_5" class="tab-pane">
							<form action="" method="GET">
								<div class="control-group">
									<label class="control-label">Search</label>
									<div class="controls">
										<input type="hidden" id="select2-sample2" class="span6 select2" value="">
									</div>
								</div>
							</form>
							<!--<div class="row-fluid search-forms search-default">
								<div class="form-search">
									<div class="chat-form">
										<div class="input-cont">   
											<input id="input-search" type="text" placeholder="Search..." class="m-wrap" value=""/>
										</div>
										<button type="button" class="btn green">Search &nbsp; <i class="m-icon-swapright m-icon-white"></i></button>
									</div>
									<div class="control-group">
											<label class="control-label">Search</label>
											<div class="controls">
												<input type="hidden" id="searchBox" class="span6 select2" value="">
											</div>
									</div>
								</div>
							</div>-->
							<!--<div class="portlet-body">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>Photo</th>
											<th>Name</th>
											<th>Location</th>
											<th></th>
										</tr>
									</thead>
									<tbody class="search-user-body">
										<tr class="search-user-row">
											<td id="first-d"><a href=""><img src="" alt='' style='width:100px; height:100px;'/></a></td>
											<td id="second-d"></td>
											<td id="third-d"></td>
											<td><a class='btn red-stripe' href='#'>Follow</a></td>
										</tr>
									</tbody>
								</table>
							</div>-->
							<div class="space5"></div>
						</div>
						<!--end tab-pane-->
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
   	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js"></script>
	<script type='text/javascript' src='https://cdn.firebase.com/v0/firebase.js'></script>      
	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/search.js"></script>
	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-tags-input/jquery.tagsinput.min.js" type="text/javascript" ></script>       
    <script src="../globalref/header/js/notifications.js" type="text/javascript"></script>
    <script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2.js"></script>
    <script src="../globalref/metronic1.4/admin/template_content/assets/scripts/form-components.js"></script>
    <script src="js/search.js" type="text/javascript"></script>
   <!-- END PAGE LEVEL SCRIPTS --> 
    <script>
	    jQuery(document).ready(function() {    
	         App.init(); // initlayout and core plugins
	   		
	   		$('#select2-sample2').select2(
	   		{
	   			width: "100%",
	   			formatResult: resultLayout,
	   			query: function (query) {
		                var data = {results: []};
			                $.ajax({
			                	type: 'GET',
			                	url: 'php/get_searched.php',
			                	dataType: 'json',
			                	data: {searchdata: '\'' + query.term  + '\''},
			                	success: function(response)
			                	{
				                		for(var i=0;i < response.length;i++)
				                			//data.results.push({id: "\"" + response[i]['Tag'] + "\"",text: "\"" + response[i]['Tag'] + "\""});
				                			data.results.push({id: response[i]['User_PK'],text: response[i]['FirstName'] + ' ' + response[i]['LastName'], picture: response[i]['ProfilePicture']});
				     					
				                		query.callback(data);
			                	}
			             	});
			            }
	   		});

	   		$('#select2-sample2').on("select2-selecting",function(e)
	   		{
	   			window.location = "../profile/?user=" + e.val;
	   		});
	   		function resultLayout(tag)
	   		{
	   			var markup = "";
	   			if(tag.picture != undefined)
	   			{
	   				markup += "<img class='personImg' src='" + tag.picture + "'/>"; 
	   			}
	   			if(tag.text != "")
	   			{
	   				markup += "<p class='personText'>" + tag.text + "</p>";
	   			}

	   			return markup;
	   		}
	    });
    </script>
  <!-- END JAVASCRIPTS -->
</body>
</html>
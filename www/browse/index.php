<?php
	session_start();
	require('../../assets/php/globalref/sqlconf.php');
	require("../../assets/php/globalref/get_user_info.php");
	require("../../assets/php/globalref/lock.php");

    if($newUser == 1)
    {
	  require("../../assets/php/globalref/tutorials.php");
	  if($tutorialCount >= 5)
		updateNewUser($user_id_Tut, $con);
    } //if
	//mysqli_close($con);
	//Check if there browse has a type, if not, set type to 'browse'
	if(empty($_GET['type']))
	{
		$getdata = "browse";
		header('Location: /browse/?type=browse');
	}
	else{
		$getdata = $_GET['type']; //$getdata holds what page to load according to the type
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <script type="text/javascript">
		var q = "";
		<?php
			echo "var type= '" . $getdata . "';";
			if (isset($_GET['q']))
				echo "q= '" . $_GET['q'] . "';"; //q is used as another url parameter to signify the word being searched while in browse
			echo "var userID = {$_SESSION['id']}";
		?>
   </script>
   <meta charset="utf-8" />
   <title>Anilum Marketplace</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <!-- BEGIN GLOBAL MANDATORY STYLES -->
   
   <link href="../globalref/wookmark/css/reset.css" rel="stylesheet" text="text/css" />
   
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/css/style-metro.css" rel="stylesheet" type="text/css" />
   <link href="../globalref/css/style.css" rel="stylesheet" type="text/css" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/css/style-responsive.css" rel="stylesheet" type="text/css" />
   <link href="../globalref/css/custom.css" rel="stylesheet" type="text/css" id="style_color" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
   <link href="../globalref/css/tutorial.css" rel="stylesheet" type="text/css" />
  
  <link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-datepicker/css/datepicker.css" />
  
   <!-- END GLOBAL MANDATORY STYLES -->
   <link href="../globalref/css/squarecrop.css" rel="stylesheet" type="text/css"> 
   <!-- END GLOBAL MANDATORY STYLES -->
   <!-- BEGIN PAGE LEVEL STYLES --> 
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons/css/glyphicons.css" rel="stylesheet" type="text/css"/>
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2_metro.css" rel="stylesheet" type="text/css" />
   <!-- BEGIN SELET2 STYLES -->
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-multi-select/css/multi-select-metro.css" rel="stylesheet" type="text/css" />
   <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-tags-input/jquery.tagsinput.css" rel="stylesheet" type="text/css" />
   <!-- END SELECT2 STYLES -->
   <!-- BEGIN WOOKMARK STYLES -->
   <!-- CSS Reset -->
  <!-- <link href="../globalref/wookmark/css/reset.css" rel="stylesheet" text="text/css" /> THIS FIXED THE SIDEBAR ISSUE AND DID NOT SEEM TO CAUSE ANY OTHER PROBLEMS -->
   <!-- Global CSS for the page and tiles -->
   <link href="../globalref/wookmark/css/main.css" rel="stylesheet" text="text/css" />
   <link href="../globalref/fancybox/source/jquery.fancybox.css?v=2.1.5" rel="stylesheet" text="text/css" />
   <!-- END WOOKMARK STYLES -->
   <link href="css/style.css" rel="stylesheet" text="text/css" />
   <!-- END PAGE LEVEL STYLES -->
   <link rel="shortcut icon" href="favicon.ico" />
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
	   
	   .opacity-level {
	   		opacity: .4;
	   }
   </style>
</head>
<body class="page-header-fixed page-boxed <?php if($getdata == 'browse') echo 'page-full-width';?>"> <!--If the person requested the browse page, make the page have no sidebar-->
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
			<?php if($getdata != 'browse') require("../globalref/sidebar/index.php");?> <!--SIDEBAR-->
			<!-- END SIDEBAR -->
			<!-- BEGIN PAGE -->
			<div class="page-content">
				<!-- BEGIN PAGE CONTAINER-->
				<div class="container-fluid" style="">
					<!-- BEGIN PAGE HEADER-->
					<div class="row-fluid">
						<div class="span12">
							<?php //Tutorial code
								require('../../assets/php/globalref/sqlconf.php');
								if($getdata == "browse" && ($newUser == 1 && $browseTutorial == 1))
								{
									echo "<div class='blackout'></div>";
									echo 	"<div id='box-1' class='tutorial-box'>";
									echo 			"<p class='title-1'>Shopping...</p>";
									echo 		"<div class='inner-box'>";
									echo 			"<p class='body-text'>It's everyone's favorite thing!  Casually browse for items or actively search for things to buy.  Our site searches by keywords so you can find exactly what your are looking for!</p>";
									echo 			"<p class='signature'>When you've finished poking around, type \"grumpycat\" into the search bar and make an offer for the internet's most infamous kitty!</p>";
									echo 			"<div>";
									echo 				"<button id='button-1' class='btn-seafoam bottom-right' style='z-index: 1001;'><i class='icon-check'></i> Got It!</button>";
									echo 			"</div>";
									echo 		"</div>";
									echo 	"</div>";
									
								} //if
							?>
							<!-- BEGIN PAGE TITLE & BREADCRUMB-->
							<?php 
								if($getdata == 'browse') //If the user requests the browse page, change the heading appropriately
								{
									echo '<h3 class="page-title">';
									echo '	Marketplace <small>surf the market</small>';
									echo '</h3>';
									echo '<ul class="breadcrumb">';
									echo '</ul>';
								}// end if
								else if ($getdata == 'bookmarks')
								{
									echo '<h3 class="page-title">';
									echo '	Bookmarks <small>stalk and cop the best</small>';
									echo '</h3>';
									echo '<ul class="breadcrumb">';
									echo '</ul>';
								}// end else
							?>
							<!-- END PAGE TITLE & BREADCRUMB-->
						</div>
					</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN PAGE CONTENT-->
					<div class="row-fluid" id="container">
						<div class="span12" style="padding-left:0px;">
							<?php //Tutorial code
								if($newUser == 1 && $browseTutorial == 1)
								{
									updateTutorials("BrowseTutorial", $user_id_Tut, $con);
									tutorialCounter($user_id_Tut, $tutorialCount, $con);
									
									echo	"<div id='alert' class='alert alert-info' style='font-size: 15px;'>";
									echo		"<button class='close' data-dismiss='alert'></button>";
									echo		"<strong>Search using Tags</strong> to find what you want.  When you are ready, type <b>\"grumpycat\"</b> into the search bar to find the <b>meanest cat in town</b>!";
									echo	"</div>";
								} //if
							?>
							
							<?php 
								if($getdata != 'newsfeed')
								{
									$q = "";
									if (isset($_GET['q']))
										$q = $_GET['q'];
									
									echo '<div class="span6" style="margin-bottom:10px;">';
										echo '<form action="" method="get">';
											echo '<div class="control-group">';
												echo '<label class="control-label">Search by Tags </label>';
												echo '<div class="controls">';
													echo '<input type="text" id="" value="'.$q.'"class="m-wrap span12" name="q"/>';
													echo '<input type="hidden" value="'.$getdata.'" class="m-wrap span12" name="type"/>';
													//echo '<input type="text" id="tags" class="m-wrap span12 select2" multiple>';
												echo '</div>';
											echo '</div>';
										echo '</form>';
									echo '</div>';
								}
							?>
							
							<div id="main" class="span12" role="main">
								<ul id="tiles">
        							<!-- These is where we place content loaded from the Wookmark API -->
      							</ul>

      							<div id="loader">
        							<div id="loaderCircle"><img id="load-spinner" src="../images/ajaxSpinner.gif"></div>
      							</div>

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
   	<!--<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
   	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>-->
   	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-2.0.3.js"></script>
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
   	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2.min.js"></script>
   	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>   
   	<script src="../globalref/metronic1.4/admin/template_content/assets/plugins/jquery-tags-input/jquery.tagsinput.min.js" type="text/javascript" ></script>
   	<!-- END CORE PLUGINS -->
   	<!-- BEGIN PAGE LEVEL SCRIPTS -->
   	<script src="../globalref/metronic1.4/admin/template_content/assets/scripts/app.js" type="text/javascript"></script>    
   	<script src="../globalref/header/js/notifications.js" type="text/javascript"></script>
   	<!-- END PAGE LEVEL SCRIPTS -->  
   	<!-- **********************************************SELECT2 IMPLEMENTATION**************************************** -->
   	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2.min.js"></script>
   	<script type="text/javascript" src="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
   	<!-- **********************************************SELECT2 IMPLEMENTATION**************************************** -->
   	<script type='text/javascript' src='https://cdn.firebase.com/v0/firebase.js'></script>
   	<!-- END PAGE LEVEL PLUGINS -->
   	<!-- BEGIN PAGE LEVEL SCRIPTS -->
   	<!-- Include the imagesLoaded plug-in -->
   	<script src="../globalref/wookmark/libs/jquery.imagesloaded.js"></script>
   	<script src="js/bookmark_like.js" type='text/javascript'></script>
   	<!-- Include the plug-in -->
   	<script src="../globalref/wookmark/jquery.wookmark.js"></script>
   	<script type="text/javascript" src="../globalref/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
   	<!-- Once the page is loaded, initalize the plug-in. -->
	<script type="text/javascript">
		// Set the size depending on page
		var size = 260;// default size browse
		var dbUrl = "php/get_popular.php";// default url browse
		
		if(type=="newsfeed")
		{
		    size = 400;
		    dbUrl = "php/get_news.php";
		}// end if newsfeed
		else if(type=="bookmarks")
		{
			size = 290;
		    dbUrl = "php/get_bookmarks.php";
		}// end if bookmarks
	  
    	var handler = null,
        	page = 0,
        	isLoading = false,
        	apiURL = dbUrl;

    	// Prepare layout options.
    	var options = {
      		autoResize: true, // This will auto-update the layout when the browser window is resized.
      		container: $('#main'), // Optional, used for some extra CSS styling
      		offset: 2, // Optional, the distance between grid items
      		temWidth: size + 10, // Optional, the width of a grid item
		};// end options
	    
    	// On document ready
    	(function ($) {
    		$('.fancybox').fancybox();
      		/**
       		* When scrolled all the way to the bottom, add more tiles.
       		*/
      		function onScroll(event) {
        		// Only check when we're not still waiting for data.
        		if(!isLoading) 
        		{
          			// Check if we're within 100 pixels of the bottom edge of the broser window.
          			var closeToBottom = ($(window).scrollTop() + $(window).height() > $(document).height() - 100);
          			if(closeToBottom) 
          			{
            			loadData();
          			}// end if (closeToBottom)
        		}// end if (!isLoading)
     	 	};// end onScroll(event)

      		/**
       		* Refreshes the layout.
       		*/
      		function applyLayout() {
        		options.container.imagesLoaded(function() {
          			// Create a new layout handler when images have loaded.
          			handler = $('#tiles li');
          			handler.wookmark(options);
        		});// end imagesLoaded
      		};// end applyLayout

      		/**
       		* Loads data from the API.
       		*/
      		function loadData() {
        		isLoading = true;
        		$('#loaderCircle').show();
        		$.ajax({
          			url: apiURL,
          			type: "get",
          			dataType: 'json',
          			data: {page: page, tags: q}, // Page parameter to make sure we load new data
          			success: onLoadData
        		});// end ajax
      		};// end loadData

      		/**
       		* Receives data from the API, creates HTML for images and updates the layout
       		*/
      		function onLoadData(data){
        		isLoading = false;
        		$('#loaderCircle').hide();
        		// Increment page index for future calls.
        		page++;

        		// Create HTML for the images.
        		var html = '';
        		var length=data.length, image;
        		for(var i=0; i<length; i++) //length represents the number of items retrieved
        		{
		          	image = data[i];
				  	var bookmarkstatus = "color-1";// Represents the initial color of the bookmark button
				  	var likestatus = "color-1 icon-heart-empty";// Represents the initial color/icon of like
				  	if (image.bookmarkstatus)// If already bookmarked, then make seafoam green
					  	bookmarkstatus = "color-2";
				  	if (image.likestatus)// If already liked, then make seafoam green
						likestatus = "color-2 icon-heart";
						
					var highlight = "#dedede";
					var starred = "";
						
					if (type=="bookmarks" && image.offerstatus == "has been <strong style=\"color:#73b3ac;\">accepted</strong>!")
					{
						highlight = "#73b3ac"
						starred = "icon-star";
					}
		          	html += '<li id="entire-post" class="picture" style="border-color:'+highlight+';margin-bottom: 5px;width:'+size+'px;cursor: default;height:"'+Math.round(image.height/image.width*(size))+'px;">';
				  	// Include the ability to like and bookmark only if they are not the owner of the current post
		          	//html += '<i class ="'+starred+'" style="color:#fff;font-size:24px;position: absolute; margin: 15px 0px 0px 16px;"></i>';
		          	
		          	
		          	
		          	if(image.posterid != userID) //Don't display things that the user posted
		          	{
				  		html += "<div id='button-container' style='width:"+size+"px;'>";
				  		html += 	"<button id='bookmark-background' style='border-right:solid 1px "+highlight+";'><a href='#' id='bookmark-btn' style='text-decoration: none;'><i name='"+image.id+"' class='"+bookmarkstatus+" icon-bookmark'></i></a></button>";
				  		html += 	"<button id='like-background'><a href='#' id='like-btn' style='text-decoration: none;'><i name='"+image.id+"' class='"+likestatus+"'></i></a></button>";
				  		html += "</div>";
		          	} // if
			      	html += 	"<a class='fancybox fancybox.ajax' " + 'href="'+image.url+'">';
		          	// Image tag (preview in Wookmark are 200px wide, so we calculate the height based on that).
		          	html += 		'<img src="'+image.preview+'" width="'+(size-20)+'" height="'+Math.round(image.height/image.width*(size-20))+'" style="padding: 10px 10px 0px 10px;">';
		          	html += 	'</a>';
		          	// Image title.
		          	html += 	'<p style="margin-left:10px;margin-right:10px;font-size:14px;">'+image.title+'<p>';
		          	html += 	'<hr style="margin: 0px -5px 10px -5px;border-color:'+highlight+';"/>';
		          	// Poster picture
		          	html += 	'<a href="'+image.poster+'"><div class="profile-image center-cropped" style="background-image:url('+"'"+image.profilepicture+"'"+');width:30px; height:30px;"></div></a>';
		          	// Poster name
		          	html +=		'<div style="display:inline-block; vertical-align:top;margin-top:-2px;">';
		          	html += 		'<a href="'+image.poster+'" style="text-decoration:none;"><p style="margin-top:0;margin-bottom:0;">'+image.name+'</p></a>';
		          	html += 		'<p style="font-style:italic;margin-top:-4px;font-size:11px;">'+image.location+'</p>';
		          	html +=		'</div>';
		          	html +=		'<div style="float:right;display:inline-block;vertical-aligh:top;margin:-6px 10px 5px 0px;color:#666;">';
		          	html +=   		'<h3 style="color:#666;display:inline-block;margin:0;">{</h3>';
		          	html +=			'<h4 style="color:#666;display:inline-block;margin:0;">$'+image.price+'</h4>';
		          	html +=			'<h3 style="color:#666;display:inline-block;margin:0;">}</h3>';
		          	html +=		'</div>';
		          	// For bookmarks
		          	if (type=="bookmarks" && image.offer != null)
		          	{
		          		html += '<hr style="margin: 5px -5px 10px -5px;border-color:'+highlight+';"/>';
		          		html += '<p style="margin: 0px 10px 5px 10px;font-size:12px;font-style:italic;">Your offer of $'+image.offer+' '+image.offerstatus+'<p>';
		          	}// end if bookmarks
          			html += '</li>';
        		}// end for

        		// Add image HTML to the page.
        		$('#tiles').append(html);

        		// Apply layout.
        		applyLayout();
      		};// end onLoadData

      		// Capture scroll event.
      		$(document).bind('scroll', onScroll);

      		// Load first data from the API.
			loadData();
    
			App.init(); // initlayout and core plugins

	  		// Begin tutorial js
      		$('#alert').hide();
	  		$('#button-1').live('click', function(){
		  		$('#box-1').slideUp('slow');
				$('.blackout').fadeOut(1500);
				$('#alert').fadeIn(2500);
			});// end onClick

		// Click functions for like and bookmark on each tile
		bookmarkLikeStatus();
		
		/*$('a.itemBlock').fancybox({
			type:'iframe',
			hideOnContentClick: true
		});*/
		
	    /*$.fancybox({
	    	content: $(window.location.hash).html(),
	    	hideOnContentClick: true
	    });
	    $('.fancybox').fancybox();*/
		})(jQuery);// end onDocumentReady
	</script>  
</body>
</html>
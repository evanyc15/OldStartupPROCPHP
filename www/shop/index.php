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

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <script type="text/javascript">
		var q = ""; //q stands for "query"
		<?php
			echo "var type='browse';";
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
	   
	   #d1 {
  display: table;
  width: 100%;
    background-color: red;
    padding: 10px;
    overflow: scroll;
   /* height: 220px; */
}

#d2, #d3 {
  display: table-cell;
  padding: 8px;
}

#d2 {
    background-color: green;
}

#d3 {
  width: 100%;
    background-color: orange;
}

#d4 {
    width: 100px;
   /* height: 100px; */
    background-color: blue;
}
   </style>
</head>
<body class="page-header-fixed page-boxed"> <!--If the person requested the browse page, make the page have no sidebar-->
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
				<div class="container-fluid" style="">
					<!-- BEGIN PAGE HEADER-->
					<div class="row-fluid">
						<div class="span12">
							
							<!-- BEGIN PAGE TITLE & BREADCRUMB-->
								<h3 class="page-title">
								Your Shop <small>edit your items for sale</small>
								</h3>
								<ul class="breadcrumb">
								</ul>
								
							<!-- END PAGE TITLE & BREADCRUMB-->
						</div>
					</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN PAGE CONTENT-->
					<div class="row-fluid" id="container">
						<div class="span12" style="padding-left:0px;">
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
		var dbUrl = "php/get_shop.php";// default url browse
		
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
      		function loadData() { //get's loaded every time you scroll to the bottom of the page
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
				  	var soldstatus = "color-1";// Represents the initial color of the bookmark button
				  	var likestatus = "color-1 icon-heart-empty";// Represents the initial color/icon of like
				  	if (image.soldstatus)// If already bookmarked, then make seafoam green
					  	soldstatus = "color-2";
				  	if (image.likestatus)// If already liked, then make seafoam green
						likestatus = "color-2 icon-heart";
						
					var highlight = "#dedede";
					var starred = "";
						
					
		          	html += '<li id="entire-post" class="picture" style="border-color:'+highlight+';margin-bottom: 5px;width:100%;cursor: default;height:"'+Math.round(image.height/image.width*(size))+'px; overflow: scroll;">';
				  	// Include the ability to like and bookmark only if they are not the owner of the current post
		          	//html += '<i class ="'+starred+'" style="color:#fff;font-size:24px;position: absolute; margin: 15px 0px 0px 16px;"></i>';
		          	//var scrollWidth = $("#entire-post").width() - size;
		          	//html += "<h1>"+scrollWidth+"</h1>";
		          	
			
			        
				/*    html += "<div style='width: 100%; height: "+Math.round(image.height/image.width*(size-20))+"px; vertical-align: top; background-color: green; display: table;'>";
				        html += "<div style='display: table-cell; background-color: orange; width: 205px;height: "+Math.round(image.height/image.width*(size-20))+"px;'>"
				      		html += "<div id='button-container' style='width:"+size+"px;'>";
					  		html += 	"<button id='bookmark-background' style='border-right:solid 1px "+highlight+";'><a href='#' id='bookmark-btn' style='text-decoration: none;'><i name='"+image.id+"' class='"+soldstatus+" icon-bookmark'></i></a></button>";
					  		html += 	"<button id='like-background'><a href='#' id='like-btn' style='text-decoration: none;'><i name='"+image.id+"' class='"+likestatus+"'></i></a></button>";
					  		html += "</div>";
					      	
					      	html += '<div style="display: inline-block;">'
					      	html += 	"<a class='fancybox fancybox.ajax' " + 'href="'+image.url+'">';
				          	// Image tag (preview in Wookmark are 200px wide, so we calculate the height based on that).
				          	html += 		'<img src="'+image.preview+'" width="'+(size-20)+'" height="'+Math.round(image.height/image.width*(size-20))+'" style="display: inline-block; padding: 10px 10px 0px 10px;">';
				          	html += 	'</a>';
				          	//html += 	'<div style="display: inline-block; overflow: scroll; height: '+Math.round(image.height/image.width*(size-20))+'px; width: 100px; background-color: red; margin: 10px 10px 0px 10px;">';
				          	//html += 	'</div>';
				          	html += '</div>'
				          	// Image title.
				          	html += 	'<p style="margin-left:10px;margin-right:10px;font-size:14px;">'+image.title+'<p>';
				          	html += 	'<hr style="margin: 0px -5px 10px -5px;border-color:'+highlight+';"/>';
				          	// Poster picture
				          	// Poster name
				          	html +=		'<div style="display:inline-block; vertical-align:top;margin-top:-2px;">';
				          	html += 		'<p style="font-style:italic;margin-top:-4px;font-size:11px;">'+image.location+'</p>';
				          	html +=		'</div>';
				          	html +=		'<div style="float:right;display:inline-block;vertical-aligh:top;margin:-6px 10px 5px 0px;color:#666;">';
				          	html +=   		'<h3 style="color:#666;display:inline-block;margin:0;">{</h3>';
				          	html +=			'<h4 style="color:#666;display:inline-block;margin:0;">$'+image.price+'</h4>';
				          	html +=			'<h3 style="color:#666;display:inline-block;margin:0;">}</h3>';
				          	html +=		'</div>';
				        html += 	"</div>";
	 					
	 					html += 	"<div style='display: table-cell; height: 100%; width: 500px; background-color: yellow;'>";
				        html += 	"</div>";
				     html += "</div>";*/
			        
		          	html += "<div id='d1' style='height="+Math.round(image.height/image.width*(size-20))+"px;'>";
					    html += "<div id='d2'>";
					        html += "<div id='d4'>";
					            html += "<img src='"+image.preview+"' style='width:'"+(size-20)+"px; height:"+Math.round(image.height/image.width*(size-20))+"px;'/>";
					        html += "</div>";
					    html += "</div>";
					    html += "<div id='d3'>";
					    html += "</div>";
					html += "</div>";
		          	
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
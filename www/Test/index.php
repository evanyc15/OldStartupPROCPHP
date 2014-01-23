<!DOCTYPE html>
<head>
	<link href='../globalref/fancybox/source/jquery.fancybox.css' rel="stylesheet" type="text/css"/>
	<link href='../globalref/fancybox/source/helpers/jquery.fancybox-thumbs.css' rel="stylesheet" type="text/css"/>
	<script src='../globalref/fancybox/source/helpers/jquery.fancybox-thumbs.css' type="text/javascript"/>
	<script type="text/javascript" src='../globalref/fancybox/lib/jquery-1.10.1.min.js'></script>
	<script type="text/javascript" src='../globalref/fancybox/lib/jquery-1.9.0.min.js'></script>
	<script type="text/javascript" src='../globalref/fancybox/lib/jquery.mousewheel-3.0.6.pack.js'></script>
	
	
	
	<!-- Add jQuery library -->
	<script type="text/javascript" src="../globalref/fancybox/lib/jquery-1.10.1.min.js"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="../globalref/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="../globalref/fancybox/source/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="../globalref/fancybox/source/jquery.fancybox.css" media="screen" />
	
	
	
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */
		});
	</script>
	
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}

		body {
			max-width: 700px;
			margin: 0 auto;
		}
	</style>
	
</head>

<body>
	<a href="#">Hey there people</a>
	<a class='fancybox' data-fancybox-group='gallery' href='http://images.ethicalocean.com/splash2_files/turtle.jpg'>
		<img src='http://images.ethicalocean.com/splash2_files/turtle.jpg' style='height: 50%; width: 50%;'>
	</a>
</body>
</html>
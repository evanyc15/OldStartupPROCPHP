<?php include "../globalref/header/index.php";?>
<!DOCTYPE html>
<html>
<head>
	<title>Post to Anilum</title>
	<link rel="stylesheet" href="style.css" type="text/css">
	<link rel="stylesheet" href="css/dropzone.css" type="text/css">
	<script src="../globalref/js/jquery-1.7.1.min.js"></script>
	<script src="js/jquery.autosize-min.js"></script>
	<script src="js/dropzone.js"></script>
</head>
<body>
	<script>
		$(document).ready(function() {
		    var text_max = 350;
		    $('#charnum').html(text_max + ' characters remaining');
		    $('#chars').keyup(function() {
		        var text_length = $('#chars').val().length;
		        var text_remaining = text_max - text_length;
		        $('#charnum').html(text_remaining + ' characters remaining');
		    });
		});
	</script>
	<script>
			$(function(){
				$(".border-box,#chars,#book_3,.description").autosize({append: "\n"});
			});
	</script>
	<div class="border-box">
		<div id="dropzone">
			<form action="http://www.torrentplease.com/dropzone.php" class="dropzone" id="my-awesome-dropzone"></form>
		</div>
	<table id="table2">
		<tr>
			<td width="600px"></td>
			<td width="300px"></td>
			<td><button id="backtoPost" type="button" OnClick="window.location.href='index.php'">Done</button></td>
		</tr>
	</table>
	</div>
</body>
</html>
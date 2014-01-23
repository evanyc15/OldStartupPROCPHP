<!DOCTYPE html>
<html>
<head>
  <title>This is a test!</title>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="chrome=1">
  <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
  <link href='docs/assets/style.css' rel='stylesheet' type='text/css'>
  <link href='jquery.mentionsInput.css' rel='stylesheet' type='text/css'>
</head>

<body>
<div class="examples">
	<textarea class="mention"></textarea>
</div>


<!--<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-27763738-1']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>-->
<script src="../metronic1.4/admin/template_content/assets/plugins/jquery-2.0.3.js" type="text/javascript"></script>
<script src="../underscore.js" type="text/javascript"></script>
<!--<script src='lib/jquery.events.input.js' type='text/javascript'></script>-->
<script src='lib/jquery.elastic.js' type='text/javascript'></script>
<script src='jquery.mentionsInput.js' type='text/javascript'></script>

<script>
	$('textarea.mention').mentionsInput({
	  onDataRequest:function (mode, query, callback)
	  {
	    $.ajax(
	    {
	    	type: 'GET',
	    	url: 'get_mentions.php',
	    	dataType: 'json',
	    	data: {input: query},
	    	success: function(response)
	    	{
	    		console.log(response);
	    		/*var data = _.filter(data, function(item)
	    					{ 
	    						return item.Tag.toLowerCase().indexOf(query.toLowerCase()) > -1 
	    					});*/
	   			callback.call(this, response);
	    	}
	    });

	  }
	});
</script>
<!--<script src='docs/assets/examples.js' type='text/javascript'></script>
<script src='docs/example2.js' type='text/javascript'></script>-->

</body>
</html>
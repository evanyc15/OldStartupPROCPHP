<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
   <title>Anilum</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <!-- BEGIN PAGE LEVEL STYLES --> 
	 <link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons/css/glyphicons.css" rel="stylesheet" />
	<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/glyphicons_halflings/css/halflings.css" rel="stylesheet" /> 
	
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/select2/select2_metro.css" />
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />

	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css"/>
	<link rel="stylesheet" type="text/css" href="../globalref/metronic1.4/admin/template_content/assets/plugins/bootstrap-editable/inputs-ext/address/address.css"/>

   <!--<link href="../globalref/metronic1.4/admin/template_content/assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" media="screen"/>-->
   
   
  <link href='../globalref/mentions-input/jquery.mentionsInput.css' rel='stylesheet' type='text/css'>
   <!-- END PAGE LEVEL STYLES -->
   <link rel="shortcut icon" href="favicon.ico" />
</head>
<body>
<!-- BEGIN SAMPLE FORM PORTLET--> 
<div class="portlet box tabbable" style="border: solid 1px #73b3ac;background:#73b3ac;">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-reorder"></i>
			<span class="hidden-480">Sell Your Stuff</span>
		</div>
	</div>
	<div class="portlet-body form">
		<div class="tabbable portlet-tabs">
			<ul class="nav nav-tabs">
				<!-- <li><a href="#portlet_tab3" data-toggle="tab">Inline</a></li>
				<li><a href="#portlet_tab2" data-toggle="tab">Status</a></li> -->
				<li class="active"><a href="#portlet_tab1" data-toggle="tab">Sell</a></li>
			</ul>
			<div class="tab-content">
				<!-- This is tab number 1 -->
				<div class="tab-pane active" id="portlet_tab1">
					<!-- BEGIN FORM-->
					<form action="/globalref/sell/php/upload_sell.php" id="sell" method="POST" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validateForm_sell()">
						<div class="control-group">
							<label class="control-label">Title</label>
							<div class="controls">
								<input id="subject-input" type="text" maxlength="80" name="subject" placeholder="Title and Price" class="m-wrap large" />
								<i id="title-error" style="display: inline-block; padding-left: 9px; padding-top: 7px; color: red;"></i>
								<span class="help-inline"></span> <!-- you can add some text next to the text box! -->
								<!-- Hello ! -->
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Description</label>
							<div class="controls" style="">
								<div class="large m-wrap" style="">
									<textarea id="description-input" class="large m-wrap" name="description" maxlength="350" placeholder="Tell consumers about your item..." rows="3" style="resize: none; height: 125px; width: 320px;"></textarea>
								</div>
								<div id="charnum"></div>
							</div>
						</div>
						<div class="control-group" style="margin-top:-20px;">
							<div class="controls">
								<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
								<a href="#" class="glyphicons no-js camera" onclick="performClick(document.getElementById('theFile'));"><i></i></a>
								<!--<a href="#" class="glyphicons no-js google_maps" id=""><i></i></a>NEED TO IMPLEMENT http://jsfiddle.net/tt9MC/
																														http://jsfiddle.net/UGWWA/2/-->
								<a href="#" id="address" data-type="address" data-original-title="Please, fill address"><i></i></a>
								<input type="hidden" value="" name="address" id="sellerAddress" />
								<input type="hidden" value="" name="latitude" id="latitude"/>
								<input type="hidden" value="" name="longitude" id="longitude"/>
								<input type="file" id="theFile" name="file[]" style="position:fixed;top:-1000px" multiple/>
								<i id="location-error" style="display: inline-block; padding-left: 9px; padding-top: 7px; color: red;"></i>
							</div>
						</div>
						<div class="form-actions">
							<button id="submit-button" type="submit" class="btn " style="background:#73b3ac;"><i class="icon-ok"></i>Submit</button>
							<button type="button" class="btn">Cancel</button>
							<i id="description-error" style="display: inline-block; padding-left: 13px; color: red;"></i>
						</div>
					</form>
					<!-- END FORM-->  
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- END SAMPLE FORM PORTLET-->
</body>

</html>


$(document).ready(function(){
	var onAvailable = false;
	var onSold = false;
	
	$("#availability").live('change', function(){
		var checkbox_post = $(this).attr('name'); //select_name is the same as the CURRENT post ID
		var checkbox_status = $(this).attr('checked');
		
		if(checkbox_status == 'checked')
		{
			//$("#pic-" + checkbox_post).css({ "opacity" : ".2" });
			
			$("#pic-" + checkbox_post).addClass("sold");
			$("#pic-" + checkbox_post).removeClass("not-sold");
			
			if(onAvailable)
				$("#pic-" + checkbox_post).fadeOut(500);
			else
				$("#pic-" + checkbox_post).addClass("opacity-level");
		} //if
		else
		{
			$("#pic-" + checkbox_post).removeClass("opacity-level");
			$("#pic-" + checkbox_post).addClass("not-sold");
			$("#pic-" + checkbox_post).removeClass("sold");
			
			if(onSold)
				$("#pic-" + checkbox_post).fadeOut(500);
		} //else
		
		$.ajax(
		{
			type: 'GET',
			url: 'php/availability.php',
			data: {status: checkbox_status,
					postid: checkbox_post},
			success: function(response)
			{
			}
		});
	});
	
	$("#btn-all").live('click', function(){
		onAvailable = false;
		onSold = false;
		
		$(".sold").addClass("opacity-level");
		
		$("#btn-all").removeClass('gray');
		$("#btn-all").addClass('seafoam');
		
		$("#btn-available").removeClass('seafoam');
		$("#btn-available").addClass('gray');
		
		$("#btn-sold").removeClass('seafoam');
		$("#btn-sold").addClass('gray');
		
		$('.not-sold').css({ 'display':'block' });
		$('.sold').css({ 'display':'block' });
		
		
	});
	
	$("#btn-available").live('click', function(){
		onSold = false;
		onAvailable = true;
		
		$(".sold").addClass("opacity-level");
		
		$("#btn-available").removeClass('gray');
		$("#btn-available").addClass('seafoam');
		
		$("#btn-all").removeClass('seafoam');
		$("#btn-all").addClass('gray');
		
		$("#btn-sold").removeClass('seafoam');
		$("#btn-sold").addClass('gray');
		
		$('.sold').css({ 'display':'none' });
		$('.not-sold').css({ 'display':'block' });
			
	});
	
	$("#btn-sold").live('click', function(){
		onSold = true;
		onAvailable = false;
		$(".sold").removeClass("opacity-level");

		$("#btn-sold").removeClass('gray');
		$("#btn-sold").addClass('seafoam');
		
		$("#btn-available").removeClass('seafoam');
		$("#btn-available").addClass('gray');
		
		$("#btn-all").removeClass('seafoam');
		$("#btn-all").addClass('gray');
		
		$('.not-sold').css({ 'display':'none' });
		$('.sold').css({ 'display':'block' });
				
	});

});
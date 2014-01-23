$(document).ready(function(){
	var $tile_pic = $('#pic-tiles').clone(true,true);
	var current_num = 0;
	$('#pic-tiles').remove();
	$('.button-more').hide();
	$.ajax({
		type: 'GET',
		url: 'php/call_db.php',
		dataType: 'json',
		success: function(response){
			for(var i = 0; i<20;i++){
				if(response[i] != null){
					var image = ".." + response[i][0];
					var $clone_img = $tile_pic.clone(true,true);
					var url = "php/photo.php?id="+response[i][1];
					$clone_img.find('a').colorbox({
						iframe: false,
						href: url,
						width:"950",
						height:"570",
						transition:"elastic"
					});
					$clone_img.find('img').attr({
						src: image
						//alt: url
					});
					$clone_img.find('a').attr("href",url);
					//$('#tiles li img').attr("src",image);
					$('#tiles').append($clone_img);
					$('#hidden-num').text(current_num);
					current_num++;
				}
			}
		}
	});
	
	/*$tile_pic.click(function(){
	//	var imgUrl = $(this).find('img').attr("alt");
		$('.to-colorbox').colorbox({
		});
	});*/
});

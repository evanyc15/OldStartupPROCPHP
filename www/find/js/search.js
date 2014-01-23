/*$(document).ready(function(){
	var $search_row_copy = $('.search-user-body').clone(true,true);
	$('.search-user-body').remove();
	$('#input-search').keypress(function(e){
		if(e.which == 13){
			var temp = $('#input-search').val();
			if(temp != ""){
				$('.search-user-body').remove();
				var searched = temp;
				$.ajax({
					type: 'GET',
					url: 'php/get_searched.php',
					dataType: 'json',
					data: ({'searchdata': searched}),
					async: false,
					success: function(response){
						if(response.length == 0){
							$('#input-search').val('0 results found');
						}
						else{
						for(var i = response.length-1; i >= 0;i--){
							var $copy = $search_row_copy.clone(true,true);
							$copy.find('#first-d a').attr('href','/Profile/?user='+response[i].User_PK);
							$copy.find('#first-d a img').attr('src',response[i].ProfilePicture);
							$copy.find('#second-d').html(response[i].FirstName+" "+response[i].LastName);
							$copy.find('third-d').html(response[i].City+", "+response[i].State);
							$copy.insertAfter('.portlet-body table thead ');
						}
						}	
					}
				});
			}	
		}	
	});
	
	
	
});

*/


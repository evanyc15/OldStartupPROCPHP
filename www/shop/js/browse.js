$(document).ready(function(){
	//Duplicating the tile blocks for later use
	var $tile_pic = $('#picture-boxes').clone(true,true);
	var tiles = $('#tiles');
	var spinner = $('#load-spinner');
	var image;
	var loc;
	var subject;
	//Stores the current tags data
	var next_data;
	var $clone_img;
	
	//Create object that keeps track of the set of tile data being displayed onto the page
	//This object is used to prevent the page from loading all significant tags/data and then
	//loading them in sets to the page. Instead the object allows us to query each time
	//the page bottom is hit.
	var pagecount = new Object();
	pagecount.currentcount = 0;
	pagecount.increment = 8;
	
	//Get type from the $_GET
	pagecount.type = type;
	
	//pagecount.aftercount = 0;
	
	$('#picture-boxes').remove();

	//pagecount.aftercount = 0 + pagecount.increment;
	
	//First ajax call to populate the page with the browse data. This is prior to searching
	if(pagecount.type == "browse"){
		$('#searchtags').show();
		$.ajax({
			type: 'GET',
			url: 'php/call_db.php',
			dataType: 'json',
			data: ({'current': pagecount.currentcount,'increment': pagecount.increment}), //Data contains the range of data
			success: function(response){
				for(var i = 0; i < response.length; i++){
					if(response[i] != null && response[i].Sold == 0){
						image = response[i].Source;
						loc = response[i].Loc
						subject = response[i].Subject;
						$clone_img = $tile_pic.clone(true,true);
						$clone_img.find('img').attr({
							src: 'php/image_proxy.php?image='+image
							//alt: url
						});
						$clone_img.find('#fancybox-out').attr({
							href: '../merch/?pid='+response[i].Post_FK
						})
						$clone_img.find('#tile-subject').text(subject);
						$clone_img.find('#tile-image').css('background-image', 'url(php/image_proxy.php?image=' + response[i].ProfilePic + ')');
						$clone_img.find('#tile-name').text(response[i].Name);
						$clone_img.find('#tile-loc').text(loc);
						//$('#tiles li img').attr("src",image);
						tiles.append($clone_img);
					}
					pagecount.currentcount++; //Increment until for loop is done to create the range of data
				}	
				pagecount.type = "browse"; //Used to determine what data is loaded onscrolling/hitting bottom of page
			},
			complete: function(){
				spinner.hide(); //Load spinner hides
				applyLayout(); //Reapply wookmark layout
			}
		});
	}
	//If the $_GET type was newsfeed
	else if (pagecount.type == "newsfeed"){
		$('#searchtags').hide();
		$('#tiles').empty(); //Empties out all current tiles data
		$.ajax({
			type: 'GET',
			url: 'php/newsfeed.php',
			dataType: 'json',
			data: ({'current': pagecount.currentcount,'increment': pagecount.increment}), //Data contains the range of data
			success: function(response){
				for(var i = 0; i < response.length; i++){
					if(response[i] != null && response[i].Sold == 0){
						image = response[i].Source;
						loc = response[i].Loc
						subject = response[i].Subject;
						$clone_img = $tile_pic.clone(true,true);
						$clone_img.find('img').attr({
							src: 'php/image_proxy.php?image='+image
							//alt: url
						});
						$clone_img.find('#fancybox-out').attr({
							href: '../merch/?pid='+response[i].Post_FK
						})
						$clone_img.find('#tile-subject').text(subject);
						$clone_img.find('#tile-image').css('background-image', 'url(php/image_proxy.php?image=' + response[i].ProfilePic + ')');
						$clone_img.find('#tile-name').text(response[i].Name);
						$clone_img.find('#tile-loc').text(loc);
						//$('#tiles li img').attr("src",image);
						tiles.append($clone_img);
					}
					pagecount.currentcount++; //Increment until for loop is done to create the range of data
				}	
				pagecount.type = "newsfeed"; //Used to determine what data is loaded onscrolling/hitting bottom of page
			},
			complete: function(){
				spinner.hide(); //Load spinner hides
				applyLayout(); //Reapply wookmark layout
			}
		});
	}
	
	//This part is to prevent lag in the window scrolls, it sets a timer and delay
	//IF user is not scrolling then the .scroll won't be running/listening
	var timer = 0,
    delay = 50; //you can tweak this value
	var scrhandler = function() {
	    timer = 0;
	    //Browse the stuff in your current scroll function
	}
	//This function is activated when the bottom of page is hit
	$(window).scroll(function() {
		if (timer) {
        clearTimeout(timer);
        timer = 0;
	    }
	    timer = setTimeout(scrhandler, delay);
	   if($(window).scrollTop() + $(window).height() == $(document).height()) {
	      //pagecount.aftercount = pagecount.aftercount + pagecount.increment;
	      	spinner.show();
			if(pagecount.type == "browse"){			
				$.ajax({
					type: 'GET',
					url: 'php/call_db.php',
					dataType: 'json',
					data: ({'current': pagecount.currentcount,'increment': pagecount.increment}),
					success: function(response){
						if(response.length != 0){
							for(var i = 0; i < response.length; i++){
								if(response[i] != null && response[i].Sold == 0){
									image = response[i].Source;
									loc = response[i].Loc
									subject = response[i].Subject;
									$clone_img = $tile_pic.clone(true,true);
									$clone_img.find('img').attr({
										src: 'php/image_proxy.php?image='+image
										//alt: url
									});
									$clone_img.find('#fancybox-out').attr({
										href: '../merch/?pid='+response[i].Post_FK
									})
									$clone_img.find('#tile-subject').text(subject);
									$clone_img.find('#tile-image').css('background-image', 'url(php/image_proxy.php?image=' + response[i].ProfilePic + ')');
									$clone_img.find('#tile-name').text(response[i].Name);
									$clone_img.find('#tile-loc').text(loc);
									//$('#tiles li img').attr("src",image);
									tiles.append($clone_img);
								}
								pagecount.currentcount++;
							}	
						}
					},
					complete: function(){
						spinner.hide();
						applyLayout(); //Reapply wookmark layout
					}
				});
			}
			else if(pagecount.type == "SearchTag"){
				$.ajax({
   					type: 'GET',
   					url: 'php/filter_by_tags.php',
   					dataType: 'json',
   					data: ({'currentdata': JSON.stringify(next_data),'current': pagecount.currentcount,'increment': pagecount.increment}), //Contains the tag data and data range to be retrieved
   					success: function(response){
   						if(response.length != 0 && response[i].Sold == 0){
	   						for(var i = 0; i < response.length; i++){
								if(response[i] != null){
		       						image = response[i].Source;
									loc = response[i].Loc
									subject = response[i].Subject;
									$clone_img = $tile_pic.clone(true,true);
									$clone_img.find('img').attr({
										src: 'php/image_proxy.php?image='+image
										//alt: url
									});
									$clone_img.find('#fancybox-out').attr({
										href: '../merch/?pid='+response[i].Post_FK
									})
									$clone_img.find('#tile-subject').text(subject);
									$clone_img.find('#tile-image').css('background-image', 'url(php/image_proxy.php?image=' + response[i].ProfilePic + ')');
									$clone_img.find('#tile-name').text(response[i].Name);
									$clone_img.find('#tile-loc').text(loc);
									//$('#tiles li img').attr("src",image);
									tiles.append($clone_img);
								}
								pagecount.currentcount++;
							}
						}
   					},
					complete: function(){
						spinner.hide();
						applyLayout(); //Reapply wookmark layout
					}
   				});
			}	
			else if(pagecount.type == "newsfeed"){
				$.ajax({
					type: 'GET',
					url: 'php/newsfeed.php',
					dataType: 'json',
					data: ({'current': pagecount.currentcount,'increment': pagecount.increment}),
					success: function(response){
						if(response.length != 0){
							for(var i = 0; i < response.length; i++){
								if(response[i] != null && response[i].Sold == 0){
									image = response[i].Source;
									loc = response[i].Loc
									subject = response[i].Subject;
									$clone_img = $tile_pic.clone(true,true);
									$clone_img.find('img').attr({
										src: 'php/image_proxy.php?image='+image
										//alt: url
									});
									$clone_img.find('#fancybox-out').attr({
										href: '../merch/?pid='+response[i].Post_FK
									})
									$clone_img.find('#tile-subject').text(subject);
									$clone_img.find('#tile-image').css('background-image', 'url(php/image_proxy.php?image=' + response[i].ProfilePic + ')');
									$clone_img.find('#tile-name').text(response[i].Name);
									$clone_img.find('#tile-loc').text(loc);
									//$('#tiles li img').attr("src",image);
									tiles.append($clone_img);
								}
								pagecount.currentcount++;
							}	
						}
					},
					complete: function(){
						spinner.hide();
						applyLayout(); //Reapply wookmark layout
					}
				});
				
				
			}
	   }
	});
	/*----------Adding tags--------------*/
   var tags = new Array();
   $("#tags").select2({
   		multiple:true,
        query: function (query) {
            var data = {results: []};
            $.ajax({
            	type: 'GET',
            	url: 'php/get_tags.php',
            	dataType: 'json',
            	data: {currentText: query.term},
            	success: function(response)
            	{
            		for(var i=0;i < response.length;i++)
            			//data.results.push({id: "\"" + response[i]['Tag'] + "\"",text: "\"" + response[i]['Tag'] + "\""});
            			data.results.push({id: response[i]['Tag_ID'],text:response[i]['Tag']});
 					
            		query.callback(data);
            	}
            });
        }
	});   
	
	//When new tags are added/deleted to the Tag Search
	$('#tags').on('change',function(){
		$('#tiles').empty(); //Empties out all current tiles data
		$('#load-spinner').show();
		var tag_data = $(this).select2('data'); //Selects the current tag data
		next_data = tag_data;
		if(tag_data.length == 0){
			pagecount.currentcount = 0;
			//pagecount.aftercount = 0 + pagecount.increment;
			$.ajax({
				type: 'GET',
				url: 'php/call_db.php',
				dataType: 'json',
				data: ({'current': pagecount.currentcount,'increment': pagecount.increment}),
				success: function(response){
					for(var i = 0; i < response.length; i++){
						if(response[i] != null && response[i].Sold == 0){
							image = response[i].Source;
							loc = response[i].Loc
							subject = response[i].Subject;
							$clone_img = $tile_pic.clone(true,true);
							$clone_img.find('img').attr({
								src: 'php/image_proxy.php?image='+image
								//alt: url
							});
							$clone_img.find('#fancybox-out').attr({
								href: '../merch/?pid='+response[i].Post_FK
							})
							$clone_img.find('#tile-subject').text(subject);
							$clone_img.find('#tile-image').css('background-image', 'url(php/image_proxy.php?image=' + response[i].ProfilePic + ')');
							$clone_img.find('#tile-name').text(response[i].Name);
							$clone_img.find('#tile-loc').text(loc);
							//$('#tiles li img').attr("src",image);
							tiles.append($clone_img);
						}
						pagecount.currentcount++;
					}
					pagecount.type = "SearchTag";
				},
				complete: function(){
					spinner.hide();
					applyLayout(); //Reapply wookmark layout
				}
			});
		}
		else{
			//Currently empties all tiles out
			pagecount.currentcount = 0;
			//pagecount.aftercount = 0 + pagecount.increment;
			$.ajax({
				type: 'GET',
				url: 'php/filter_by_tags.php',
				dataType: 'json',
				data: ({'currentdata': JSON.stringify(next_data),'current': pagecount.currentcount,'increment': pagecount.increment}),
				success: function(response){
					for(var i = 0; i < response.length; i++){
						if(response[i] != null && response[i].Sold == 0){
       						image = response[i].Source;
							loc = response[i].Loc
							subject = response[i].Subject;
							$clone_img = $tile_pic.clone(true,true);
							$clone_img.find('img').attr({
								src: 'php/image_proxy.php?image='+image
								//alt: url
							});
							$clone_img.find('#fancybox-out').attr({
								href: '../merch/?pid='+response[i].Post_FK
							})
							$clone_img.find('#tile-subject').text(subject);
							$clone_img.find('#tile-image').css('background-image', 'url(php/image_proxy.php?image=' + response[i].ProfilePic + ')');
							$clone_img.find('#tile-name').text(response[i].Name);
							$clone_img.find('#tile-loc').text(loc);
							//$('#tiles li img').attr("src",image);
							tiles.append($clone_img);
						}
						pagecount.currentcount++;
					}
					pagecount.type = "SearchTag";
				},
				complete: function(){
					spinner.hide();
					applyLayout(); //Reapply wookmark layout
				}
			});
		}
	});
});
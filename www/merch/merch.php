<div class="container">
		<!-- BEGIN CONTAINER -->  
		<div class="page-container row-fluid">
			<!-- BEGIN SIDEBAR -->
			<?php //if($getdata == 'newsfeed') require("../globalref/sidebar/index.php");?> <!--SIDEBAR-->
			<!-- END SIDEBAR -->
			<!-- BEGIN PAGE -->
			<div class="page-content">
				<!-- BEGIN PAGE CONTAINER-->
				<div class="container-fluid">
					<!-- BEGIN PAGE HEADER-->
					<div class="row-fluid">
						<div class="span12">
							<!-- BEGIN PAGE TITLE & BREADCRUMB-->
							<h3 class="page-title">
								<!-- Blog Post <small>blog post samples</small> -->
								<h2><?php echo $subject;?></h2>
							</h3>

							<ul class="breadcrumb">
							</ul>
							<!-- END PAGE TITLE & BREADCRUMB-->
						</div>
					</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN PAGE CONTENT-->
					<div class="row-fluid">
						<div class="span12 blog-page">
					
						<div class="row-fluid">
								<div class="span9 article-block">
									<div class="blog-tag-data" style="position: relative;">
										
										<span id='button-visibility'>   
											<div>
												<?php 
													
													if($alreadyBookmarked && ($irrelevantBookmark == false))
													{
														if($newUser != 1)
															echo "<button style='margin: 5px 0px 0px 5px;' class='text-seafoam btn-white' id='bookmarkButton'>Bookmark <i class='icon-bookmark'></i></button>";
														else
															echo "<button style='margin: 5px 0px 0px 5px;' id='bookmarkButton' class='text-seafoam btn-white popovers' data-trigger='hover' data-container='body' data-placement='right' data-content='You can bookmark posts that you make offers on and view them in Bookmarks' data-original-title='Bookmarking'>Bookmark <i class='icon-bookmark'></i></button>";
													}
													else if(($alreadyBookmarked == false) && ($irrelevantBookmark == false))
													{
														if($newUser != 1)
															echo "<button style='margin: 5px 0px 0px 5px;' class='text-black btn-white' id='bookmarkButton'>Bookmark <i class='icon-bookmark-empty'></i></button>";
														else
															echo "<button style='margin: 5px 0px 0px 5px;' id='bookmarkButton' class='text-black btn-white popovers' data-trigger='hover' data-container='body' data-placement='right' data-content='You can bookmark posts that you make offers on and view them in Bookmarks' data-original-title='Bookmarking'>Bookmark <i class='icon-bookmark-empty'></i></button>";
													}
													
													?> 
													
												<?php
													if($alreadyLiked) 
													{
														if($newUser != 1)
															echo "<button style='margin: 5px 0px 0px 5px;' class='text-seafoam btn-white' id='likeButton'>Like <i class='icon-heart'></i></button>"; 
														else
															echo "<button style='margin: 5px 0px 0px 5px;' id='likeButton'  class='text-seafoam btn-white popovers' data-trigger='hover' data-container='body' data-placement='right' data-content='In the Social Marketplace, Liking posts is a selfless act.  If you see a good deal, help the seller out and Like it!' data-original-title='Liking'>Like <i class='icon-heart'></i></button>";
													} //if
													else 
													{
														if($newUser != 1)
															echo "<button style='margin: 5px 0px 0px 5px;' class='text-black btn-white' id='likeButton'>Like <i class='icon-heart-empty'></i></button>"; 
														else
															echo "<button style='margin: 5px 0px 0px 5px;' id='likeButton'  class='text-black btn-white popovers' data-trigger='hover' data-container='body' data-placement='right' data-content='In the Social Marketplace, Liking posts is a selfless act.  If you see a good deal, help the seller out and Like it!' data-original-title='Liking'>Like <i class='icon-heart-empty'></i></button>";
													} //else
												?> 
												
												<button style='margin: 5px 0px 0px 5px;' class="btn-white">Share <i class="icon-collapse-top"></i></button>
												
												<?php
													$query = "SELECT Post_PK,User_FK FROM Posts WHERE Post_PK = '$postID'";
													$result = mysqli_query($con, $query);
													$row = mysqli_fetch_array($result);
													$poster_id = $row['User_FK'];
													$noBookmark = false;
													if($poster_id == $userID)
													{
														$noBookmark = true;
														echo	"<a style='margin: 5px 5px 5px 5px; float: right;' class='btn red' id='deleteButton' >Delete <i class='icon-remove'></i></a>";
														echo	"<button style='visibility: hidden;margin: 5px 5px 5px 5px; float: right;' class='btn-seafoam' id='yesButton' >Yes <i class='icon-check'></i></button>";
														echo	"<button style='visibility: hidden;margin: 5px 5px 5px 5px; float: right;' class='btn-seafoam' id='noButton' >No <i class='icon-remove'></i></button>";
													} //if
												?>
											</div>	
										</span>
										
										<?php
											echo "<img src='php/image_proxy.php?image=$pictureSrc' alt='' style='width:100%;' id='main_pic'>";
										?>
										<div class="space20"></div>
										<div class="row-fluid">
											<div class="span6">
												<ul class="unstyled inline blog-tags">
												</ul>
											</div>
											<!--<div class="span6 blog-tag-data-inner">
												<ul class="unstyled inline">
													<li><i class="icon-calendar"></i> <a href="#"><?php //echo $dateCreated;?></a></li>
													<li><i class="icon-comments"></i> <a href="#"><?php //echo $comments;?></a></li>
												</ul>
											</div>-->
										</div>
									</div>

									<!--end news-tag-data-->
									<div>
										
										<ul class="unstyled blog-images">
											<!--<li><a href="#"><img class='pictureClick' alt='' src="image_proxy.php?image=8be8f265bc70e8d247acb4eb2c765f340_lg.jpg"></a></li>-->
											<?php
												echo "<li><a href='#'><img class='pictureClick' alt='' src='php/image_proxy.php?image=$pictureSrc'></a></li>";
												while($picture = mysqli_fetch_array($postResult))
												{
													$pictureSrc = $picture['Source'];
													echo "<li><a href='#'><img class='pictureClick' alt='' src='php/image_proxy.php?image=$pictureSrc'></a></li>";
												}
											?>
										</ul>									
									</div>
									<hr>
									<!--end media-->
								</div>
								<!--end span9-->
								<div class="span3 blog-sidebar">
									<!--<h3><?php echo $subject;?></h3> -->
									<?php 
										//echo "<a href='../profile/?user=$posterID' style='display:inline-block;vertical-align:top;margin-bottom:10px;border:1px solid black;'><img src='$sellerPicture' style='width:100px;height:100px;'/></a>";
										echo 	"<div class='center-cropped' style=\"width:43px;height:43px;background-image: url('php/image_proxy.php?image=".$sellerPicture."');display:inline-block;\">";
										echo		"<a href='../profile/?user=$posterID'><span class='link-spanner' style='height:100%;width:100%;'></span></a>";
										echo	"</div>";

									?>
									

									<div style="display:inline-block;margin:0px;">
										<h4 style="margin-left:10px;"><?php echo $firstName . ' ' . $lastName;?></h4>
										<h5 style="margin-left:10px;"><?php echo $city . ', ' . $state; ?></h5>
									</div>

									<div class="space20">
										<i class="icon-calendar"></i> <a href="#"><?php echo $timeCreated;?> &nbsp;</a>
										<i class="icon-comments"></i> <a href="#"><?php echo $comments;?> &nbsp;</a>
										<i class="icon-dollar"></i> <a href="#"><?php echo $offerCount;?></a>
										<div class="space20"></div>
									</div>
									<hr>
									<div class="space20"></div>
									<div class="tabbable tabbable-custom">
										<ul class="nav nav-tabs">
											<li class="active"><a data-toggle="tab" href="#descriptionTab">Description</a></li>
											<li ><a data-toggle="tab" href="#commentsTab">Comments</a></li>
											<li ><a data-toggle="tab" href="#offersTab">Offers</a></li>
										</ul>
										<div class="tab-content">
											<div id="descriptionTab" class="tab-pane active">
												<p><?php echo $description;?></p>
								
												<ul class="unstyled inline sidebar-tags">
												<?php
													for($i = 0;$i < count($tags);$i++)
													{
														echo "<li><a href='/browse/?q={$tags[$i]['Tag']}&type=browse'><i class='icon-tags'></i> {$tags[$i]['Tag']} </a></li>";
													}
												?>
												</ul>
											</div>
											<div id="commentsTab" class="tab-pane">
												<div class="well" id="commentBox" style="padding:0px;width:100%;">
													<div id="nameAndDate">
															<a href='' id="profileLink"><img src='' style='width:30px;height:30px;' id="profileImg" /></a>
															<p id="fullname"><b></b></p>
															<p id="date"></p>
															<p id="comment"></p>
													</div>	
												</div>
												<i id="comment-error" style="text-align: center;display: inline-block; padding: 5px 5px 13px 5px; color: #B80000;"></i>
												<div class="well" id="comment_form">
													<textarea rows="5" style="width:92%;height:50px; resize: none;" name="comments" placeholder='Inquire about the item being sold...'></textarea>
													<input type="hidden" value="" name="pid" />
												</div>
											</div>
											
											<div id="offersTab" class="tab-pane">
													<i id="offer-error" style="text-align: center;display: inline-block; padding: 5px 5px 13px 5px; color: #B80000;"></i>
													<?php
														if($myPost == 0)
															echo "<textarea id='offersInput' rows='3' style='width:82%; height: 50px; resize: none;' placeholder='Make sure to use a Cashtag when you offer...' name='offers'></textarea>";
													?>
													<div id="offersBlock" class="alert alert-info" style="margin-top:5px;margin-bottom:5px;">
														<b id="offerName" style="display:inline-block;"></b><em> has made an offer</em>
													</div>
											</div>
										</div>
										<div class="space20"></div>
								<!--end span3-->
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
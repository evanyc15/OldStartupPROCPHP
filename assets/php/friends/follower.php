<?php 
									if($qExists && $followersTabState)
									{
										$queryArray = explode(" ", $_GET['q']);
										
										while($temp = mysqli_fetch_row($followers))
										{
											$query = "SELECT User_PK,FirstName,LastName,ProfilePicture,City,State FROM Users WHERE User_PK='$temp[0]'";
											$name_result = mysqli_query($con,$query);
											$name_row = mysqli_fetch_array($name_result);
												
											$followerUser_ID = $name_row['User_PK'];
											$followerFirstName = $name_row['FirstName'];
											$followerLastName = $name_row['LastName'];
											$followerProfilePicture = $name_row['ProfilePicture'];
											$followerCity = $name_row['City'];
											$followerState = $name_row['State'];
										
											// preg_grep is a case insensitive in_array function
											if(preg_grep("/$followerFirstName/i", $queryArray) || preg_grep("/$followerLastName/i", $queryArray))
											{
												echo "<div class='row-fluid portfolio-block'>";
												echo "	<div class='span5 portfolio-text'>";
												echo 		"<div class='center-cropped' style=\"width:70px;height:70px;background-image: url('php/image_proxy.php?image=".$followerProfilePicture."');display:inline-block;vertical-align:top;\">";
												echo			"<a href='/profile/?user=$followerUser_ID'><span class='link-spanner' style='height:100%;width:100%;'></span></a>";
												echo		"</div>";
												//echo "		<a href='/profile/?user=$followerUser_ID'><img src='$followerProfilePicture' alt='' style='height:70px;width:70px;'/></a>";
												echo "		<div class='portfolio-text-info' style='display:inline-block;vertical-align:top;padding-left:10px;'>";
												echo "			<h4>$followerFirstName "."$followerLastName</h4>";
												echo "			<p>$followerCity, $followerState</p>";
												echo "		</div>";
												echo "	</div>";
												//echo "</div>";
												if($sessionUser_id != $followerUser_ID)
												{
													$query = "SELECT COUNT(*) AS count FROM Users_Users WHERE User1_FK = '$sessionUser_id' AND User2_FK = '$followerUser_ID'";
													$result_ifFollowing = mysqli_query($con,$query);
													$row_ifFollowing = mysqli_fetch_array($result_ifFollowing);
														
													if($row_ifFollowing['count'] == 0)
													{
														echo 	"<div style='float: right; margin-right: 5px; margin-bottom: 5px; margin-top: 17px;'>";
														echo 		"<button id='follow-button' name='$followerUser_ID' class='btn blue'>Follow</button>";
														echo 	"</div>";
													}
												}
												echo "</div>";
											}
										}// end while
									}// end if
									else 
									{
										while($temp = mysqli_fetch_row($followers))
										{
											$query = "SELECT User_PK,FirstName,LastName,ProfilePicture,City,State FROM Users WHERE User_PK='$temp[0]'";
											$name_result = mysqli_query($con,$query);
											$name_row = mysqli_fetch_array($name_result);
										
											$followerUser_ID = $name_row['User_PK'];
											$followerFirstName = $name_row['FirstName'];
											$followerLastName = $name_row['LastName'];
											$followerProfilePicture = $name_row['ProfilePicture'];
											$followerCity = $name_row['City'];
											$followerState = $name_row['State'];
										
											echo "<div class='row-fluid portfolio-block' id=''>";
											echo "	<div class='span5 portfolio-text'>";
											echo 		"<div class='center-cropped' style=\"width:70px;height:70px;background-image: url('php/image_proxy.php?image=".$followerProfilePicture."');display:inline-block;vertical-align:top;\">";
											echo			"<a href='/profile/?user=$followerUser_ID'><span class='link-spanner' style='height:100%;width:100%;'></span></a>";
											echo		"</div>";
											//echo "		<a href='/profile/?user=$followerUser_ID'><img src='$followerProfilePicture' alt='' style='height:70px;width:70px;'/></a>";
											echo "		<div class='portfolio-text-info' style='display:inline-block;vertical-align:top;padding-left:10px;'>";
											echo "			<h4>$followerFirstName "."$followerLastName</h4>";
											echo "			<p>$followerCity, $followerState</p>";
											echo "		</div>";
											echo "	</div>";
											//echo "</div>";
											if($sessionUser_id != $followerUser_ID)
											{
												$query = "SELECT COUNT(*) AS count FROM Users_Users WHERE User1_FK = '$sessionUser_id' AND User2_FK = '$followerUser_ID'";
												$result_ifFollowing = mysqli_query($con,$query);
												$row_ifFollowing = mysqli_fetch_array($result_ifFollowing);
													
												if($row_ifFollowing['count'] == 0)
												{
													echo 	"<div style='float: right; margin-right: 5px; margin-bottom: 5px; margin-top: 17px;'>";
													echo 		"<button id='follow-button' name='$followerUser_ID' class='btn blue'>Follow</button>";
													echo 	"</div>";
												}
											}
											echo "</div>";
										}// end while
									}// end else
								?>
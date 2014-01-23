<?php 
require('../../assets/php/header/header.php');
//mysqli_close($con);
?>

<script type="text/javascript">
	<?php
		echo "var iduser= '".$_SESSION['id']. "';";
	?>
</script>
<link rel="stylesheet" type="text/css" href="/globalref/css/squarecrop.css" />
<style>
      .center-cropped { 
      
      background-position: center center; 
      background-size: cover;
      background-repeat: no-repeat; 
      position: relative;
      }
      /*Important:*/
    .link-spanner{
      position:absolute; 
      width:100%;
      height:100%;
      top:0;
      left: 0;
      z-index: 1;
      background-image: url('empty.gif');
    }   

</style>

<div class="header navbar navbar-inverse navbar-fixed-top">
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="navbar-inner">
      <div class="container-fluid">
        <!-- BEGIN LOGO -->
        <a class="brand" href="/browse/?type=newsfeed" style="color:white;">
        	<img src="../globalref/images/boxlogo.png" alt="logo" style="height: 23px;width:23px;"/>
        	needname
        </a>
        <!-- END LOGO -->
        <!-- BEGIN HORIZANTAL MENU -->
		<div class="navbar hor-menu hidden-phone hidden-tablet">
			<div class="navbar-inner">
				<ul class="nav">
					<li>
						<a href="/browse/">
						Marketplace
						</a>
					</li>
					<li>
						
						<a href="/sell/">
						Add to Marketplace
						</a>
					</li>
          <li>
            <a href="/suggestions/">
            Suggest and Report
            </a>
          </li>
				</ul>
			</div>
		</div>
        <!-- END HORIZANTAL MENU -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
        <img src="/globalref/metronic1.4/admin/template_content/assets/img/menu-toggler.png" alt="" />
        </a>          
        <!-- END RESPONSIVE MENU TOGGLER -->            
        <!-- BEGIN TOP NAVIGATION MENU -->              
        <ul class="nav pull-right">
          <!-- BEGIN INBOX DROPDOWN -->
		<li class="dropdown" id="header_message_bar">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true" id="message-dropdown">
		  		<i class="icon-comments-alt"></i>
		  		<span class="badge" id="message-badge"></span>
			</a>
			<ul class="dropdown-menu extended notification">
				<li>
					<ul class="dropdown-menu-list scroller" style="height:250px" id="header_message_box">
						<li id="message-insert-box" class="conversation-box" data-messages='0'>
							<a href="#">
                      			<div id="profilePicture" class='center-cropped' style="width:30px;height:30px;background-image: url('');display:inline-block;vertical-align:top;"></div>
                      			<span id="person-name"></span>
  								<span id="message-message" style="display:block;"></span>
                      			<span class="badge" id="message-count-badge"></span>
							</a>
						</li>	
					</ul>
				</li>
				<li class="external">
					<a href="<?php echo "/messages/?user={$_SESSION['id']}";?>">See all Messages <i class="m-icon-swapright"></i></a>
				</li>
			</ul>
		</li>
          <li class="dropdown" id="header_notification_bar">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true" id="notification-dropdown">
            <i class="icon-warning-sign"></i>
            <span class="badge" id="notification-badge"></span>
            </a>
            <ul class="dropdown-menu extended inbox">
              <li>
                <p id="notification-new-messages"></p>
              </li>
              <li>
                <ul class="dropdown-menu-list scroller" style="height:250px" id="header_notification_box">
                  <li id="notification-insert-box">
                    <a href="">
                    <span class="photo"><img id="notification-pfpic" src="" alt="" /></span>
                    <span class="subject">
                    <span class="from" id="notification-name"></span>
                    <span class="time" id="notification-time"></span>
                    </span>
                    <span class="message" id="notification-message"></span>  
                    </a>
                  </li>
                </ul>
              </li>
              <li class="external">
                <a href="../../notifications">See all Notifications <i class="m-icon-swapright"></i></a>
              </li>
            </ul>
          </li>
          <!-- END INBOX DROPDOWN -->
                         
          <!-- BEGIN USER LOGIN DROPDOWN -->
          <li class="dropdown user">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
           	<?php echo "<img alt='' style='width:27px; height:27px;' src='php/image_proxy.php?image=$profilePicture_H' />"; ?> 
            
            <?php
              //echo "<div class='center-cropped' id='postPic' style=\"background-image: url('$profilePicture_H'); height: 27px; width: 27px;\">";
              //echo    "<a href='#' id='imageLink'><span class='link-spanner' style='display: inline-block; height:100%;width:100%;'></span></a>";
              //echo "</div>";
            ?>

            
            <span style="" class="username"><?php echo ' ' . $firstName_H . ' ' . $lastName_H; ?></span>
            <i class="icon-angle-down"></i>
            </a>
            <ul class="dropdown-menu">
              <li><a href="/profile/"><i class="icon-user"></i> My Profile </a></li>
              <li><a href="/preferences/"><i class="icon-tasks"></i> Preferences </a></li>
              <li class="divider"></li>
              <li><a href="/globalref/php/signout.php"><i class="icon-key"></i> Log Out </a></li>
            </ul>
          </li>
          <!-- END USER LOGIN DROPDOWN -->
          <!-- END USER LOGIN DROPDOWN -->
        </ul>
        <!-- END TOP NAVIGATION MENU --> 
      </div>
      <script>
			<?php 
				echo "var userName = '$firstName_H' + ' ' + '$lastName_H';";
			?>
      </script>
    </div>
    <!-- END TOP NAVIGATION BAR -->
  </div>

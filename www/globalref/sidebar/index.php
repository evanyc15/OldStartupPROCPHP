<div class="page-sidebar nav-collapse collapse">
	<!-- BEGIN SIDEBAR MENU -->        
	<ul class="page-sidebar-menu">
		<li>
			<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
			<!--  <div class="sidebar-toggler hidden-phone"></div> This shit is buggy as fuck -shahar -->
			<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
		</li>
		<li>
			<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
			<form action="/browse/" method="GET" class="sidebar-search">
				<div class="input-box">
					<a href="javascript:;" class="remove"></a>
					<input type="text" placeholder="Search..." name="q"/>
					<input type="hidden" value="browse" name="type"/>
					<input type="button" class="submit" value=" " />
				</div>
			</form>
			<!-- END RESPONSIVE QUICK SEARCH FORM -->
		</li>
		<li class="start ">
			<a href="/browse/?type=newsfeed">
			<i class="icon-home"></i> 
			<span class="title">News Feed</span>
			</a>
		</li>
		<li >
			<a href="/myshop/">
			<i class="icon-tags"></i> 
			<span class="title">My Shop</span>
			</a>
		</li>
		<li >
			<a href="/browse/?type=bookmarks">
			<i class="icon-bookmark"></i> 
			<span class="title">Bookmarks</span>
			</a>
		</li>
		<li ><!-- class="active " -->
			<a href="javascript:;">
			<i class="icon-user"></i> 
			<span class="title">Friends</span>
			<!--<span class="selected"></span>-->
			<span class="arrow "></span>
			</a>
			<!-- BUG HERE, need to fix in newsfeed -->
			<ul class="sub-menu" style="">
				<li >
					<a href="/friends/?tab=following">
					Following</a>
				</li>
				<li >
					<a href="/friends/?tab=followers">
					Followers</a>
				</li>
				<li >
					<a href="/find/">
					Discover Folks</a>
				</li>
			</ul>
		</li>
		<li >
			<a href="/interests/">
			<i class="icon-magnet"></i> 
			<span class="title">Interests</span>
			</a>
		</li>
	</ul>
	<!-- END SIDEBAR MENU -->
</div>
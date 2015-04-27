<?php
require_once('core.php');
$User = new User();
$User->setUserSession($_SESSION['id'])->setUserDatas();
?>
<div id="header">

	<div id="homeIcon" class="headerItem">
		<img class="menu clickIcon" src="img/icons/home.png"/>	
	</div>

	<div id="searchIcon" class="headerItem">
		<img class="menu clickIcon" src="img/icons/search.png"/>
		<div class="pointer"></div>
		<div class="subPointer"></div>
		<div class="subMenu" id="subSearch">
			<form>
				<input id="searchBox" type="text" value="" placeholder="Search"/>
				<input id="searchBoxSubmit" type="submit" value=""/>	
			</form>	
		</div>
	</div>

	<img id="profileIcon" class="headerItem clickIcon" src=<?php $User->get('profilePic'); ?> />

	<div id="chatIcon" class="headerItem">
		<img class="menu clickIcon" src="img/icons/chat.png"/>
	</div>

	<div id="friendsIcon" class="headerItem">
		<img class="menu clickIcon" src="img/icons/friends.png"/>
	</div>	

	<div id="configIcon" class="headerItem">
		<img class="menu clickIcon" src='img/icons/config.png' />
		<div class="pointer"></div>
		<div class="subPointer"></div>
		<ul class="subMenu" id="subConfig">
			<li class="subMenuItem clickString">Edit Profile</li>
			<hr>
			<li class="subMenuItem clickString">Privacy</li>
			<li class="subMenuItem clickString">Security</li>
			<hr>
			<li class="subMenuItem clickString">Report bug</li>
		</ul>
	</div>

		
	<a href="logout.php">
		<div id="logoutIcon" class="headerItem">
			<img class="menu clickIcon" src="img/icons/logout.png"/>
		</div>
	</a>

</div>
<!-- /header-->

<div>
<?php require_once('page.php');?>
</div>
		









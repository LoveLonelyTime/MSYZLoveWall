<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<!-- Brand -->
	<a class="navbar-brand" href="/index.php">
		<img src="/img/logo.svg" width="30" height="30" class="d-inline-block align-top" alt="Logo"/>
		密山一中表白墙
	</a>
	<!-- Toggler Button -->
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false">
		<span class="navbar-toggler-icon"></span>
	</button>
	<!-- Content -->
	<div class="collapse navbar-collapse" id="navbarContent">
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
			<li class="nav-item <?php if(defined("INDEX_LOVE_WALL")){echo "active";} ?>">
				<a class="nav-link color-transition" href="/index.php"><i class="fas fa-heart"></i>表白墙</a>
			</li>
			<li class="nav-item <?php if(defined("INDEX_NIGHT_SAY")){echo "active";} ?>">
				<a class="nav-link color-transition" href="#"><i class="fas fa-moon"></i>深夜说</a>
			</li>
			<li class="nav-item <?php if(defined("INDEX_ABOUT")){echo "active";} ?>">
				<a class="nav-link color-transition" href="#"><i class="fas fa-at"></i>关于TA</a>
			</li>
		</ul>
		<?php 
		if(isset($_SESSION['user'])){
		?>
		<!-- User -->
		<span class="navbar-text">
			<?php 
			$connection = mysql_connect(DATABASE_SERVER_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
			if($connection){
				mysql_set_charset('utf8');
				mysql_select_db(DATABASE_NAME, $connection);
				$id = $_SESSION['user'];
				$result = mysql_query("SELECT username,header FROM user WHERE id = $id");
				$row = mysql_fetch_array($result);
				$username = $row['username'];
				$header = $row['header'];
			?>
			<a class="mr-3" href="/user.php">
				<img src=<?php echo $header; ?> alt="Header" class="rounded-circle" width="30" height="30"/>
				<span><?php echo $username; ?></span>
			</a>
			<?php
			}
			mysql_close($connection);
			?>
			<a href="/handler/logoutHandler.php"><i class="fas fa-sign-out-alt"></i>登出</a>
		</span>
		<?php 
		}else{
		?>
		<!-- Login -->
		<span class="navbar-text">
			<a href="/login.php"><i class="fas fa-sign-in-alt"></i>登录</a>
		</span>
		<?php 
		}
		?>
	</div>
</nav>
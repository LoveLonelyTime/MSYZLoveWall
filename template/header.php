<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<!-- Brand -->
	<a class="navbar-brand" href="#">
		<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo"/>
		密山一中表白墙 Love For You
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
	</div>
</nav>
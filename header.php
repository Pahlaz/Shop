<header>
	<!-- MENU BUTTON -->
	<div class="toggle-btn">
		<span></span>
	</div>
	
	<!-- LOGO -->
	<a href="index.php" class="logo">SHOP</a>

	<!-- LOGGED IN ACCOUNT MENU -->
	<div class="account">
		<img class="profile-pic" src="assets/img/user.png">
		<div class="menu">
			<ul>
				<li class="username">Welcome! <?php session_start(); echo $_SESSION["shopusername"]; ?></li>
				<li><a href="user_profile.php">Profile</a></li>
				<li id="logout">
					<form action="logout.php" method="post">
						<input type="submit" name="logout" value="Logout" />	
					</form>
				</li>
			</ul>
		</div>
	</div>

	<!-- NAVIGATION LIST -->
	<ul class="nav">
		<li id="login"><a href="signin.php" title="Log In">Log In</a></li>
		<li id="signup"><a href="signup.php" title="Sign Up">Sign Up</a></li>
	</ul>
</header>


<!-- NAVIGATION BAR -->
<nav class="navbar">
	<div class="profile-menu">
		<img class="profile-pic" src="assets/img/user.png">
		<div class="user-name"><?php session_start(); echo $_SESSION["shopusername"]; ?></div>
	</div>

	<!-- CLOSE BUTTON -->
	<div class="close-btn">
		<span></span>
	</div>

	<!-- NAVIGATION LIST -->
	<ul class="nav-list">
		<li><a href="index.php" title="Home">Home</a></li>
		<li id="login"><a href="signin.php" title="Log In">Log In</a></li>
		<li id="signup"><a href="signup.php" title="Sign Up">Sign Up</a></li>
		<li><a href="about.php" title="">About Us</a></li>
	</ul>
</nav>

<script>
	var userName = document.querySelector('.navbar .user-name');

	// if user is not logged in
	if(userName.innerHTML == '') {
  	userName.innerHTML = 'Guest Login'
	}
</script>
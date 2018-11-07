<header>
	<!-- MENU BUTTON -->
	<button class="toggle-btn">
		<span></span>
	</button>
	
	<!-- LOGO -->
	<a href="index.php" class="logo"><strong>SHOP</strong></a>

	<!-- Notification banner -->
	<div class="notify">
		<div class="notify__msg"></div>
		<button class="notify__close-btn">X</button>
	</div>

	<?php
		session_start();

		// USER IS LOGGED IN
		if(isset($_SESSION['shopuseruid'])) {
	?>
			<!-- LOGGED IN ACCOUNT MENU -->
			<div class="account">
				<button class="toggle-menu">
					<img class="profile-pic" src="assets/img/user.png">	
				</button>
				
				<div class="menu">
					<div class="username"><div class="greetings"> Welcome!</div> <?php session_start(); echo ' '.$_SESSION["shopusername"]; ?></div>
					<ul>
						<li><a href="user_profile.php">Profile</a></li>
						<li><a href="user_profile.php#account">Account Settings</a></li>
						<li id="logout">
							<form action="logout.php" method="post">
								<input type="submit" name="logout" value="Logout" />	
							</form>
						</li>
					</ul>
				</div>
			</div>
	<?php
		}
	?>

	<?php
		// USER IS NOT LOGGED IN
		if(!isset($_SESSION['shopuseruid'])) {
	?>
			<!-- NAVIGATION LIST -->
			<div class="nav">
				<a href="signin.php" title="Log In" id="login">Log In</a>
				<a href="signup.php" title="Sign Up" id="signup">Sign Up</a>
			</div>
	<?php
		}
	?>
</header>


<!-- NAVIGATION MENU -->
<nav class="navbar">
	<div class="profile-menu">
		<img class="profile-pic" src="assets/img/user.png">
		<div class="user-name"><?php echo $_SESSION["shopusername"]; ?></div>
		<div class="post"><?php echo $_SESSION["shopuserpost"]; ?></div>
	</div>

	<!-- CLOSE BUTTON -->
	<button class="close-btn">
		<span></span>
	</button>

	<!-- NAVIGATION LIST -->
	<ul class="nav-list">
		<li><a href="index.php" title="Home">Home</a></li>
		<?php
			// USER IS LOGGED IN
			if(isset($_SESSION['shopuseruid'])) {
				// ADMIN LOGIN
				if($_SESSION['post'] == 'admin') {
		?>
					<li><a href="show_users.php">Registered Users</a></li>
					<li><a href="signup_seller.php">Add Sellers</a></li>
		<?php
				}
				// TEACHER LOGIN
				else if($_SESSION['shopuserpost'] == 'seller') {
		?>
					<li><a href="manage_customers.php">Manage Customers</a></li>
					<li><a href="manage_transactions.php">Manage Transactions</a></li>
		<?php
				}
			}
			else {
		?>
				<li id="login"><a href="signin.php" title="Log In">Log In</a></li>
				<li id="signup"><a href="signup.php" title="Sign Up">Sign Up</a></li>
		<?php
			}
		?>
	</ul>
</nav>

<script src="assets/lib/jquery/jquery-1.12.2.min.js" type="text/javascript"></script>
<script>
	var userName = document.querySelector('.navbar .user-name');

	// if user is not logged in
	if(userName.innerHTML == '') {
  		userName.innerHTML = 'Guest Login'
	}
</script>
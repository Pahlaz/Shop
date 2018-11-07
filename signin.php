<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SHOP | Sign In</title>

	<link rel="manifest" href="manifest.json">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/connect.css">	
</head>
<body>
	<div class="wrapper">
		<?php include 'header.php'; ?>

		<div class="connect-container">
			<div class="profile-pic">
				<img src="assets/img/user.png">
			</div>
			<form class="signin" action="login_user.php" method="post">
			  	<div class="input-group">
				    <input type="email" id="email" name="email" required autofocus>
				    <label>Your Email Address</label>
			  	</div>
			  	<div class="input-group">
				    <input type="password" id="pass" name="password" required>
				    <label>Your Password</label>
			  	</div>
				
				<input type="submit" name="login" value="Sign In">
				
				<p>Not Registered! <a href="signup.php" title="Sign Up">Sign Up </a>here</p>	
			</form>
		</div>
	</div>

	<script src="assets/js/script.js" type="text/javascript"></script>
	<script src="assets/js/connect.js" type="text/javascript"></script>
</body>
</html>

<!-- VALIDATING THE USER ON THE PAGE -->
<?php
	session_start();
	if(isset($_SESSION['shopuseruid'])) {
		//user is logged in
		$post = $_SESSION['shopuserpost'];

		// redirecting the a specific page based on the post of the user. 
		header('location: '.$post.'.php');
	}
	else {
		//user is not logged in
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SHOP | Sign Up</title>

	<link rel="manifest" href="manifest.json">
	<link rel="stylesheet" href="assets/css/connect.css">	
</head>
<body>
	<div class="wrapper">
		<div class="connect-container">
			<div class="profile-pic">
				<img src="assets/img/signup.png">
			</div>
			<form class="signup" action="reg_user.php" method="post">
				<div class="input-group">
			    	<input type="text" name="name" required>
			    	<label>Your Name</label>
			  	</div>
			  
			 	<div class="input-group">
			    	<input type="email" name="email" required>
			    	<label>Your Email Address</label>
			  	</div>
			  
			  	<div class="input-group">
			    	<input type="password" name="password" required>
			    	<label>Your Password</label>
			  	</div>
			  
			  	<div class="input-group">
			    	<input type="password" required>
			    	<label>Rewrite Your Password</label>
			  	</div>
			  
				<input type="hidden" name="post" value="consumer" />
			  	<input id="register" type="submit" name="Register" value="Register">

			  	<p>Already Registered! <a href="signin.php" title="Sign In">Sign In </a>here</p>	
			</form>
		</div>

	</div>

	<script src="assets/lib/jquery/jquery-1.12.2.min.js" type="text/javascript"></script>
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
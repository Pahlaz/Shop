<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SHOP | Sign Up</title>

	<link rel="stylesheet" href="assets/css/header.css">
	<link rel="stylesheet" href="assets/css/connect.css">
</head>
<body>
	<div class="wrapper">
		<?php include 'header.php'; ?>

		<div class="connect-container">
			<div class="profile-pic">
				<img src="assets/img/signup.png">
			</div>
			<form class="signup" action="reg_user.php" method="post">
				<div class="input-group">
					<input type="text" name="name" required autofocus>
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
				<input type="hidden" name="post" value="seller" />

				<input type="submit" name="Register" value="Register">
			</form>
		</div>

	</div>

	<script src="assets/js/script.js" type="text/javascript"></script>
	<script src="assets/js/connect.js" type="text/javascript"></script>
</body>
</html>
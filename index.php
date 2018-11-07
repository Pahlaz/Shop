<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SHOP | Home</title>

	<link rel="stylesheet" href="assets/css/style.css">
	<style>
		.wrapper {
			padding: 50px 0px 0px 0px;
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<?php include 'header.php'; ?>

		<div class="front">
			<div class="front-container">
				<div class="logo">SHOP</div>
				<a href="main.php" class="start-btn">Buy Now</a>
			</div>
		</div>

	</div>

	<script src="assets/js/script.js" type="text/javascript"></script>
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
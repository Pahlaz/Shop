<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SHOP | Home</title>

	<link rel="stylesheet" href="assets/css/header.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/about.css">
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

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->

	<script src="assets/lib/jquery/jquery-1.12.2.min.js" type="text/javascript"></script>
	<script src="assets/js/script.js" type="text/javascript"></script>
</body>
</html>

<?php require_once 'styles.php';?>

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
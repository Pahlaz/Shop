<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SHOP | Administrator Login</title>

	<link rel="manifest" href="manifest.json">
	<link rel="stylesheet" href="assets/css/header.css">
	<link rel="stylesheet" href="assets/css/post.css">
</head>
<body style="background: url('assets/img/bg.jpg');">
	<div class="wrapper">
		<?php include 'header.php'; ?>

		<div class="fun">
			<ul>
				<li><a href="show_users.php">Registered Users</a></li>
				<li><a href="signup_seller.php">Add Sellers</a></li>
			</ul>
		</div>
		
	</div>

	<script src="assets/lib/jquery/jquery-1.12.2.min.js" type="text/javascript"></script>
	<script src="assets/js/script.js" type="text/javascript"></script>
</body>
</html>

<?php require_once 'styles.php';?>

<!-- VALIDATING THE USER ON THE PAGE -->
<?php
	session_start();

	if(isset($_SESSION['shopuseruid'])) {	//user is logged in
		// to redirect unauthorized users
		if($_SESSION['shopuserpost'] != 'admin') {
			header('location: consumer.php');
			exit();
		}
	}
	else {	//user is not logged in
		header('location: consumer.php');
	}
?>
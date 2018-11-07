<?php require_once 'db.php';
	
	// connecting to the database
	$connection = connectDB();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SHOP | Main Page</title>

	<link rel="stylesheet" href="assets/css/header.css">
	<link rel="stylesheet" href="assets/css/user_profile.css">
</head>
<body>
	<div class="wrapper">
		<?php include 'header.php'; ?>

		<div class="user-profile">
			
			<div class="profile-image">
				<img src="assets/img/user.png" alt="Profile Image">
			</div>

			<div class="details">
				<?php
					if (!$connection) {
					   // die("Connection failed: " . mysqli_connect_error());
						header('Location: error.php');
						exit();
					}
					else {
						$uid = $_SESSION['shopuseruid'];

						$query = "select name, email, post from shop.reg_users where uid =\"$uid\"";
						$result = mysqli_query($connection, $query);

						$arr = mysqli_fetch_row($result);
				?>
						<div class="name"><?php echo $arr[0]; ?></div>
						<div class="email"><?php echo $arr[1]; ?></div>
						<div class="post"><?php echo $arr[2]; ?></div>
				<?php
					}
				?>
			</div>
		</div>

		<nav id="account-nav">
			<ul>
				<li><a href="" title="">Account Settings</a></li>
				<li><a href="" title="">Privileges</a></li>
			</ul>
		</nav>
	</div>

	<script src="assets/js/script.js" type="text/javascript"></script>
</body>
</html>
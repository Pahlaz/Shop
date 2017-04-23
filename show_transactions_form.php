<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SHOP | Show Transaction</title>

	<link rel="manifest" href="manifest.json">

	<link rel="stylesheet" href="assets/css/header.css">
	<link rel="stylesheet" href="assets/css/transaction.css">
</head>
<body>
	<div class="wrapper">
		<?php include 'header.php'; ?>

		<div id="show_transaction">
			<h1>Show transactions</h1>
			
			<select id="cid" name="cid">
				<option value="">Select a Customer</option>
				<?php
					// connecting to the database
					$address = "localhost";
					$username = "root";
					$password = "root";

					$connection = mysqli_connect($address, $username, $password);

					if (!$connection) {
					   // die("Connection failed: " . mysqli_connect_error());
						header('Location: error.php');
						exit();
					}
					else {
						$query = "select * from shop.customers";
						$result = mysqli_query($connection, $query);

						while($arr = mysqli_fetch_row($result)) {
				?>
  							<option value="<?php echo $arr[0];?>"><?php echo $arr[1];?> - <?php echo $arr[1];?></option>
				<?php
						}
					}
				?>
			</select>

			<input id="date" type="date" name="date">
			<button id="st">Show Transactions</button>
		</div>

		<iframe id="transactions"></iframe>

	</div>

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->

	<script src="assets/lib/jquery/jquery-1.12.2.min.js" type="text/javascript"></script>
	<script src="assets/js/script.js" type="text/javascript"></script>
	<script src="assets/js/transaction.js" type="text/javascript"></script>
</body>
</html>

<?php require_once 'styles.php'; ?>
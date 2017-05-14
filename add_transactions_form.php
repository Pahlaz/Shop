<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SHOP | Add Transactions</title>

	<link rel="stylesheet" href="assets/css/header.css">
	<link rel="stylesheet" href="assets/css/transaction.css">
</head>
<body>
	<div class="wrapper">
		<?php include 'header.php'; ?>

		<form id="add_transaction" action="add_transaction.php" method="post">
			<h1>Add a transaction</h1>
			
			<select name="cid">
				<option value="#">Select a Customer</option>
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
  							<option value="<?php echo $arr[0];?>"><?php echo $arr[3];?> - <?php echo $arr[1];?></option>
				<?php
						}
					}
				?>
			</select>

			<input type="date" name="date">
			<input type="number" name="credit" placeholder="credited ammount">
			<input type="number" name="debit" placeholder="debited ammount">
			<input type="text" name="comment" placeholder="describe transaction">

			<input type="submit" name="at" value="Add Transaction">

		</form>

	</div>

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->

	<script src="assets/lib/jquery/jquery-1.12.2.min.js" type="text/javascript"></script>
	<script src="assets/js/script.js" type="text/javascript"></script>
</body>
</html>

<?php require_once 'styles.php'; ?>
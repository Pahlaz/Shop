<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SHOP | Seller</title>

	<link rel="manifest" href="manifest.json">
	<link rel="stylesheet" href="assets/css/header.css">
	<link rel="stylesheet" href="assets/css/post.css">
</head>
<body>
	<div class="wrapper">
		<?php include 'header.php'; ?>

		<div style="display: inline-block;">
			<select onchange="location = this.options[this.selectedIndex].value;">
				<option value="">Customer</option>
				<option value="add_customers_form.php">Add Customers</option>
				<option value="show_customers.php">Show Customers</option>
			</select>
			<select onchange="location = this.options[this.selectedIndex].value;">
				<option value="">Transaction</option>
				<option value="add_transactions_form.php">Add Transactions</option>
				<option value="show_transactions_form.php">Show Transactions</option>
			</select>
		</div>

		<div class="fun">
			<ul>
				<li><a href="add_customers_form.php">Add Customers</a></li>
				<li><a href="show_customers.php">Show Customers</a></li>
				<li><a href="add_transactions_form.php">Add Transactions</a></li>
				<li><a href="show_transactions_form.php">Show Transactions</a></li>
			</ul>
		</div>
	</div>

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->

	<script src="assets/lib/jquery/jquery-1.12.2.min.js" type="text/javascript"></script>
	<script src="assets/js/script.js" type="text/javascript"></script>
</body>
</html>

<?php include 'styles.php'; ?>
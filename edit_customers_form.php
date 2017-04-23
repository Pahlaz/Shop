<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SHOP | Add Customers</title>

	<link rel="stylesheet" href="assets/css/header.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/customer.css">
</head>
<body>
	<div class="wrapper">
		<?php include 'header.php'; ?>

		<form id="add_customer" action="add_customer.php" method="post">
			<h1>Add a Customer</h1>
			<input type="text" name="name" placeholder="Enter name">
			<input type="text" name="addr" placeholder="Enter address">
			<input type="text" name="city" placeholder="Enter city">
			<input type="number" name="phno" placeholder="Enter phone number">

			<input type="submit" name="ac" value="Add Customer">

		</form>

	</div>

</body>
</html>

<?php require_once 'styles.php'; ?>
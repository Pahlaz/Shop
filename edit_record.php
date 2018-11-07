<?php
	require_once 'db.php';
	
	// connecting to the database
	$connection = connectDB();

	if (!$connection) {
	   // die("Connection failed: " . mysqli_connect_error());
		header('Location: error.php');
		exit();
	}
	else {
		$entityId = $_POST['entityId'];

		if($entityId == 'customer') {
			$name = $_POST['name'];
			$addr = $_POST['addr'];
			$city = $_POST['city'];
			$phno = $_POST['phno'];
			$cid = $_POST['editBtnId'];

			$query = "UPDATE shop.customers SET name = \"$name\", addr = \"$addr\", city = \"$city\", phno = \"$phno\" WHERE cid=\"$cid\"";

			if (mysqli_query($connection, $query)) {
				echo 'Customer updated successfully.';
			}
			else {
			   mysqli_close($connection);
			   header("location: error.php");
				exit();
			}
		}
		else if($entityId == 'transaction') {
			$cid = $_POST['cid'];
			$tdate = $_POST['tdate'];
			$credit = $_POST['credit'];
			$debit = $_POST['debit'];
			$comment = $_POST['comment'];
			$tid = $_POST['editBtnId'];

			$query = "UPDATE shop.transactions SET cid = \"$cid\", tdate = \"$tdate\", credit = \"$credit\", debit = \"$debit\", comment = \"$comment\" WHERE tid=\"$tid\"";

			if (mysqli_query($connection, $query)) {
				echo 'Transaction updated successfully.';
			}
			else {
			   mysqli_close($connection);
			   header("location: error.php");
				exit();
			}
		}
		else if($entityId == 'product') {
			$name = $_POST['name'];
			$category = $_POST['category'];
			$brand = $_POST['brand'];
			$price = $_POST['price'];
			$pid = $_POST['editBtnId'];

			$query = "UPDATE shop.products SET name = \"$name\", category = \"$category\", brand = \"$brand\", price = \"$price\" WHERE pid=\"$pid\"";

			if (mysqli_query($connection, $query)) {
				echo 'Product updated successfully.';
			}
			else {
			   	mysqli_close($connection);
			   	header("location: error.php");
				exit();
			}
		}
	}
?>
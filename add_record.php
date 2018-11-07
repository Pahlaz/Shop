<?php
	require_once 'db.php';
	
	// connecting to the database
	$connection = connectDB();

	if (!$connection) {
	   	// die("Connection failed: " . mysqli_connect_error());
	   	echo "Can't able to connect to database.";
		header('Location: error.php');
		exit();
	}
	else {
		$entityId = $_POST['entityId'];

		if( $entityId == 'customer') {
			//get the values from the page
			$name = $_POST['name'];
			$addr = $_POST['addr'];
			$city = $_POST['city'];
			$phno = $_POST['phno'];	

			// GENERATING THE CUSTOMER ID
			$cid = substr(md5(uniqid('customerId', true)), 0, 20);

			$query = "INSERT INTO shop.customers (cid, name, addr, city, phno) VALUES (\"$cid\", \"$name\", \"$addr\", \"$city\", \"$phno\")";

			if (mysqli_query($connection, $query)) {
				echo $cid;
			}
			else {
				echo "There was a problem adding the customer.";
			  	mysqli_close($connection);
				exit();
			}
		}
		else if($entityId == 'transaction') {
			//get the values from the page
			$cid = $_POST['cid'];
			$date = $_POST['date'];
			$credit = $_POST['credit'];
			$debit = $_POST['debit'];
			$comment = $_POST['comment'];
			
			if($credit == '')
				$credit = 0;	
			if($debit == '')
				$debit = 0;

			// GENERATING THE TRANSACTION ID
			$tid = substr(md5(uniqid('transactionId', true)), 0, 20);

			$query = "INSERT INTO shop.transactions (tid, cid, tdate, credit, debit, comment) VALUES (\"$tid\", \"$cid\", \"$date\",  \"$credit\", \"$debit\", \"$comment\")";

			if (mysqli_query($connection, $query)) {
				echo $tid;
			}
			else {
			   	mysqli_close($connection);
			   	header("location: error.php");
				exit();
			}
		}
		else if($entityId == 'product') {
			//get the values from the page
			$name = $_POST['name'];
			$category = $_POST['category'];
			$brand = $_POST['brand'];
			$price = $_POST['price'];

			// GENERATING THE Product ID.
			$pid = substr(md5(uniqid('productId', true)), 0, 11);

			$query = "INSERT INTO shop.products (pid, name, category, brand, price) VALUES (\"$pid\", \"$name\", \"$category\", \"$brand\", \"$price\")";

			if (mysqli_query($connection, $query)) {
				mysqli_close($connection);
				
				echo $pid;
			}
			else {
			   	mysqli_close($connection);	   	
			    echo "There was some problem adding the product";
				exit();
			}
		}
	}
?>
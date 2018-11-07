<?php
	// connecting to the database
	$address = "localhost";
	$username = "root";
	$password = "root";

	$connection = mysqli_connect($address, $username, $password);

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
			$id = $_POST[id];

			$query = "DELETE FROM shop.customers WHERE cid=\"$id\"";

			if (mysqli_query($connection, $query)) {
				// Delete all transaction record done by the customer.


				echo "Customer Records deleted successfully.";
			}
			else {
				echo "Customer can't be deleted.";
			   	mysqli_close($connection);
			   	header("location: error.php");
				exit();
			}
		}
		else if($entityId == 'transaction') {
			//get the values from the page
			$id = $_POST[id];

			$query = "DELETE FROM shop.transactions WHERE tid=\"$id\"";

			if (mysqli_query($connection, $query)) {
				echo "Transaction deleted successfully";
			}
			else {
			   	mysqli_close($connection);
			   	header("location: error.php");
				exit();
			}
		}
		else if($entityId == 'product') {
			//get the values from the page
			$id = $_POST[id];

			$query = "DELETE FROM shop.products WHERE pid=\"$id\"";

			if (mysqli_query($connection, $query)) {
				mysqli_close($connection);

				echo "Product records deleted successfully.";
			}
			else {
				mysqli_close($connection);
				
				echo "There was some problem deleting the product record.";
				exit();
			}
		}
	}
?>
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
		//get the values from the page
		
		
		$editBtnId = $_POST[editBtnId];

		$query = "UPDATE shop.transactions SET  WHERE tid=\"$editBtnId\"";

		if (mysqli_query($connection, $query)) {
			echo "Transaction updated successfully";
		}
		else {
		   mysqli_close($connection);
		   header("location: error.php");
			exit();
		}
	}
?>
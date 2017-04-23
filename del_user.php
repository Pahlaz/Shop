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
		//get the values from the page
		$uid = $_POST[uid];

		$query = "DELETE FROM shop.reg_users WHERE uid=\"$uid\"";

		if (mysqli_query($connection, $query)) {
			echo "Record deleted successfully";
		}
		else {
		   	mysqli_close($connection);
		    header("location: error.php");
			exit();
		}
	}
?>
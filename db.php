<?php
	function connectDB() {
		// connecting to the database
		$address = "localhost";
		$username = "root";
		$password = "root";

		// $mysqli = new mysqli($address, $username, $password);

		$connection = mysqli_connect($address, $username, $password);

		if ($connection) {
			return $connection;
		}
		else {
			return false;
		}
	}
?>
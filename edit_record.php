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
		$name = $_POST['name'];
		$addr = $_POST['addr'];
		$city = $_POST['city'];
		$phno = $_POST['phno'];

		$cid = $_POST['editBtnId'];

		$query = "SELECT name, addr, city, phno FROM shop.customers WHERE cid=\"$cid\"";
		$result = mysqli_query($connection, $query);

		// FETCHING THE DETAILS BEFORE UPDATE
		if (mysqli_num_rows($result) > 0) {
			$db_results = mysqli_fetch_assoc($result);
			
			$name_from_db = $db_results["name"];
			$addr_from_db = $db_results["addr"];
			$city_from_db = $db_results["city"];
			$phno_from_db = $db_results["phno"];
		}
		else {
			header('location: error.php');
		}

		// UPDATED DETAILS
		if($name == ' ' || $name == null) {
			$name = $name_from_db;
		}
		if($addr == ' ' || $addr == null) {
			$addr = $addr_from_db;
		}
		if($city == ' ' || $city == null) {
			$city = $city_from_db;
		}
		if($phno == ' ' || $phno == null) {
			$phno = $phno_from_db;
		}

		$query = "UPDATE shop.customers SET name = \"$name\", addr = \"$addr\", city = \"$city\", phno = \"$phno\" WHERE cid=\"$cid\"";

		if (mysqli_query($connection, $query)) {
?>
			<script>
				alert('Record Updated successfully');
				window.location = 'show_customers.php';
			</script>
<?php
		}
		else {
		   mysqli_close($connection);
		   header("location: error.php");
			exit();
		}
	}
?>
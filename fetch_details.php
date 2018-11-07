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
		$data = array();

		if($entityId == 'customer') {
			$query = "select * from shop.customers";
			$result = mysqli_query($connection, $query);

			while($arr = mysqli_fetch_row($result)) {
				$data[] = $arr;
			}

			echo json_encode($data);
		}
		else if($entityId == 'transaction') {
			$query = "select * from shop.transactions";
			$result = mysqli_query($connection, $query);

			while($arr = mysqli_fetch_row($result)) {
				$data[] = $arr;
			}

			echo json_encode($data);
		}
		else if($entityId == 'product') {
			$query = "select * from shop.products";
			$result = mysqli_query($connection, $query);

			while($arr = mysqli_fetch_row($result)) {
				$data[] = $arr;
			}

			echo json_encode($data);
		}
		else {
			http_response_code(401);
		}
	}
		
?>
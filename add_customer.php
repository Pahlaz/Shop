<?php
	if(isset($_POST['ac'])) {
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
				$name = $_POST['name'];
				$addr = $_POST['addr'];
				$city = $_POST['city'];
				$phno = $_POST['phno'];	

				$query = "INSERT INTO shop.customers (name, addr, city, phno) VALUES (\"$name\", \"$addr\", \"$city\", \"$phno\")";

				if (mysqli_query($connection, $query)) {
?>
							<script>
								alert('Customer added successfully');
								window.location = "add_customers_form.php";
							</script>						
<?php
				}
				else {
				   	mysqli_close($connection);
				    header("location: error.php");
					exit();
				}
		}
	}
?>
<?php
	if(isset($_POST['at'])) {
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
				$cid = $_POST['cid'];
				$date = $_POST['date'];
				$credit = $_POST['credit'];
				$debit = $_POST['debit'];
				$comment = $_POST['comment'];

				if($credit == '')
					$credit = 0;					
				if($debit == '')
					$debit = 0;

				$query = "INSERT INTO shop.transactions (tdate, cid, credit, debit, comment) VALUES (\"$date\", \"$cid\", \"$credit\", \"$debit\", \"$comment\")";

				if (mysqli_query($connection, $query)) {
?>
							<script>
								alert('Transaction added successfully');
								window.location = "add_transactions_form.php";
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
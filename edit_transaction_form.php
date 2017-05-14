<form id="add_transaction" action="edit_t_rec.php" method="post">
	<h1>Update Transaction</h1>
	
	<select name="cid">
		<option value="#">Select a Customer</option>
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
				$query = "select * from shop.customers";
				$result = mysqli_query($connection, $query);

				while($arr = mysqli_fetch_row($result)) {
		?>
						<option value="<?php echo $arr[0];?>"><?php echo $arr[3];?> - <?php echo $arr[1];?></option>
		<?php
				}
			}
		?>
	</select>

	<input type="date" name="date">
	<input type="number" name="credit" placeholder="credited ammount">
	<input type="number" name="debit" placeholder="debited ammount">
	<input type="text" name="comment" placeholder="describe transaction">

	<input type="submit" name="at" value="Add Transaction">

</form>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SHOP | Manage Transactions</title>

	<!-- Importing Stylesheets -->
	<link rel="manifest" href="manifest.json">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/manage.css">
</head>
<body>
	<div class="wrapper">
		<!-- Page Header -->
		<?php include 'header.php'; ?>

		<!-- Transactions Controls -->
		<!-- <div>
			<input type="text" placeholder="Search Transactions">
			<button type="button" onclick="add()">Add</button>
			<button type="button" onclick="show()">Show</button>
		</div> -->

		<!-- Show Transactions -->
		<section class="show-transaction">
			<table>
				<thead>
			    	<tr>
			    		<th>Name</th>
			      		<th>Transaction Date</th>
					 	<th>Credit</th>
				      	<th>Debit</th>
				      	<th>Comment</th>
			    		<th class="empty-data"></th>
			      		<th class="empty-data"></th>
				    </tr>
			  	</thead>
			  	<tbody class="content">
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
							// request from show_transactions.php
							// get the values from the page
							$cid = $_GET['cid'];
							$date = $_GET['date'];
							
							if($cid == '' and $date == ''){
								$query = "select c.name, t.tid, t.cid, t.tdate, t.credit, t.debit, t.comment from shop.transactions t JOIN shop.customers c ON t.cid = c.cid";
							}
							else if($cid == '' and $date != ''){
								$query = "select c.name, t.tid, t.cid, t.tdate, t.credit, t.debit, t.comment from shop.transactions t JOIN shop.customers c ON t.cid = c.cid where tdate=\"$date\"";
							}
							else if($cid != '' and $date =='') {
								$query = "select c.name, t.tid, t.cid, t.tdate, t.credit, t.debit, t.comment from shop.transactions t JOIN shop.customers c ON t.cid = c.cid where cid=\"$cid\"";
							}
							else {
								$query = "select c.name, t.tid, t.cid, t.tdate, t.credit, t.debit, t.comment from shop.transactions t JOIN shop.customers c ON t.cid = c.cid where cid=\"$cid\" and tdate=\"$date\"";
							}

							$result = mysqli_query($connection, $query);

							while($arr = mysqli_fetch_row($result)) {
					?>
					<tr data-id="<?php echo $arr[1];?>">
						<td data-cid="<?php echo $arr[2];?>"><?php echo $arr[0];?></td>
						<td><?php echo $arr[3];?></td>
						<td><?php echo $arr[4];?></td>
						<td><?php echo $arr[5];?></td>
						<td><?php echo $arr[6];?></td>
						<td class="btn"> <button class="del" title="Delete"></button> </td>
						<td class="btn"> <button class="edit" title="Edit"></button> </td>
					</tr>
					<?php
							}
						}
					?>
					
					<!-- Add Transactions -->
					<tr id="add-row">
						<form id="add_transaction" method="post">
							<td>
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

											$cid = array();
											$name = array();
											$addr = array();

											while($arr = mysqli_fetch_row($result)) {
												// collecting the customer details
												array_push($cid, $arr[0]);
												array_push($name, $arr[1]);
												array_push($addr, $arr[2]);
									?>
									<option value="<?php echo $arr[0];?>"><?php echo $arr[1];?> - <?php echo $arr[2];?></option>
									<?php
											}
											echo "<script>";
											echo 'var editInputRowCid = '.json_encode($cid).';';
											echo 'var editInputRowName = '.json_encode($name).';';
											echo 'var editInputRowAddr = '.json_encode($addr).';';
											echo "</script>";
										}
									?>
								</select>
							</td>
							<td><input type="date" name="date" required></td>
							<td><input type="number" name="credit" placeholder="Credit"></td>
							<td><input type="number" name="debit" placeholder="Debit"></td>
							<td><input type="text" name="comment" placeholder="Comment"></td>
							<td class="btn"> <input class="add" type="submit" name="at" value="+"  title="Add"> </td>
							<td class="empty-data"></td>
						</form>
					</tr>
				</tbody>
			</table>
		</section>

	</div>


	<script src="assets/js/script.js" type="text/javascript"></script>
	<script src="assets/js/transaction.js" type="text/javascript"></script>
</body>
</html>
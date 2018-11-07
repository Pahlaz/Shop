<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SHOP | Show Transaction</title>

	<link rel="stylesheet" href="assets/css/header.css">
	<link rel="stylesheet" href="assets/css/transaction.css">
</head>
<body>
	<table border="1" cellspacing="0" cellpadding="10px" style="width: 50%; border: 0; ">
		<thead>
	    	<tr>
	      	<th>tdate</th>
			 	<th>credit</th>
		      <th>debit</th>
		      <th>comment</th>
	    		<th style="border: 0;"></th>
	      	<th style="border: 0;"></th>
		    </tr>
	  	</thead>
	  	<tbody>
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
					$cid = $_GET['cid'];
					$date = $_GET['date'];
				?>
					<script>
						alert("<?php echo $cid.':'.$date; ?>");
					</script>
				<?php

					
					if($cid == '' and $date == ''){
						$query = "select tid, tdate, credit, debit, comment from shop.transactions";
					}
					else if($cid == '' and $date != ''){
						$query = "select tid, tdate, credit, debit, comment from shop.transactions where tdate=\"$date\"";
					}
					else if($cid != '' and $date =='') {
						$query = "select tid, tdate, credit, debit, comment from shop.transactions where cid=\"$cid\"";
					}
					else {
						$query = "select tid, tdate, credit, debit, comment from shop.transactions where cid=\"$cid\" and tdate=\"$date\"";
					}

					$result = mysqli_query($connection, $query);

					while($arr = mysqli_fetch_row($result)) {
			?>
						<tr>
							<td><?php echo $arr[1];?></td>
							<td><?php echo $arr[2];?></td>
							<td><?php echo $arr[3];?></td>
							<td><?php echo $arr[4];?></td>
							<td id="del<?php echo $arr[0];?>" class="del" style="border: 0;width: 20px;height: 20px;"><img src="assets/img/delete.png" alt="delete" style="width: 20px;height: 20px;"></td>
							<td id="edit<?php echo $arr[0];?>" class="edit" style="border: 0;width: 20px;height: 20px;"><img src="assets/img/edit.png" alt="edit" style="width: 20px;height: 20px;"></td>
						</tr>
			<?php
					}
				}
			?>
			<tr>
				<form id="add_transaction" method="post">
					<td><input type="text" name="tdate" placeholder="Enter name" required></td>
					<td><input type="number" name="credit" placeholder="Credit" required></td>
					<td><input type="number" name="debit" placeholder="Debit" required></td>
					<td><input type="text" name="comment" placeholder="Comment" required></td>

					<td><input type="submit" name="at" value="Add Transaction"></td>
				</form>
			</tr>
		</tbody>
	</table>

	<script src="assets/js/script.js" type="text/javascript"></script>
	<script src="assets/js/transaction.js" type="text/javascript"></script>
</body>
</html>
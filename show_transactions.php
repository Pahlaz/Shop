<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SHOP | Show Transaction</title>

	<link rel="manifest" href="manifest.json">

	<link rel="stylesheet" href="assets/css/header.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/transaction.css">
</head>
<body>
	

		
			<table border="1" cellspacing="0">
				<thead>
			    	<tr>
			    		<th></th>
			      		<th>tdate</th>
					 	<th>credit</th>
				      	<th>debit</th>
				      	<th>comment</th>
			    		<th></th>
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
							$cid = $_POST['cid'];
							$date = $_POST['date'];
							
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
									<td id="del<?php echo $arr[0];?>" class="del" style="background: red;cursor: pointer;">Delete</td>
									<td><?php echo $arr[1];?></td>
									<td><?php echo $arr[2];?></td>
									<td><?php echo $arr[3];?></td>
									<td><?php echo $arr[4];?></td>
									<td id="edit<?php echo $arr[0];?>" class="edit" style="background: green;cursor: pointer;">Edit</td>
								</tr>
					<?php
							}
						}
					?>
				</tbody>
			</table>
		

	

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->

	<script src="assets/lib/jquery/jquery-1.12.2.min.js" type="text/javascript"></script>
	<script src="assets/js/script.js" type="text/javascript"></script>
	<script src="assets/js/transaction.js" type="text/javascript"></script>	
</body>
</html>


<?php require_once 'styles.php'; ?>
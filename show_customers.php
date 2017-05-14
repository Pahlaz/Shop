<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SHOP | Show Customers</title>

	<link rel="stylesheet" href="assets/css/header.css">
	<link rel="stylesheet" href="assets/css/customer.css">
</head>
<body>
	<div class="wrapper">
		<?php include 'header.php'; ?>

		<div class="show_customers">
			<h1>Cusotmers</h1>
			
			<table border="1" cellspacing="0">
				<thead>
			    	<tr>
			    		<th></th>
			      	<th>Name</th>
					 	<th>Address</th>
				      <th>City</th>
				      <th>Phone No.</th>
				      <th></th>
				   </tr>
			  	</thead>
			  	<tbody>
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
						$query = "select * from shop.customers";
						$result = mysqli_query($connection, $query);

						while($arr = mysqli_fetch_row($result)) {
				?>				
							<tr>
								<td id="del<?php echo $arr[0];?>" class="del" style="background: red;">Delete</td>
								<td><?php echo $arr[1];?></td>
								<td><?php echo $arr[2];?></td>
								<td><?php echo $arr[3];?></td>
								<td><?php echo $arr[4];?></td>
								<td id="edit<?php echo $arr[0];?>" class="edit" style="background: green;">Edit</td>
							</tr>				
				<?php
						}
					}
				?>
				</tbody>
			</table>
			
			<div id="output"></div>
		</div>

	</div>

	<script src="assets/lib/jquery/jquery-1.12.2.min.js" type="text/javascript"></script>
	<script src="assets/js/script.js" type="text/javascript"></script>
	<script src="assets/js/customer.js" type="text/javascript"></script>
</body>
</html>

<?php require_once 'styles.php'; ?>
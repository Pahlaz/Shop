<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SHOP | Place Order</title>

	<link rel="manifest" href="manifest.json">
	<link rel="stylesheet" href="assets/css/header.css">
	<style type="text/css">
		body {
			background: #eee;
		}
		.content {
			width: 100%;
			min-height: 400px;
			display: block;
			border: 0;
		}
		.fun, .content, .customer-name, .selected-products, .available-products {
			background: #fff;
			box-shadow: 0px 3px 6px 1px rgba(0,0,0,.4);
			padding: 15px 20px;
			margin-bottom: 20px;
		}
		#order-form > :last-child {
			margin-bottom: 0;
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<?php include 'header.php'; ?>

		<form id="order-form" action="" method="get" accept-charset="utf-8">
			<div class="fun">
				<input type="text" name="search" placeholder="Search Products">

				<select name="filter">
					<option value="">brand</option>
					<option value="">catigory</option>
				</select>

				<button type="button" onclick="order()">order</button>
			</div>

			<div class="customer-name">
				<input type="text" name="" placeholder="Customer Name">
			</div>

			<div class="selected-products">
				Selected Products
			</div>

			<div class="available-products">
				<table border="1" cellspacing="0" cellpadding="10px" style="width: 50%; border: 0; ">
					<thead>
				    	<tr>
				      	<th>Name</th>
						 	<th>Category</th>
					      <th>Brand</th>
					      <th>Price</th>
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
							$query = "select * from shop.products";
							$result = mysqli_query($connection, $query);

							while($arr = mysqli_fetch_row($result)) {
					?>				
								<tr>
									<td><?php echo $arr[1];?></td>
									<td><?php echo $arr[2];?></td>
									<td><?php echo $arr[3];?></td>
									<td><?php echo $arr[4];?></td>
								</tr>				
					<?php
							}
						}
					?>
					</tbody>
				</table>
			</div>
		</form>

	</div>

	<script src="assets/js/script.js" type="text/javascript"></script>
	<script type="text/javascript" charset="utf-8" async defer>
		var httpRequest = new XMLHttpRequest();
   	
   	var operationSelected = document.querySelector('#operation');
   	var content = document.querySelector('.content');

   	function add() {
   		content.src = "add_products_form.php";
   	}
   	function order() {
   		content.src = "order_products.php"
   	}

	   // FOR CHANGING THE LOGO
		document.querySelector('.logo').text = "Place Order";
		document.querySelector('.username').remove();
	</script>
</body>
</html>
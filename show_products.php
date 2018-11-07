<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SHOP | Show Products</title>

	<link rel="manifest" href="manifest.json">
	<link rel="stylesheet" href="assets/css/customer.css">
</head>

<h1>Products</h1>

<table border="1" cellspacing="0" cellpadding="10px" style="width: 50%; border: 0; ">
	<thead>
    	<tr>
      	<th>Name</th>
		 	<th>Category</th>
	      <th>Brand</th>
	      <th>Price</th>
	      <th style="border: 0;"></th>
	      <th style="border: 0;"></th>
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
					<td id="del<?php echo $arr[0];?>" class="del" style="border: 0;width: 20px;height: 20px;"><img src="assets/img/delete.png" alt="delete" style="width: 20px;height: 20px;"></td>
					<td id="edit<?php echo $arr[0];?>" class="edit" style="border: 0;width: 20px;height: 20px;"><img src="assets/img/edit.png" alt="edit" style="width: 20px;height: 20px;"></td>
				</tr>				
	<?php
			}
		}
	?>
	</tbody>
</table>

<div id="output"></div>

<script src="assets/js/customer.js" type="text/javascript"></script>
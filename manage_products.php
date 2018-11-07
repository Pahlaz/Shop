<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SHOP | Manage Products</title>

	<link rel="manifest" href="manifest.json">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/manage.css">
</head>
<body>
	<div class="wrapper">
		<?php include 'header.php'; ?>

		<section>
			<table>
				<thead>
			    	<tr>
				      	<th>Name</th>
						<th>Category</th>
					    <th>Brand</th>
					    <th>Price</th>
					    <th class="empty-data"></th>
					    <th class="empty-data"></th>
					</tr>
			  	</thead>
			  	<tbody class="content">
			  		<tr id="add-row">
						<form id="add_product" method="post">
							<td><input type="text" name="name" placeholder="Enter name" required autofocus></td>
							<td><input type="text" name="category" placeholder="Enter category" required></td>
							<td><input type="text" name="brand" placeholder="Enter brand" required></td>
							<td><input type="number" name="price" placeholder="Enter price" required></td>
							<td class="btn"> <input class="add" type="submit" name="ap" value="+"  title="Add"> </td>
							<td class="empty-data"></td>
						</form>
					</tr>
				</tbody>
			</table>
		</section>
	</div>

	<script src="assets/js/script.js" type="text/javascript"></script>
	<script src="assets/js/product.js" type="text/javascript"></script>
</body>
</html>
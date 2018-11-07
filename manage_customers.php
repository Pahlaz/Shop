<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SHOP | Manage Customers</title>

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
					 	<th>Address</th>
				      	<th>City</th>
				      	<th>Phone No.</th>
				      	<th class="empty-data"></th>
			      		<th class="empty-data"></th>
				   </tr>
			  	</thead>
			  	<tbody class="content">
					<tr id="add-row">
						<form id="add_customer" method="post">
							<td><input type="text" name="name" placeholder="Enter name" required autofocus></td>
							<td><input type="text" name="addr" placeholder="Enter address" required></td>
							<td><input type="text" name="city" placeholder="Enter city" required></td>
							<td><input type="number" name="phno" placeholder="Enter phone number" required></td>
							<td class="btn"> <input class="add" type="submit" name="ac" value="+"  title="Add"> </td>
							<td class="empty-data"></td>
						</form>
					</tr>
				</tbody>
			</table>
		</section>

	</div>

	<script src="assets/js/script.js" type="text/javascript"></script>
	<script src="assets/js/customer.js" type="text/javascript"></script>
</body>
</html>
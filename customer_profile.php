<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SHOP | Customer Profile</title>

	<link rel="manifest" href="manifest.json">
	<link rel="stylesheet" href="assets/css/customer.css">
</head>

<h1>Cusotmers</h1>

<table border="1" cellspacing="0" cellpadding="10px" style="width: 50%; border: 0; ">
	<thead>
    	<tr>
      	<th>Name</th>
		 	<th>Address</th>
	      <th>City</th>
	      <th>Phone No.</th>
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
			$cid = $_POST['cid'];

			$query = "select * from shop.customers where cid = \"$cid\";
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
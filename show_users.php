<?php 
	require_once 'db.php';
	
	// connecting to the database
	$connection = connectDB();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SHOP | Registered Users</title>

	<link rel="stylesheet" href="assets/css/header.css">
	<link rel="stylesheet" href="assets/css/admin.css">
</head>
<body style="background: url('assets/img/bg1.png');">
	<div class="wrapper">
		<?php include 'header.php'; ?>
		
		<table id="userstable" border="1" cellspacing="0" cellpadding="10px">
			<thead>
	    	<tr>
	      	<th>NAME</th>
			 		<th>POST</th>
	      	<th></th>
		    </tr>
	  	</thead>
	  	<tbody>
				<?php 
					if (!$connection) {
					   // die("Connection failed: " . mysqli_connect_error());
						header('Location: error.php');
						exit();
					}
					else {
						$query = "select uid, name, post from shop.reg_users";
						$result = mysqli_query($connection, $query);

						if(mysqli_num_rows($result) > 0) {
								while($arr = mysqli_fetch_row($result)) {
				?>
									<tr>
										<td><?php echo $arr[1];?></td>
										<td><?php echo $arr[2];?></td>
										<td id="del<?php echo $arr[0];?>" class="del" style="background: red;">Delete</td>
									</tr>
				<?php
								}
						}
						else {
							echo "No user has been registered by now";
						}
					}
				?>
			</tbody>
	</div>

	<script src="assets/lib/jquery/jquery-1.12.2.min.js" type="text/javascript"></script>
	<script src="assets/js/script.js" type="text/javascript"></script>
	<script src="assets/js/admin.js" type="text/javascript"></script>
</body>
</html>

<?php require_once 'styles.php';?>
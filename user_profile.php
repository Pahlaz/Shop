<?php require_once 'db.php';
	
	// connecting to the database
	$connection = connectDB();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Code Judge | Main Page</title>

	<link rel="stylesheet" href="assets/css/header.css">
	<link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
	<div class="wrapper">
		<?php include 'header.php'; ?>

	</div>

	<script src="assets/lib/jquery/jquery-1.12.2.min.js" type="text/javascript"></script>
	<script src="assets/js/script.js" type="text/javascript"></script>
</body>
</html>

<?php require_once 'styles.php';?>
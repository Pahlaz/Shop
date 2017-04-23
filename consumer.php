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

		<div class="content">
			<div class="practice section">
				<h1 class="heading">Practice Questions</h1>
				
				<?php
					if (!$connection) {
					   // die("Connection failed: " . mysqli_connect_error());
						header('Location: error.php');
						exit();
					}
					else {
						$query = "select qid, heading from codejudge.q_bank";
						$result = mysqli_query($connection, $query);
						$ncols = 3;

						while($arr = mysqli_fetch_row($result)) {
				?>
							<div class="row">
								<div class="question col">
									<p><?php echo $arr[1];?></p>
									<form action="attempt_question.php" method="get">
										<input type="hidden" name="qid" value="<?php echo $arr[0];?>" />
										<input class="btn" type="submit" value="Attempt Now!" name="attempt_question" />	
									</form>
								</div>
								<?php
									$colIndex = 0;
									while(($ncols - 1) > $colIndex && $arr = mysqli_fetch_row($result)){
										$colIndex++;
								?>
										<div class="question col">
											<p><?php echo $arr[1];?></p>
											<form action="attempt_question.php" method="get">
												<input type="hidden" name="qid" value="<?php echo $arr[0];?>" />
												<input class="btn" type="submit" value="Attempt Now!" name="attempt_question" />
											</form>
										</div>
								<?php
									}
								?>
							</div>
				<?php
						}
					}		
				?>
			</div>

			<div class="published section">
				<h1 class="heading">Test Published</h1>

				<?php
					if (!$connection) {
					   // die("Connection failed: " . mysqli_connect_error());
						header('Location: error.php');
						exit();
					}
					else {
						$query = "select tid, heading from codejudge.t_bank";
						$result = mysqli_query($connection, $query);
						
						$ncols = 2;

						while($arr = mysqli_fetch_row($result)) {
				?>
							<div class="row">
								<div class="question col">
									<p><?php echo $arr[1];?></p>
									<form action="attempt_test.php" method="get">
										<input type="hidden" name="tid" value="<?php echo $arr[0];?>" />
										<input class="btn" type="submit" value="Attempt Now!" name="attempt_test" />	
									</form>
								</div>
								<?php
									$colIndex = 0;
									while(($ncols - 1) > $colIndex && $arr = mysqli_fetch_row($result)){
										$colIndex++;
								?>
										<div class="question col">
											<p><?php echo $arr[1];?></p>
											<form action="attempt_test.php" method="get">
												<input type="hidden" name="tid" value="<?php echo $arr[0];?>" />
												<input class="btn" type="submit" value="Attempt Now!" name="attempt_test" />	
											</form>
										</div>
								<?php
									}
								?>
							</div>
				<?php
						}
					}		
				?>
			</div>
		</div>
	</div>

	<script src="assets/lib/jquery/jquery-1.12.2.min.js" type="text/javascript"></script>
	<script src="assets/js/script.js" type="text/javascript"></script>
</body>
</html>

<?php require_once 'styles.php';?>
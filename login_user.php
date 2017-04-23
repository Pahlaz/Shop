<?php
	if(isset($_POST['login'])) {
		require_once 'db.php';

		// connecting to the database
		$connection = connectDB();

		if (!$connection) {
			header('Location: error.php');
			exit();
		}
		else {
			//get the values for the page
			$email = $_POST['email'];
			$password = $_POST['password'];
			$encryptedPass = md5($password);

			$query = "select * from shop.reg_users where email =\"$email\"";
			$result = mysqli_query($connection, $query);
			
			if(mysqli_num_rows($result) > 0) {
				$db_results = mysqli_fetch_assoc($result);
				$password_from_db = $db_results["pass"];

				if($encryptedPass == $password_from_db) {
					mysqli_close($connection);

					$uid = $db_results["uid"];
					$name = $db_results["name"];
					$post = $db_results["post"];
					// $time;
					// $query = "insert into shop.signin_log (uid, time) values(\"$uid_from_db\", \"$time\")";
					// $result = mysqli_query($connection, $query);

					session_start();
					$_SESSION['shopuseremail'] = $email;
					$_SESSION['shopusername'] = $name;
					$_SESSION['shopuseruid'] = $uid;
					$_SESSION['shopuserpost'] = $post;
					session_write_close();

					if($post == 'admin') {
?>
						<script>
							alert('You have successfully been logged in');
							window.location = "admin.php";
						</script>						
<?php
					}
					else if($post == 'seller') {
?>
						<script>
							alert('You have successfully been logged in');
							window.location = "seller.php";
						</script>
<?php
					}
					else if($post == 'consumer') {
?>
						<script>
							alert('You have successfully been logged in');
							window.location = "consumer.php";
						</script>
<?php		
					}
					else{
?>
						<script>
							window.location = "error.php";
						</script>
<?php
					}
				}
				else {
					mysqli_close($connection);
?>
					<script>
						alert('Umm it seems You have entered wrong password');
						window.location = "signin.php";
					</script>					
<?php
				}
			}
			else {
				mysqli_close($connection);
?>
				<script> 
					alert('Well! why don\'t you sign up for start using shop');
					window.location = "signup.php";
				</script>
<?php
			}		    
		}
	}
	else {
		header('location: signin.php'); // redirect to login page
		exit();
	}
?>
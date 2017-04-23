<?php
	if(isset($_POST['Register'])) {
		require_once 'db.php';

		// connecting to the database
		$connection = connectDB();

		if (!$connection) {
			header('Location: error.php');
			exit();
		}
		
		// getting the email from page
		$email = $_POST['email'];

		//check if user already registered
		$query = "select uid from shop.reg_users where email =\"$email\"";
		$result = mysqli_query($connection, $query);
		
		if(mysqli_num_rows($result) > 0) {
			mysqli_close($connection);
?>
			<script>
				alert("You have already registered. Please login");
				window.location = 'signin.php'
			</script>
<?php
		}
		else {
			//getting the values from page
			$name = $_POST['name'];
			$pass = $_POST['password'];
			$encryptedPass = md5($pass);
			$post = $_POST['post'];

			$uid = substr(md5(uniqid('userId', true)), 0, 20);

			$query = "INSERT INTO shop.reg_users (uid, name, email, pass, post) VALUES (\"$uid\", \"$name\", \"$email\", \"$encryptedPass\", \"$post\")";

			if (mysqli_query($connection, $query)) {

				session_start();
				$_SESSION['shopuseremail'] = $email;
				$_SESSION['shopusername'] = $name;
				$_SESSION['shopuseruid'] = $uid;
				$_SESSION['shopuserpost'] = $post;
				session_write_close();			

				mysqli_close($connection);
?>
			<script>
				alert("You have registered successfully");
				window.location = 'index.php'
			</script>
<?php
			}
			else {
			   mysqli_close($connection);
			   header("location: error.php");
				exit();
			}
		}
	}
	else {
		header("location: signup.php");
		exit();
	}
?>
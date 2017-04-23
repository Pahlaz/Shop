<?php
	session_start();

	if(isset($_SESSION['shopuseruid'])) {
		//user is logged in
?>
		<script> 
			document.querySelectorAll('#login')[0].style.display = 'none';
			document.querySelectorAll('#login')[1].style.display = 'none';
			document.querySelectorAll('#signup')[0].style.display = 'none';
			document.querySelectorAll('#signup')[1].style.display = 'none';
			document.querySelector('#logout').style.display = 'block';
			document.querySelector('.account').style.display = 'inline-block';
		</script>
<?php
	}
	else {
		//user is not logged in
?>
		<script> 
			document.querySelectorAll('#login')[0].style.display = 'inline-block';
			document.querySelectorAll('#login')[1].style.display = 'block';
			document.querySelectorAll('#signup')[0].style.display = 'inline-block';
			document.querySelectorAll('#signup')[1].style.display = 'block';
			document.querySelector('#logout').style.display = 'none';
			document.querySelector('.account').style.display = 'none';
		</script>
<?php
	}
?>
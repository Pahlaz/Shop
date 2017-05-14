<form id="edit_record" action="edit_record.php" method="post">
	<h1>Update the Customer Details</h1>
	<input type="text" name="name" placeholder="Enter name">
	<input type="text" name="addr" placeholder="Enter address">
	<input type="text" name="city" placeholder="Enter city">
	<input type="number" name="phno" placeholder="Enter phone number">

	<input type="hidden" name="editBtnId" value="<?php echo $_POST['editBtnId']; ?>">
	<input type="submit" name="edit" value="Update">
</form>
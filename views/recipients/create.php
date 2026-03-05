<?php
require_once "../../controllers/RecipientController.php";
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/form.css">
</head>
<body>

<h2>Add Recipient</h2>

<form method="post">

<input type="text" name="name" placeholder="Name" required>

<select name="type" required>
<option value="">Select Type</option>
<option value="NGO">NGO</option>
<option value="Kitchen">Kitchen</option>
<option value="Store">Store</option>
<option value="Other">Other</option>
</select>

<input type="text" name="contact_info" placeholder="Contact Info">
<textarea name="address" placeholder="Address"></textarea>

<button type="submit" name="submit">Create</button>

</form>

<?php
if(isset($_POST['submit'])){
RecipientController::create(
$_POST['name'],
$_POST['type'],
$_POST['contact_info'],
$_POST['address']
);
header("Location:list.php");
}
?>

</body>
</html>
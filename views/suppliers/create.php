<?php
require_once "../../controllers/SupplierController.php";
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/form.css">
</head>
<body>

<h2>Add Supplier</h2>

<form method="post">

<input type="text" name="name" placeholder="Supplier Name" required>

<input type="text" name="contact_info" placeholder="Contact Info">

<textarea name="address" placeholder="Address"></textarea>

<button type="submit" name="submit">Create</button>

</form>

<?php
if(isset($_POST['submit'])){
SupplierController::create(
$_POST['name'],
$_POST['contact_info'],
$_POST['address']
);
header("Location:list.php");
}
?>

</body>
</html>
<?php
require_once "../../controllers/SupplierController.php";

$id = $_GET['id'];
$res = SupplierController::list();
while($s=mysqli_fetch_assoc($res)){
if($s['supplier_id']==$id) break;
}
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/form.css">
</head>
<body>

<h2>Edit Supplier</h2>

<form method="post">

<input type="text" name="name" value="<?=$s['name']?>" required>

<input type="text" name="contact_info" value="<?=$s['contact_info']?>">

<textarea name="address"><?=$s['address']?></textarea>

<button type="submit" name="submit">Update</button>

</form>

<?php
if(isset($_POST['submit'])){
SupplierController::update(
$id,
$_POST['name'],
$_POST['contact_info'],
$_POST['address']
);
header("Location:list.php");
}
?>

</body>
</html>
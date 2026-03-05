<?php
require_once "../../controllers/InventoryController.php";
require_once "../../controllers/CategoryController.php";
require_once "../../controllers/SupplierController.php";

$id=$_GET['id'];
$res = InventoryController::list();
while($f=mysqli_fetch_assoc($res)){
if($f['item_id']==$id) break;
}

$categories = CategoryController::list();
$suppliers = SupplierController::list();
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/form.css">
</head>
<body>

<h2>Edit Food Item</h2>

<form method="post">

<input type="text" name="name" value="<?=$f['name']?>" required>

<select name="category_id" required>
<?php
while($c=mysqli_fetch_assoc($categories)){
$sel = $c['category_id']==$f['category_id']?"selected":"";
echo "<option value='{$c['category_id']}' $sel>{$c['category_name']}</option>";
}
?>
</select>

<select name="supplier_id" required>
<?php
while($s=mysqli_fetch_assoc($suppliers)){
$sel = $s['supplier_id']==$f['supplier_id']?"selected":"";
echo "<option value='{$s['supplier_id']}' $sel>{$s['name']}</option>";
}
?>
</select>

<input type="number" name="quantity" value="<?=$f['quantity']?>" min="0" required>

<input type="date" name="expiry_date" value="<?=$f['expiry_date']?>" required>

<button type="submit" name="submit">Update</button>

</form>

<?php
if(isset($_POST['submit'])){
InventoryController::update(
$id,
$_POST['name'],
$_POST['category_id'],
$_POST['supplier_id'],
$_POST['quantity'],
$_POST['expiry_date']
);
header("Location:list.php");
}
?>

</body>
</html>
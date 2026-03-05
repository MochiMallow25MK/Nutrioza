<?php
require_once "../../controllers/InventoryController.php";
require_once "../../controllers/CategoryController.php";
require_once "../../controllers/SupplierController.php";

$categories = CategoryController::list();
$suppliers = SupplierController::list();
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/form.css">
</head>
<body>

<h2>Add Food Item</h2>

<form method="post">

<input type="text" name="name" placeholder="Item Name" required>

<select name="category_id" required>
<option value="">Select Category</option>
<?php
while($c=mysqli_fetch_assoc($categories)){
echo "<option value='{$c['category_id']}'>{$c['category_name']}</option>";
}
?>
</select>

<select name="supplier_id" required>
<option value="">Select Supplier</option>
<?php
while($s=mysqli_fetch_assoc($suppliers)){
echo "<option value='{$s['supplier_id']}'>{$s['name']}</option>";
}
?>
</select>

<input type="number" name="quantity" placeholder="Quantity" min="0" required>

<input type="date" name="expiry_date" required>

<button type="submit" name="submit">Create</button>

</form>

<?php
if(isset($_POST['submit'])){
InventoryController::create(
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
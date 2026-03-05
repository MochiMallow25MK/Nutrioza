<?php
require_once "../../controllers/DistributionDetailController.php";
require_once "../../controllers/DistributionController.php";
require_once "../../controllers/InventoryController.php";

$dist = DistributionController::list();
$items = InventoryController::list();
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/form.css">
</head>

<body>

<form method="post">

<select name="distribution_id" required>
<option value="">Select Distribution</option>
<?php
while($d=mysqli_fetch_assoc($dist)){
echo "<option value='{$d['distribution_id']}'>Distribution {$d['distribution_id']}</option>";
}
?>
</select>

<select name="item_id" required>
<option value="">Select Item</option>
<?php
while($i=mysqli_fetch_assoc($items)){
echo "<option value='{$i['item_id']}'>{$i['name']}</option>";
}
?>
</select>

<input type="number" name="quantity" min="1" required>

<button type="submit" name="submit">Create</button>

</form>

<?php
if(isset($_POST['submit'])){

DistributionDetailController::create(
$_POST['distribution_id'],
$_POST['item_id'],
$_POST['quantity']
);

header("Location:list.php");
}
?>

</body>
</html>
<?php
require_once "../../controllers/DistributionDetailController.php";
require_once "../../controllers/DistributionController.php";
require_once "../../controllers/InventoryController.php";

$id=$_GET['id'];

$res=DistributionDetailController::list();
while($d=mysqli_fetch_assoc($res)){
if($d['detail_id']==$id) break;
}

$dist=DistributionController::list();
$items=InventoryController::list();
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/form.css">
</head>

<body>

<form method="post">

<select name="distribution_id" required>
<?php
while($ds=mysqli_fetch_assoc($dist)){
$sel=$ds['distribution_id']==$d['distribution_id']?"selected":"";
echo "<option value='{$ds['distribution_id']}' $sel>Distribution {$ds['distribution_id']}</option>";
}
?>
</select>

<select name="item_id" required>
<?php
while($it=mysqli_fetch_assoc($items)){
$sel=$it['item_id']==$d['item_id']?"selected":"";
echo "<option value='{$it['item_id']}' $sel>{$it['name']}</option>";
}
?>
</select>

<input type="number" name="quantity" value="<?=$d['quantity']?>" min="1" required>

<button type="submit" name="submit">Update</button>

</form>

<?php
if(isset($_POST['submit'])){

DistributionDetailController::update(
$id,
$_POST['distribution_id'],
$_POST['item_id'],
$_POST['quantity']
);

header("Location:list.php");
}
?>

</body>
</html>
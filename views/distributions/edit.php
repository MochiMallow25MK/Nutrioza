<?php
require_once "../../controllers/DistributionController.php";
require_once "../../controllers/RecipientController.php";
require_once "../../controllers/UserController.php";

$id = $_GET['id'];

$res = DistributionController::list();

while($d=mysqli_fetch_assoc($res)){
if($d['distribution_id']==$id) break;
}

$recipients = RecipientController::list();
$users = UserController::list();
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/form.css">
</head>

<body>

<form method="post">

<select name="recipient_id" required>
<?php
while($r=mysqli_fetch_assoc($recipients)){
$sel = $r['recipient_id']==$d['recipient_id']?"selected":"";
echo "<option value='{$r['recipient_id']}' $sel>{$r['name']}</option>";
}
?>
</select>

<select name="approved_by">
<?php
while($u=mysqli_fetch_assoc($users)){
$sel = $u['user_id']==$d['approved_by']?"selected":"";
echo "<option value='{$u['user_id']}' $sel>{$u['name']}</option>";
}
?>
</select>

<select name="status">
<option value="Pending" <?=$d['status']=="Pending"?"selected":""?>>Pending</option>
<option value="Approved" <?=$d['status']=="Approved"?"selected":""?>>Approved</option>
<option value="Delivered" <?=$d['status']=="Delivered"?"selected":""?>>Delivered</option>
</select>

<input type="date" name="distribution_date" value="<?=$d['distribution_date']?>" required>

<button type="submit" name="submit">Update</button>

</form>

<?php
if(isset($_POST['submit'])){

DistributionController::update(
$id,
$_POST['recipient_id'],
$_POST['approved_by'],
$_POST['status'],
$_POST['distribution_date']
);

header("Location:list.php");
}
?>

</body>
</html>
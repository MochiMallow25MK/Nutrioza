<?php
require_once "../../controllers/DistributionController.php";
require_once "../../controllers/RecipientController.php";
require_once "../../controllers/UserController.php";

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
<option value="">Select Recipient</option>
<?php
while($r=mysqli_fetch_assoc($recipients)){
echo "<option value='{$r['recipient_id']}'>{$r['name']}</option>";
}
?>
</select>

<select name="approved_by">
<option value="">Approved By</option>
<?php
while($u=mysqli_fetch_assoc($users)){
echo "<option value='{$u['user_id']}'>{$u['name']}</option>";
}
?>
</select>

<select name="status">
<option value="Pending">Pending</option>
<option value="Approved">Approved</option>
<option value="Delivered">Delivered</option>
</select>

<input type="date" name="distribution_date" required>

<button type="submit" name="submit">Create</button>

</form>

<?php
if(isset($_POST['submit'])){
DistributionController::create(
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
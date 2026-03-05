<?php
require_once "../../controllers/VolunteerController.php";
require_once "../../models/UserModel.php";

$id = $_GET['id'];
$res = VolunteerController::list();
while($v=mysqli_fetch_assoc($res)){
if($v['volunteer_id']==$id) break;
}

$users = UserModel::getAll();
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/form.css">
</head>
<body>

<h2>Edit Volunteer</h2>

<form method="post">

<input type="text" name="full_name" value="<?=$v['full_name']?>" required>

<input type="email" name="email" value="<?=$v['email']?>" required>

<input type="text" name="phone" value="<?=$v['phone']?>">

<textarea name="availability"><?=$v['availability']?></textarea>

<textarea name="skills"><?=$v['skills']?></textarea>

<select name="status" required>
<option value="Pending" <?=$v['status']=="Pending"?"selected":""?>>Pending</option>
<option value="Approved" <?=$v['status']=="Approved"?"selected":""?>>Approved</option>
<option value="Rejected" <?=$v['status']=="Rejected"?"selected":""?>>Rejected</option>
</select>

<select name="reviewed_by">
<option value="">Reviewed By</option>
<?php
while($u=mysqli_fetch_assoc($users)){
$sel = $u['user_id']==$v['reviewed_by']?"selected":"";
echo "<option value='{$u['user_id']}' $sel>{$u['name']}</option>";
}
?>
</select>

<button type="submit" name="submit">Update</button>

</form>

<?php
if(isset($_POST['submit'])){
VolunteerController::update(
$id,
$_POST['full_name'],
$_POST['email'],
$_POST['phone'],
$_POST['availability'],
$_POST['skills'],
$_POST['status'],
$_POST['reviewed_by']
);
header("Location:list.php");
}
?>

</body>
</html>
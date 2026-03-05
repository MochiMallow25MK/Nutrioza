<?php
require_once "../../controllers/UserController.php";
require_once "../../models/RoleModel.php";

$id = $_GET['id'];
$res = UserController::list();
while($u=mysqli_fetch_assoc($res)){
if($u['user_id']==$id) break;
}

$roles = RoleModel::getAll();
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/form.css">
<script src="../../assets/js/validation.js"></script>
</head>
<body>

<h2>Edit User</h2>

<form method="post" onsubmit="return formValidate()">

<input type="text" name="name" value="<?=$u['name']?>" required>

<input type="email" name="email" value="<?=$u['email']?>" required>

<input type="password" name="password" placeholder="Leave blank to keep current">

<select name="role_id" required>
<?php
while($r=mysqli_fetch_assoc($roles)){
$sel = $r['role_id']==$u['role_id']?"selected":"";
echo "<option value='{$r['role_id']}' $sel>{$r['role_name']}</option>";
}
?>
</select>

<select name="status" required>
<option value="active" <?=$u['status']=="active"?"selected":""?>>Active</option>
<option value="inactive" <?=$u['status']=="inactive"?"selected":""?>>Inactive</option>
</select>

<button type="submit" name="submit">Update</button>

</form>

<?php
if(isset($_POST['submit'])){
$password = empty($_POST['password']) ? null : $_POST['password'];
UserController::update(
$id,
$_POST['name'],
$_POST['email'],
$password,
$_POST['role_id'],
$_POST['status']
);
header("Location:list.php");
}
?>

</body>
</html>
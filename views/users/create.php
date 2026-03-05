<?php
require_once "../../controllers/UserController.php";
require_once "../../models/RoleModel.php";

$roles = RoleModel::getAll();
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/form.css">
<script src="../../assets/js/validation.js"></script>
</head>
<body>

<h2>Add User</h2>

<form method="post" onsubmit="return formValidate()">

<input type="text" name="name" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<select name="role_id" required>
<option value="">Select Role</option>
<?php
while($r=mysqli_fetch_assoc($roles)){
echo "<option value='{$r['role_id']}'>{$r['role_name']}</option>";
}
?>
</select>

<select name="status" required>
<option value="active">Active</option>
<option value="inactive">Inactive</option>
</select>

<button type="submit" name="submit">Create</button>

</form>

<?php
if(isset($_POST['submit'])){
UserController::create(
$_POST['name'],
$_POST['email'],
$_POST['password'],
$_POST['role_id'],
$_POST['status']
);
header("Location:list.php");
}
?>

</body>
</html>
<?php
require_once "../../controllers/RoleController.php";
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/form.css">
</head>
<body>

<h2>Add Role</h2>

<form method="post">

<input type="text" name="role_name" placeholder="Role Name" required>

<button type="submit" name="submit">Create</button>

</form>

<?php
if(isset($_POST['submit'])){
RoleController::create($_POST['role_name']);
header("Location:list.php");
}
?>

</body>
</html>
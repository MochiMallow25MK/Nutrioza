<?php
require_once "../../controllers/RoleController.php";

$id = $_GET['id'];
$res = RoleController::list();
while($r=mysqli_fetch_assoc($res)){
if($r['role_id']==$id) break;
}
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/form.css">
</head>
<body>

<h2>Edit Role</h2>

<form method="post">

<input type="text" name="role_name" value="<?=$r['role_name']?>" required>

<button type="submit" name="submit">Update</button>

</form>

<?php
if(isset($_POST['submit'])){
RoleController::update($id,$_POST['role_name']);
header("Location:list.php");
}
?>

</body>
</html>
<?php
require_once "../../controllers/UserController.php";
$res = UserController::list();
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/table.css">
</head>
<body>

<a href="create.php">Add User</a>

<table border="1">
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Status</th>
<th>Created At</th>
<th>Actions</th>
</tr>

<?php
while($u=mysqli_fetch_assoc($res)){
echo "<tr>";
echo "<td>{$u['user_id']}</td>";
echo "<td>{$u['name']}</td>";
echo "<td>{$u['email']}</td>";
echo "<td>{$u['role_id']}</td>";
echo "<td>{$u['status']}</td>";
echo "<td>{$u['created_at']}</td>";
echo "<td>
<a href='edit.php?id={$u['user_id']}'>Edit</a> |
<a href='delete.php?id={$u['user_id']}'>Delete</a>
</td>";
echo "</tr>";
}
?>

</table>
</body>
</html>
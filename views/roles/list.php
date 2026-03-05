<?php
require_once "../../controllers/RoleController.php";
$res = RoleController::list();
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/table.css">
</head>
<body>

<a href="create.php">Add Role</a>

<table border="1">
<tr>
<th>ID</th>
<th>Role Name</th>
<th>Actions</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($res)){
echo "<tr>";
echo "<td>{$row['role_id']}</td>";
echo "<td>{$row['role_name']}</td>";
echo "<td>
<a href='edit.php?id={$row['role_id']}'>Edit</a> |
<a href='delete.php?id={$row['role_id']}'>Delete</a>
</td>";
echo "</tr>";
}
?>

</table>
</body>
</html>
<?php
require_once "../../controllers/SupplierController.php";
$res = SupplierController::list();
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/table.css">
</head>
<body>

<a href="create.php">Add Supplier</a>

<table border="1">
<tr>
<th>ID</th>
<th>Name</th>
<th>Contact Info</th>
<th>Address</th>
<th>Created At</th>
<th>Actions</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($res)){
echo "<tr>";
echo "<td>{$row['supplier_id']}</td>";
echo "<td>{$row['name']}</td>";
echo "<td>{$row['contact_info']}</td>";
echo "<td>{$row['address']}</td>";
echo "<td>{$row['created_at']}</td>";
echo "<td>
<a href='edit.php?id={$row['supplier_id']}'>Edit</a> |
<a href='delete.php?id={$row['supplier_id']}'>Delete</a>
</td>";
echo "</tr>";
}
?>

</table>
</body>
</html>
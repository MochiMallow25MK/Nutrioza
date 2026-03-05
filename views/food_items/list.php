<?php
require_once "../../controllers/InventoryController.php";
$res = InventoryController::list();
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/table.css">
</head>
<body>

<a href="create.php">Add Food Item</a>

<table border="1">
<tr>
<th>ID</th>
<th>Name</th>
<th>Category</th>
<th>Supplier</th>
<th>Quantity</th>
<th>Expiry Date</th>
<th>Actions</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($res)){
echo "<tr>";
echo "<td>{$row['item_id']}</td>";
echo "<td>{$row['name']}</td>";
echo "<td>{$row['category_id']}</td>";
echo "<td>{$row['supplier_id']}</td>";
echo "<td>{$row['quantity']}</td>";
echo "<td>{$row['expiry_date']}</td>";
echo "<td>
<a href='edit.php?id={$row['item_id']}'>Edit</a> |
<a href='delete.php?id={$row['item_id']}'>Delete</a>
</td>";
echo "</tr>";
}
?>
</table>

</body>
</html>
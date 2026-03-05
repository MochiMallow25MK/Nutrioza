<?php
require_once "../../controllers/DistributionDetailController.php";
$res = DistributionDetailController::list();
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/table.css">
</head>

<body>

<a href="create.php">Add Detail</a>

<table border="1">

<tr>
<th>ID</th>
<th>Distribution</th>
<th>Item</th>
<th>Quantity</th>
<th>Actions</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($res)){
echo "<tr>";
echo "<td>{$row['detail_id']}</td>";
echo "<td>{$row['distribution_id']}</td>";
echo "<td>{$row['item_id']}</td>";
echo "<td>{$row['quantity']}</td>";
echo "<td>
<a href='edit.php?id={$row['detail_id']}'>Edit</a>
<a href='delete.php?id={$row['detail_id']}'>Delete</a>
</td>";
echo "</tr>";
}
?>

</table>

</body>
</html>
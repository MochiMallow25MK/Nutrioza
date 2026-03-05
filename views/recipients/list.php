<?php
require_once "../../controllers/RecipientController.php";
$res = RecipientController::list();
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/table.css">
</head>
<body>

<a href="create.php">Add Recipient</a>

<table border="1">
<tr>
<th>ID</th>
<th>Name</th>
<th>Type</th>
<th>Contact Info</th>
<th>Address</th>
<th>Actions</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($res)){
echo "<tr>";
echo "<td>{$row['recipient_id']}</td>";
echo "<td>{$row['name']}</td>";
echo "<td>{$row['type']}</td>";
echo "<td>{$row['contact_info']}</td>";
echo "<td>{$row['address']}</td>";
echo "<td>
<a href='edit.php?id={$row['recipient_id']}'>Edit</a> |
<a href='delete.php?id={$row['recipient_id']}'>Delete</a>
</td>";
echo "</tr>";
}
?>

</table>
</body>
</html>
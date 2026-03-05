<?php
require_once "../../controllers/DistributionController.php";
$res = DistributionController::list();
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/table.css">
</head>

<body>

<a href="create.php">Add Distribution</a>

<table border="1">

<tr>
<th>ID</th>
<th>Recipient</th>
<th>Approved By</th>
<th>Status</th>
<th>Date</th>
<th>Actions</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($res)){
echo "<tr>";
echo "<td>{$row['distribution_id']}</td>";
echo "<td>{$row['recipient_id']}</td>";
echo "<td>{$row['approved_by']}</td>";
echo "<td>{$row['status']}</td>";
echo "<td>{$row['distribution_date']}</td>";
echo "<td>
<a href='edit.php?id={$row['distribution_id']}'>Edit</a>
<a href='delete.php?id={$row['distribution_id']}'>Delete</a>
</td>";
echo "</tr>";
}
?>

</table>

</body>
</html>
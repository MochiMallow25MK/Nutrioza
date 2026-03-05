<?php
require_once "../../controllers/DonationController.php";
$res=DonationController::list();
?>

<html>

<head>
<link rel="stylesheet" href="../../assets/css/table.css">
</head>

<body>

<a href="create.php">Add Donation</a>

<table border="1">

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Type</th>
<th>Status</th>
<th>Actions</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($res)){
echo "<tr>";
echo "<td>{$row['donation_id']}</td>";
echo "<td>{$row['donor_name']}</td>";
echo "<td>{$row['donor_email']}</td>";
echo "<td>{$row['donation_type']}</td>";
echo "<td>{$row['status']}</td>";
echo "<td>
<a href='edit.php?id={$row['donation_id']}'>Edit</a>
<a href='delete.php?id={$row['donation_id']}'>Delete</a>
</td>";
echo "</tr>";
}
?>

</table>

</body>
</html>
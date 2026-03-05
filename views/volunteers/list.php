<?php
require_once "../../controllers/VolunteerController.php";
$res = VolunteerController::list();
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/table.css">
</head>
<body>

<a href="create.php">Add Volunteer</a>

<table border="1">
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Availability</th>
<th>Skills</th>
<th>Status</th>
<th>Reviewed By</th>
<th>Actions</th>
</tr>

<?php
while($v=mysqli_fetch_assoc($res)){
echo "<tr>";
echo "<td>{$v['volunteer_id']}</td>";
echo "<td>{$v['full_name']}</td>";
echo "<td>{$v['email']}</td>";
echo "<td>{$v['phone']}</td>";
echo "<td>{$v['availability']}</td>";
echo "<td>{$v['skills']}</td>";
echo "<td>{$v['status']}</td>";
echo "<td>{$v['reviewed_by']}</td>";
echo "<td>
<a href='edit.php?id={$v['volunteer_id']}'>Edit</a> |
<a href='delete.php?id={$v['volunteer_id']}'>Delete</a>
</td>";
echo "</tr>";
}
?>

</table>
</body>
</html>
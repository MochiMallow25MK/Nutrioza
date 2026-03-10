<?php
session_start();
require 'config.php';
$result = mysqli_query($link, "SELECT v.*, u.name as reviewer_name FROM volunteers v LEFT JOIN users u ON v.reviewed_by = u.user_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Volunteers Management</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <h2>Volunteers Management</h2>
    <a class="add-btn" href="volunteers_create.php">Add New Volunteer</a>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['volunteer_id'] ?></td>
            <td><?= $row['full_name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= $row['status'] ?></td>
            <td class="actions">
                <a class="btn view" href="volunteers_read.php?volunteer_id=<?= $row['volunteer_id'] ?>">View</a>
                <a class="btn edit" href="volunteers_update.php?volunteer_id=<?= $row['volunteer_id'] ?>">Edit</a>
                <a class="btn delete" href="volunteers_delete.php?volunteer_id=<?= $row['volunteer_id'] ?>" 
                   onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
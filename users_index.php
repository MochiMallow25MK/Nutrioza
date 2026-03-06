<?php
session_start();
require 'config.php';
$result = mysqli_query($link, "SELECT u.*, r.role_name FROM users u JOIN roles r ON u.role_id = r.role_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users Management</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <h2>Users Management</h2>
    <a class="add-btn" href="users_create.php">Add New User</a>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['user_id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['role_name'] ?></td>
            <td><?= $row['status'] ?></td>
            <td class="actions">
                <a class="btn view" href="users_read.php?user_id=<?= $row['user_id'] ?>">View</a>
                <a class="btn edit" href="users_update.php?user_id=<?= $row['user_id'] ?>">Edit</a>
                <a class="btn delete" href="users_delete.php?user_id=<?= $row['user_id'] ?>" 
                   onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
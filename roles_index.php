<?php
session_start();
require 'config.php';
$result = mysqli_query($link, "SELECT * FROM roles");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Roles Management</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <h2>Roles Management</h2>
    <a class="add-btn" href="roles_create.php">Add New Role</a>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Role Name</th>
            <th>Actions</th>
        </tr>
        
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['role_id'] ?></td>
            <td><?= $row['role_name'] ?></td>
            <td class="actions">
                <a class="btn view" href="roles_read.php?role_id=<?= $row['role_id'] ?>">View</a>
                <a class="btn edit" href="roles_update.php?role_id=<?= $row['role_id'] ?>">Edit</a>
                <a class="btn delete" href="roles_delete.php?role_id=<?= $row['role_id'] ?>" 
                   onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
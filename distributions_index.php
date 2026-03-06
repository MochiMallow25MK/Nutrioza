<?php
session_start();
require 'config.php';
$result = mysqli_query($link, "SELECT d.*, r.name as recipient_name, u.name as approver_name FROM distributions d JOIN recipients r ON d.recipient_id = r.recipient_id LEFT JOIN users u ON d.approved_by = u.user_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Distributions Management</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <h2>Distributions Management</h2>
    <a class="add-btn" href="distributions_create.php">Add New Distribution</a>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Recipient</th>
            <th>Status</th>
            <th>Distribution Date</th>
            <th>Actions</th>
        </tr>
        
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['distribution_id'] ?></td>
            <td><?= $row['recipient_name'] ?></td>
            <td><?= $row['status'] ?></td>
            <td><?= $row['distribution_date'] ?></td>
            <td class="actions">
                <a class="btn view" href="distributions_read.php?distribution_id=<?= $row['distribution_id'] ?>">View</a>
                <a class="btn edit" href="distributions_update.php?distribution_id=<?= $row['distribution_id'] ?>">Edit</a>
                <a class="btn delete" href="distributions_delete.php?distribution_id=<?= $row['distribution_id'] ?>" 
                   onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
<?php
session_start();
require 'config.php';
$result = mysqli_query($link, "SELECT * FROM recipients");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recipients Management</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <h2>Recipients Management</h2>
    <a class="add-btn" href="recipients_create.php">Add New Recipient</a>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Contact Info</th>
            <th>Actions</th>
        </tr>
        
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['recipient_id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['type'] ?></td>
            <td><?= $row['contact_info'] ?></td>
            <td class="actions">
                <a class="btn view" href="recipients_read.php?recipient_id=<?= $row['recipient_id'] ?>">View</a>
                <a class="btn edit" href="recipients_update.php?recipient_id=<?= $row['recipient_id'] ?>">Edit</a>
                <a class="btn delete" href="recipients_delete.php?recipient_id=<?= $row['recipient_id'] ?>" 
                   onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
<?php
session_start();
require 'config.php';
$result = mysqli_query($link, "SELECT dd.*, d.distribution_id as dist_id, f.name as item_name FROM distribution_details dd JOIN distributions d ON dd.distribution_id = d.distribution_id JOIN food_items f ON dd.item_id = f.item_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Distribution Details Management</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <h2>Distribution Details Management</h2>
    <a class="add-btn" href="distribution_details_create.php">Add New Detail</a>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Distribution ID</th>
            <th>Item</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['detail_id'] ?></td>
            <td><?= $row['distribution_id'] ?></td>
            <td><?= $row['item_name'] ?></td>
            <td><?= $row['quantity'] ?></td>
            <td class="actions">
                <a class="btn view" href="distribution_details_read.php?detail_id=<?= $row['detail_id'] ?>">View</a>
                <a class="btn edit" href="distribution_details_update.php?detail_id=<?= $row['detail_id'] ?>">Edit</a>
                <a class="btn delete" href="distribution_details_delete.php?detail_id=<?= $row['detail_id'] ?>" 
                   onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
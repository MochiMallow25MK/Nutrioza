<?php
session_start();
require 'config.php';
$result = mysqli_query($link, "SELECT * FROM suppliers");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Suppliers Management</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <h2>Suppliers Management</h2>
    <a class="add-btn" href="suppliers_create.php">Add New Supplier</a>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Contact Info</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
        
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['supplier_id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['contact_info'] ?></td>
            <td><?= substr($row['address'], 0, 30) ?>...</td>
            <td class="actions">
                <a class="btn view" href="suppliers_read.php?supplier_id=<?= $row['supplier_id'] ?>">View</a>
                <a class="btn edit" href="suppliers_update.php?supplier_id=<?= $row['supplier_id'] ?>">Edit</a>
                <a class="btn delete" href="suppliers_delete.php?supplier_id=<?= $row['supplier_id'] ?>" 
                   onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
<?php
session_start();
require 'config.php';
$result = mysqli_query($link, "SELECT f.*, c.category_name, s.name as supplier_name FROM food_items f JOIN categories c ON f.category_id = c.category_id JOIN suppliers s ON f.supplier_id = s.supplier_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Food Items Management</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <h2>Food Items Management</h2>
    <a class="add-btn" href="food_items_create.php">Add New Food Item</a>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Supplier</th>
            <th>Quantity</th>
            <th>Expiry Date</th>
            <th>Actions</th>
        </tr>
        
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['item_id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['category_name'] ?></td>
            <td><?= $row['supplier_name'] ?></td>
            <td><?= $row['quantity'] ?></td>
            <td><?= $row['expiry_date'] ?></td>
            <td class="actions">
                <a class="btn view" href="food_items_read.php?item_id=<?= $row['item_id'] ?>">View</a>
                <a class="btn edit" href="food_items_update.php?item_id=<?= $row['item_id'] ?>">Edit</a>
                <a class="btn delete" href="food_items_delete.php?item_id=<?= $row['item_id'] ?>" 
                   onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
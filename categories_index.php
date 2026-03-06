<?php
session_start();
require 'config.php';
$result = mysqli_query($link, "SELECT * FROM categories");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Categories Management</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <h2>Categories Management</h2>
    <a class="add-btn" href="categories_create.php">Add New Category</a>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Actions</th>
        </tr>
        
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['category_id'] ?></td>
            <td><?= $row['category_name'] ?></td>
            <td class="actions">
                <a class="btn view" href="categories_read.php?category_id=<?= $row['category_id'] ?>">View</a>
                <a class="btn edit" href="categories_update.php?category_id=<?= $row['category_id'] ?>">Edit</a>
                <a class="btn delete" href="categories_delete.php?category_id=<?= $row['category_id'] ?>" 
                   onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
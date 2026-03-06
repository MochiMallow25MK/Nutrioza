<?php
session_start();
require 'config.php';

if (isset($_GET['item_id'])) {
    $item_id = (int)$_GET['item_id'];
    $sql = "SELECT f.*, c.category_name, s.name as supplier_name, s.contact_info, s.address 
            FROM food_items f 
            JOIN categories c ON f.category_id = c.category_id 
            JOIN suppliers s ON f.supplier_id = s.supplier_id 
            WHERE f.item_id = $item_id";
    $result = mysqli_query($link, $sql);
    
    if ($row = mysqli_fetch_assoc($result)) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Food Item</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Food Item Details</h2>
        <p><strong>ID:</strong> <?= $row['item_id'] ?></p>
        <p><strong>Name:</strong> <?= $row['name'] ?></p>
        <p><strong>Category:</strong> <?= $row['category_name'] ?></p>
        <p><strong>Supplier:</strong> <?= $row['supplier_name'] ?></p>
        <p><strong>Quantity:</strong> <?= $row['quantity'] ?></p>
        <p><strong>Expiry Date:</strong> <?= $row['expiry_date'] ?></p>
        <p><strong>Created At:</strong> <?= $row['created_at'] ?></p>
        <a href="food_items_index.php" class="back-link">Back to Food Items</a>
    </div>
</body>
</html>
<?php
    } else {
        echo "Food item not found. <a href='food_items_index.php'>Back</a>";
    }
}
?>
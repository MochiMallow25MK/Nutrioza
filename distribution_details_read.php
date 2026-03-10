<?php
session_start();
require 'config.php';

if (isset($_GET['detail_id'])) {
    $detail_id = (int)$_GET['detail_id'];
    $sql = "SELECT dd.*, d.distribution_id, d.status, f.name as item_name, f.quantity as stock 
            FROM distribution_details dd 
            JOIN distributions d ON dd.distribution_id = d.distribution_id 
            JOIN food_items f ON dd.item_id = f.item_id 
            WHERE dd.detail_id = $detail_id";
    $result = mysqli_query($link, $sql);
    
    if ($row = mysqli_fetch_assoc($result)) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Distribution Detail</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Distribution Detail</h2>
        <p><strong>Detail ID:</strong> <?= $row['detail_id'] ?></p>
        <p><strong>Distribution ID:</strong> <?= $row['distribution_id'] ?></p>
        <p><strong>Distribution Status:</strong> <?= $row['status'] ?></p>
        <p><strong>Item:</strong> <?= $row['item_name'] ?></p>
        <p><strong>Quantity Distributed:</strong> <?= $row['quantity'] ?></p>
        <p><strong>Current Stock:</strong> <?= $row['stock'] ?></p>
        <a href="distribution_details_index.php" class="back-link">Back to Details</a>
    </div>
</body>
</html>
<?php
    } else {
        echo "Detail not found. <a href='distribution_details_index.php'>Back</a>";
    }
}
?>
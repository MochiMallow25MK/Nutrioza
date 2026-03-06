<?php
session_start();
require 'config.php';

if (isset($_GET['supplier_id'])) {
    $supplier_id = (int)$_GET['supplier_id'];
    $sql = "SELECT * FROM suppliers WHERE supplier_id = $supplier_id";
    $result = mysqli_query($link, $sql);
    
    if ($row = mysqli_fetch_assoc($result)) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Supplier</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Supplier Details</h2>
        <p><strong>ID:</strong> <?= $row['supplier_id'] ?></p>
        <p><strong>Name:</strong> <?= $row['name'] ?></p>
        <p><strong>Contact Info:</strong> <?= $row['contact_info'] ?></p>
        <p><strong>Address:</strong> <?= nl2br($row['address']) ?></p>
        <p><strong>Created At:</strong> <?= $row['created_at'] ?></p>
        <a href="suppliers_index.php" class="back-link">Back to Suppliers</a>
    </div>
</body>
</html>
<?php
    } else {
        echo "Supplier not found. <a href='suppliers_index.php'>Back</a>";
    }
}
?>
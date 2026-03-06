<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $contact_info = mysqli_real_escape_string($link, $_POST['contact_info']);
    $address = mysqli_real_escape_string($link, $_POST['address']);
    
    $sql = "INSERT INTO suppliers (name, contact_info, address) VALUES ('$name', '$contact_info', '$address')";
    
    if (mysqli_query($link, $sql)) {
        header("Location: suppliers_index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Supplier</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Add New Supplier</h2>
        <form method="POST">
            <div class="form-group">
                <label>Supplier Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Contact Information</label>
                <input type="text" name="contact_info">
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea name="address" rows="3"></textarea>
            </div>
            <button type="submit">Add Supplier</button>
        </form>
        <a href="suppliers_index.php" class="back-link">Back to Suppliers</a>
    </div>
</body>
</html>
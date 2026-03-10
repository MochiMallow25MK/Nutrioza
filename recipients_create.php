<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $type = mysqli_real_escape_string($link, $_POST['type']);
    $contact_info = mysqli_real_escape_string($link, $_POST['contact_info']);
    $address = mysqli_real_escape_string($link, $_POST['address']);
    
    $sql = "INSERT INTO recipients (name, type, contact_info, address) VALUES ('$name', '$type', '$contact_info', '$address')";
    
    if (mysqli_query($link, $sql)) {
        header("Location: recipients_index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Recipient</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Add New Recipient</h2>
        <form method="POST">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Type</label>
                <select name="type" required>
                    <option value="">Select Type</option>
                    <option value="NGO">NGO</option>
                    <option value="Kitchen">Kitchen</option>
                    <option value="Store">Store</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label>Contact Information</label>
                <input type="text" name="contact_info">
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea name="address" rows="3"></textarea>
            </div>
            <button type="submit">Add Recipient</button>
        </form>
        <a href="recipients_index.php" class="back-link">Back to Recipients</a>
    </div>
</body>
</html>
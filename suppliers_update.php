<?php
session_start();
require 'config.php';

if (isset($_GET['supplier_id'])) {
    $supplier_id = (int)$_GET['supplier_id'];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = mysqli_real_escape_string($link, $_POST['name']);
        $contact_info = mysqli_real_escape_string($link, $_POST['contact_info']);
        $address = mysqli_real_escape_string($link, $_POST['address']);
        
        $sql = "UPDATE suppliers SET name='$name', contact_info='$contact_info', address='$address' WHERE supplier_id=$supplier_id";
        
        if (mysqli_query($link, $sql)) {
            header("Location: suppliers_index.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }
    
    $result = mysqli_query($link, "SELECT * FROM suppliers WHERE supplier_id=$supplier_id");
    $row = mysqli_fetch_assoc($result);
    
    if (!$row) {
        echo "Supplier not found. <a href='suppliers_index.php'>Back</a>";
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Supplier</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Update Supplier</h2>
        <form method="POST">
            <div class="form-group">
                <label>Supplier Name</label>
                <input type="text" name="name" value="<?= $row['name'] ?>" required>
            </div>
            <div class="form-group">
                <label>Contact Information</label>
                <input type="text" name="contact_info" value="<?= $row['contact_info'] ?>">
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea name="address" rows="3"><?= $row['address'] ?></textarea>
            </div>
            <button type="submit">Update Supplier</button>
        </form>
        <a href="suppliers_index.php" class="back-link">Back to Suppliers</a>
    </div>
</body>
</html>
<?php } ?>
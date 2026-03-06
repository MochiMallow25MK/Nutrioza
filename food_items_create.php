<?php
session_start();
require 'config.php';

$categories = mysqli_query($link, "SELECT * FROM categories");
$suppliers = mysqli_query($link, "SELECT * FROM suppliers");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $category_id = (int)$_POST['category_id'];
    $supplier_id = (int)$_POST['supplier_id'];
    $quantity = (int)$_POST['quantity'];
    $expiry_date = mysqli_real_escape_string($link, $_POST['expiry_date']);
    
    $sql = "INSERT INTO food_items (name, category_id, supplier_id, quantity, expiry_date) 
            VALUES ('$name', $category_id, $supplier_id, $quantity, '$expiry_date')";
    
    if (mysqli_query($link, $sql)) {
        header("Location: food_items_index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Food Item</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Add New Food Item</h2>
        <form method="POST">
            <div class="form-group">
                <label>Item Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select name="category_id" required>
                    <option value="">Select Category</option>
                    <?php while($cat = mysqli_fetch_assoc($categories)) { ?>
                        <option value="<?= $cat['category_id'] ?>"><?= $cat['category_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Supplier</label>
                <select name="supplier_id" required>
                    <option value="">Select Supplier</option>
                    <?php while($sup = mysqli_fetch_assoc($suppliers)) { ?>
                        <option value="<?= $sup['supplier_id'] ?>"><?= $sup['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" required>
            </div>
            <div class="form-group">
                <label>Expiry Date</label>
                <input type="date" name="expiry_date" required>
            </div>
            <button type="submit">Add Food Item</button>
        </form>
        <a href="food_items_index.php" class="back-link">Back to Food Items</a>
    </div>
</body>
</html>
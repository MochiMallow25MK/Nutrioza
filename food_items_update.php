<?php
session_start();
require 'config.php';

if (isset($_GET['item_id'])) {
    $item_id = (int)$_GET['item_id'];
    $categories = mysqli_query($link, "SELECT * FROM categories");
    $suppliers = mysqli_query($link, "SELECT * FROM suppliers");
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = mysqli_real_escape_string($link, $_POST['name']);
        $category_id = (int)$_POST['category_id'];
        $supplier_id = (int)$_POST['supplier_id'];
        $quantity = (int)$_POST['quantity'];
        $expiry_date = mysqli_real_escape_string($link, $_POST['expiry_date']);
        
        $sql = "UPDATE food_items SET name='$name', category_id=$category_id, supplier_id=$supplier_id, quantity=$quantity, expiry_date='$expiry_date' WHERE item_id=$item_id";
        
        if (mysqli_query($link, $sql)) {
            header("Location: food_items_index.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }
    
    $result = mysqli_query($link, "SELECT * FROM food_items WHERE item_id=$item_id");
    $row = mysqli_fetch_assoc($result);
    
    if (!$row) {
        echo "Food item not found. <a href='food_items_index.php'>Back</a>";
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Food Item</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Update Food Item</h2>
        <form method="POST">
            <div class="form-group">
                <label>Item Name</label>
                <input type="text" name="name" value="<?= $row['name'] ?>" required>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select name="category_id" required>
                    <?php while($cat = mysqli_fetch_assoc($categories)) { ?>
                        <option value="<?= $cat['category_id'] ?>" <?= $cat['category_id'] == $row['category_id'] ? 'selected' : '' ?>><?= $cat['category_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Supplier</label>
                <select name="supplier_id" required>
                    <?php while($sup = mysqli_fetch_assoc($suppliers)) { ?>
                        <option value="<?= $sup['supplier_id'] ?>" <?= $sup['supplier_id'] == $row['supplier_id'] ? 'selected' : '' ?>><?= $sup['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" value="<?= $row['quantity'] ?>" required>
            </div>
            <div class="form-group">
                <label>Expiry Date</label>
                <input type="date" name="expiry_date" value="<?= $row['expiry_date'] ?>" required>
            </div>
            <button type="submit">Update Food Item</button>
        </form>
        <a href="food_items_index.php" class="back-link">Back to Food Items</a>
    </div>
</body>
</html>
<?php } ?>
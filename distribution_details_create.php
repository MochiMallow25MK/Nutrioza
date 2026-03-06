<?php
session_start();
require 'config.php';

$distributions = mysqli_query($link, "SELECT * FROM distributions WHERE status='Pending'");
$food_items = mysqli_query($link, "SELECT * FROM food_items WHERE quantity > 0");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $distribution_id = (int)$_POST['distribution_id'];
    $item_id = (int)$_POST['item_id'];
    $quantity = (int)$_POST['quantity'];
    
    $check = mysqli_query($link, "SELECT quantity FROM food_items WHERE item_id=$item_id");
    $item = mysqli_fetch_assoc($check);
    
    if ($quantity > $item['quantity']) {
        echo "<script>alert('Not enough stock! Available: " . $item['quantity'] . "');</script>";
    } else {
        $sql = "INSERT INTO distribution_details (distribution_id, item_id, quantity) VALUES ($distribution_id, $item_id, $quantity)";
        
        if (mysqli_query($link, $sql)) {
            mysqli_query($link, "UPDATE food_items SET quantity = quantity - $quantity WHERE item_id=$item_id");
            header("Location: distribution_details_index.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Distribution Detail</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Add Items to Distribution</h2>
        <form method="POST">
            <div class="form-group">
                <label>Distribution</label>
                <select name="distribution_id" required>
                    <option value="">Select Distribution</option>
                    <?php while($dist = mysqli_fetch_assoc($distributions)) { ?>
                        <option value="<?= $dist['distribution_id'] ?>">Distribution #<?= $dist['distribution_id'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Food Item</label>
                <select name="item_id" required>
                    <option value="">Select Item</option>
                    <?php while($item = mysqli_fetch_assoc($food_items)) { ?>
                        <option value="<?= $item['item_id'] ?>"><?= $item['name'] ?> (Stock: <?= $item['quantity'] ?>)</option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" required>
            </div>
            <button type="submit">Add to Distribution</button>
        </form>
        <a href="distribution_details_index.php" class="back-link">Back to Details</a>
    </div>
</body>
</html>
<?php
session_start();
require 'config.php';

if (isset($_GET['detail_id'])) {
    $detail_id = (int)$_GET['detail_id'];
    $food_items = mysqli_query($link, "SELECT * FROM food_items");
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $item_id = (int)$_POST['item_id'];
        $quantity = (int)$_POST['quantity'];
        
        $old = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM distribution_details WHERE detail_id=$detail_id"));
        
        mysqli_query($link, "UPDATE food_items SET quantity = quantity + {$old['quantity']} WHERE item_id={$old['item_id']}");
        
        $check = mysqli_query($link, "SELECT quantity FROM food_items WHERE item_id=$item_id");
        $item = mysqli_fetch_assoc($check);
        
        if ($quantity > $item['quantity']) {
            echo "<script>alert('Not enough stock! Available: " . $item['quantity'] . "');</script>";
            mysqli_query($link, "UPDATE food_items SET quantity = quantity - {$old['quantity']} WHERE item_id={$old['item_id']}");
        } else {
            $sql = "UPDATE distribution_details SET item_id=$item_id, quantity=$quantity WHERE detail_id=$detail_id";
            
            if (mysqli_query($link, $sql)) {
                mysqli_query($link, "UPDATE food_items SET quantity = quantity - $quantity WHERE item_id=$item_id");
                header("Location: distribution_details_index.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($link);
            }
        }
    }
    
    $result = mysqli_query($link, "SELECT * FROM distribution_details WHERE detail_id=$detail_id");
    $row = mysqli_fetch_assoc($result);
    
    if (!$row) {
        echo "Detail not found. <a href='distribution_details_index.php'>Back</a>";
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Distribution Detail</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Update Distribution Detail</h2>
        <form method="POST">
            <div class="form-group">
                <label>Food Item</label>
                <select name="item_id" required>
                    <?php while($item = mysqli_fetch_assoc($food_items)) { ?>
                        <option value="<?= $item['item_id'] ?>" <?= $item['item_id'] == $row['item_id'] ? 'selected' : '' ?>>
                            <?= $item['name'] ?> (Stock: <?= $item['quantity'] ?>)
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" value="<?= $row['quantity'] ?>" required>
            </div>
            <button type="submit">Update Detail</button>
        </form>
        <a href="distribution_details_index.php" class="back-link">Back to Details</a>
    </div>
</body>
</html>
<?php } ?>
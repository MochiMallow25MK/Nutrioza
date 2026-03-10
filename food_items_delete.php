<?php
session_start();
require 'config.php';

if (isset($_GET['item_id'])) {
    $item_id = (int)$_GET['item_id'];
    
    $check = mysqli_query($link, "SELECT * FROM distribution_details WHERE item_id=$item_id");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Cannot delete food item with distribution records!'); window.location.href='food_items_index.php';</script>";
        exit();
    }
    
    $sql = "DELETE FROM food_items WHERE item_id=$item_id";
    
    if (mysqli_query($link, $sql)) {
        header("Location: food_items_index.php");
    } else {
        echo "Error: " . mysqli_error($link);
    }
} else {
    header("Location: food_items_index.php");
}
?>
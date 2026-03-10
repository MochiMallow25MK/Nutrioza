<?php
session_start();
require 'config.php';

if (isset($_GET['detail_id'])) {
    $detail_id = (int)$_GET['detail_id'];
    
    $detail = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM distribution_details WHERE detail_id=$detail_id"));
    
    mysqli_query($link, "UPDATE food_items SET quantity = quantity + {$detail['quantity']} WHERE item_id={$detail['item_id']}");
    
    $sql = "DELETE FROM distribution_details WHERE detail_id=$detail_id";
    
    if (mysqli_query($link, $sql)) {
        header("Location: distribution_details_index.php");
    } else {
        echo "Error: " . mysqli_error($link);
    }
} else {
    header("Location: distribution_details_index.php");
}
?>
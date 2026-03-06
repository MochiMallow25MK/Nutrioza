<?php
session_start();
require 'config.php';

if (isset($_GET['supplier_id'])) {
    $supplier_id = (int)$_GET['supplier_id'];
    
    $check = mysqli_query($link, "SELECT * FROM food_items WHERE supplier_id=$supplier_id");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Cannot delete supplier with food items!'); window.location.href='suppliers_index.php';</script>";
        exit();
    }
    
    $sql = "DELETE FROM suppliers WHERE supplier_id=$supplier_id";
    
    if (mysqli_query($link, $sql)) {
        header("Location: suppliers_index.php");
    } else {
        echo "Error: " . mysqli_error($link);
    }
} else {
    header("Location: suppliers_index.php");
}
?>
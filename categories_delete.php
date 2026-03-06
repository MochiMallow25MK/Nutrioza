<?php
session_start();
require 'config.php';

if (isset($_GET['category_id'])) {
    $category_id = (int)$_GET['category_id'];
    
    $check = mysqli_query($link, "SELECT * FROM food_items WHERE category_id=$category_id");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Cannot delete category with food items!'); window.location.href='categories_index.php';</script>";
        exit();
    }
    
    $sql = "DELETE FROM categories WHERE category_id=$category_id";
    
    if (mysqli_query($link, $sql)) {
        header("Location: categories_index.php");
    } else {
        echo "Error: " . mysqli_error($link);
    }
} else {
    header("Location: categories_index.php");
}
?>
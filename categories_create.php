<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = mysqli_real_escape_string($link, $_POST['category_name']);
    
    $sql = "INSERT INTO categories (category_name) VALUES ('$category_name')";
    
    if (mysqli_query($link, $sql)) {
        header("Location: categories_index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Add New Category</h2>
        <form method="POST">
            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="category_name" required>
            </div>
            <button type="submit">Add Category</button>
        </form>
        <a href="categories_index.php" class="back-link">Back to Categories</a>
    </div>
</body>
</html>
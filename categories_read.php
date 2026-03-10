<?php
session_start();
require 'config.php';

if (isset($_GET['category_id'])) {
    $category_id = (int)$_GET['category_id'];
    $sql = "SELECT * FROM categories WHERE category_id = $category_id";
    $result = mysqli_query($link, $sql);
    
    if ($row = mysqli_fetch_assoc($result)) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Category</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Category Details</h2>
        <p><strong>ID:</strong> <?= $row['category_id'] ?></p>
        <p><strong>Category Name:</strong> <?= $row['category_name'] ?></p>
        <a href="categories_index.php" class="back-link">Back to Categories</a>
    </div>
</body>
</html>
<?php
    } else {
        echo "Category not found. <a href='categories_index.php'>Back</a>";
    }
}
?>
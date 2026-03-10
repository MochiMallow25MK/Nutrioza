<?php
session_start();
require 'config.php';

if (isset($_GET['category_id'])) {
    $category_id = (int)$_GET['category_id'];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $category_name = mysqli_real_escape_string($link, $_POST['category_name']);
        
        $sql = "UPDATE categories SET category_name='$category_name' WHERE category_id=$category_id";
        
        if (mysqli_query($link, $sql)) {
            header("Location: categories_index.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }
    
    $result = mysqli_query($link, "SELECT * FROM categories WHERE category_id=$category_id");
    $row = mysqli_fetch_assoc($result);
    
    if (!$row) {
        echo "Category not found. <a href='categories_index.php'>Back</a>";
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Category</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Update Category</h2>
        <form method="POST">
            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="category_name" value="<?= $row['category_name'] ?>" required>
            </div>
            <button type="submit">Update Category</button>
        </form>
        <a href="categories_index.php" class="back-link">Back to Categories</a>
    </div>
</body>
</html>
<?php } ?>
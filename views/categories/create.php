<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $category_name = $_POST['category_name'];

    $stmt = $pdo->prepare("INSERT INTO categories (category_name) VALUES (?)");
    $stmt->execute([$category_name]);

    header("Location: list.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Category</title>
</head>
<body>

<h2>Add Category</h2>

<form method="POST">

<label>Category Name</label><br>
<input type="text" name="category_name" required>

<br><br>

<button type="submit">Add Category</button>

</form>

<br>
<a href="list.php">Back to Categories</a>

</body>
</html>
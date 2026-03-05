<?php
require 'db.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM categories WHERE category_id = ?");
$stmt->execute([$id]);
$category = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $category_name = $_POST['category_name'];

    $stmt = $pdo->prepare("UPDATE categories SET category_name = ? WHERE category_id = ?");
    $stmt->execute([$category_name, $id]);

    header("Location: list.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Category</title>
</head>
<body>

<h2>Edit Category</h2>

<form method="POST">

<label>Category Name</label><br>

<input type="text" name="category_name"
value="<?php echo $category['category_name']; ?>" required>

<br><br>

<button type="submit">Update</button>

</form>

<br>
<a href="list.php">Back</a>

</body>
</html>
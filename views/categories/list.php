<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM categories ORDER BY category_id DESC");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>Categories</title>
</head>
<body>

<h2>Categories List</h2>

<a href="create.php">Add New Category</a>

<br><br>

<table border="1" cellpadding="10">

<tr>
<th>ID</th>
<th>Category Name</th>
<th>Actions</th>
</tr>

<?php foreach ($categories as $category): ?>

<tr>
<td><?php echo $category['category_id']; ?></td>
<td><?php echo $category['category_name']; ?></td>

<td>
<a href="edit.php?id=<?php echo $category['category_id']; ?>">Edit</a> |
<a href="delete.php?id=<?php echo $category['category_id']; ?>" onclick="return confirm('Delete this category?')">Delete</a>
</td>

</tr>

<?php endforeach; ?>

</table>

</body>
</html>
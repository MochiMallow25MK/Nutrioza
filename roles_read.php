<?php
session_start();
require 'config.php';

if (isset($_GET['role_id'])) {
    $role_id = (int)$_GET['role_id'];
    $sql = "SELECT * FROM roles WHERE role_id = $role_id";
    $result = mysqli_query($link, $sql);
    
    if ($row = mysqli_fetch_assoc($result)) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Role</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Role Details</h2>
        <p><strong>ID:</strong> <?= $row['role_id'] ?></p>
        <p><strong>Role Name:</strong> <?= $row['role_name'] ?></p>
        <a href="roles_index.php" class="back-link">Back to Roles</a>
    </div>
</body>
</html>
<?php
    } else {
        echo "Role not found. <a href='roles_index.php'>Back</a>";
    }
}
?>
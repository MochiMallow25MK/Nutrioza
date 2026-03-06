<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role_name = mysqli_real_escape_string($link, $_POST['role_name']);
    
    $sql = "INSERT INTO roles (role_name) VALUES ('$role_name')";
    
    if (mysqli_query($link, $sql)) {
        header("Location: roles_index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Role</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Add New Role</h2>
        <form method="POST">
            <div class="form-group">
                <label>Role Name</label>
                <input type="text" name="role_name" required>
            </div>
            <button type="submit">Add Role</button>
        </form>
        <a href="roles_index.php" class="back-link">Back to Roles</a>
    </div>
</body>
</html>
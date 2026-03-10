<?php
session_start();
require 'config.php';

$roles = mysqli_query($link, "SELECT * FROM roles");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role_id = (int)$_POST['role_id'];
    $status = mysqli_real_escape_string($link, $_POST['status']);
    
    $sql = "INSERT INTO users (name, email, password, role_id, status) VALUES ('$name', '$email', '$password', $role_id, '$status')";
    
    if (mysqli_query($link, $sql)) {
        header("Location: users_index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Add New User</h2>
        <form method="POST">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label>Role</label>
                <select name="role_id" required>
                    <?php while($role = mysqli_fetch_assoc($roles)) { ?>
                        <option value="<?= $role['role_id'] ?>"><?= $role['role_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            
            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            
            <button type="submit">Add User</button>
        </form>
        <a href="users_index.php" class="back-link">Back to Users</a>
    </div>
</body>
</html>
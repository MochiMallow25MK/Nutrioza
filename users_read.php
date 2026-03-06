<?php
session_start();
require 'config.php';

if (isset($_GET['user_id'])) {
    $user_id = (int)$_GET['user_id'];
    $sql = "SELECT u.*, r.role_name FROM users u JOIN roles r ON u.role_id = r.role_id WHERE u.user_id = $user_id";
    $result = mysqli_query($link, $sql);
    
    if ($row = mysqli_fetch_assoc($result)) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>View User</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>User Details</h2>
        <p><strong>ID:</strong> <?= $row['user_id'] ?></p>
        <p><strong>Name:</strong> <?= $row['name'] ?></p>
        <p><strong>Email:</strong> <?= $row['email'] ?></p>
        <p><strong>Role:</strong> <?= $row['role_name'] ?></p>
        <p><strong>Status:</strong> <?= $row['status'] ?></p>
        <p><strong>Created At:</strong> <?= $row['created_at'] ?></p>
        <a href="users_index.php" class="back-link">Back to Users</a>
    </div>
</body>
</html>
<?php
    } else {
        echo "User not found. <a href='users_index.php'>Back</a>";
    }
}
?>
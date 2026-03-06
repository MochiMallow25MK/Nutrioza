<?php
session_start();
require 'config.php';

if (isset($_GET['user_id'])) {
    $user_id = (int)$_GET['user_id'];
    $roles = mysqli_query($link, "SELECT * FROM roles");
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = mysqli_real_escape_string($link, $_POST['name']);
        $email = mysqli_real_escape_string($link, $_POST['email']);
        $role_id = (int)$_POST['role_id'];
        $status = mysqli_real_escape_string($link, $_POST['status']);
        
        $sql = "UPDATE users SET name='$name', email='$email', role_id=$role_id, status='$status' WHERE user_id=$user_id";
        
        if (mysqli_query($link, $sql)) {
            header("Location: users_index.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }
    
    $result = mysqli_query($link, "SELECT * FROM users WHERE user_id=$user_id");
    $row = mysqli_fetch_assoc($result);
    
    if (!$row) {
        echo "User not found. <a href='users_index.php'>Back</a>";
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Update User</h2>
        <form method="POST">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?= $row['name'] ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= $row['email'] ?>" required>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role_id" required>
                    <?php while($role = mysqli_fetch_assoc($roles)) { ?>
                        <option value="<?= $role['role_id'] ?>" <?= $role['role_id'] == $row['role_id'] ? 'selected' : '' ?>><?= $role['role_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="active" <?= $row['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= $row['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
            <button type="submit">Update User</button>
        </form>
        <a href="users_index.php" class="back-link">Back to Users</a>
    </div>
</body>
</html>
<?php } ?>
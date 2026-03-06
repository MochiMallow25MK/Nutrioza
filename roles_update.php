<?php
session_start();
require 'config.php';

if (isset($_GET['role_id'])) {
    $role_id = (int)$_GET['role_id'];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $role_name = mysqli_real_escape_string($link, $_POST['role_name']);
        
        $sql = "UPDATE roles SET role_name='$role_name' WHERE role_id=$role_id";
        
        if (mysqli_query($link, $sql)) {
            header("Location: roles_index.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }
    
    $result = mysqli_query($link, "SELECT * FROM roles WHERE role_id=$role_id");
    $row = mysqli_fetch_assoc($result);
    
    if (!$row) {
        echo "Role not found. <a href='roles_index.php'>Back</a>";
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Role</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Update Role</h2>
        <form method="POST">
            <div class="form-group">
                <label>Role Name</label>
                <input type="text" name="role_name" value="<?= $row['role_name'] ?>" required>
            </div>
            <button type="submit">Update Role</button>
        </form>
        <a href="roles_index.php" class="back-link">Back to Roles</a>
    </div>
</body>
</html>
<?php } ?>
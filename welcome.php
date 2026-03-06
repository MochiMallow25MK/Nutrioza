<?php
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'User';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="table.css">
</head>
<body style="padding: 20px; text-align: center;">
    <h1 style="color: #31694E;">Welcome to Nutrioza</h1>
    <p style="color: #658C58; font-size: 18px;">You are logged in as: <strong><?php echo $role; ?></strong></p>
    <p style="color: #626F47;">Please select a task from the sidebar to begin working.</p>
</body>
</html>
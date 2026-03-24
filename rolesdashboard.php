<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrioza - Roles Dashboard</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Vidaloka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="rolesdashboard.css">
</head>
<body>
    <div class="container">
    
        <h1 class="main-title">Roles Dashboard 🌾</h1>

        
        <nav class="navbar">
            <a href="homepage.php" class="nav-link">Home</a>
            <a href="about.php" class="nav-link">About Us</a>
            <a href="contact.php" class="nav-link">Contact Us</a>
        </nav>

        
        <div class="cards-container">
            <div class="role-card" onclick="location.href='login.php?role=Admin'">
                <h3>Admin</h3>
            </div>
            <div class="role-card" onclick="location.href='login.php?role=Manager'">
                <h3>Manager</h3>
            </div>
            <div class="role-card" onclick="location.href='login.php?role=Viewer'">
                <h3>Viewer</h3>
            </div>
            <div class="role-card" onclick="location.href='login.php?role=Warehouse Staff'">
                <h3>Warehouse Staff</h3>
            </div>
            <div class="role-card" onclick="location.href='login.php?role=Supplier'">
                <h3>Supplier</h3>
            </div>
            <div class="role-card" onclick="location.href='login.php?role=Public User'">
                <h3>Public User</h3>
            </div>
        </div>
    </div>
</body>
</html>
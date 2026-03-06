<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrioza - Roles Dashboard</title>

    <!-- Vidaloka font -->
    <link href="https://fonts.googleapis.com/css2?family=Vidaloka&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="rolesdashboard.css">
</head>
<body>
    <div class="container">
        <!-- Main title -->
        <h1 class="main-title">Roles Dashboard🌾</h1>

        <!-- Navbar -->
        <nav class="navbar">
            <a href="homepage.php" class="nav-link">Home</a>
            <a href="about.php" class="nav-link">About Us</a>
            <a href="contact.php" class="nav-link">Contact Us</a>
        </nav>

        <!-- Cards -->
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
            <div class="role-card" onclick="location.href='login.php?role=Guest'">
                <h3>Guest (User)</h3>
            </div>
        </div>
    </div>
</body>
</html>
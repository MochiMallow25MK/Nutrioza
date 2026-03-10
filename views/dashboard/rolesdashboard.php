<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrioza - Roles Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Vidaloka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/SEProject/Nutrioza/Nutrioza/public/css/rolesdashboard.css">
</head>
<body>
    <div class="container">
        <h1 class="main-title">Roles Dashboard🌾</h1>
        <nav class="navbar">
            <a href="/SEProject/Nutrioza/Nutrioza/views\pages\homepage.php?page=home">Home</a>
            <a href="/SEProject/Nutrioza/Nutrioza/views\pages\about.php?page=about">About Us</a>
            <a href="/SEProject/Nutrioza/Nutrioza/views\pages\contact.php?page=contact">Contact Us</a>
        </nav>
        <div class="cards-container">
            <div class="role-card" onclick="location.href='/SEProject/Nutrioza/Nutrioza/public/index.php?page=login&role=Admin'">
                <h3>Admin</h3>
            </div>
            <div class="role-card" onclick="location.href='/SEProject/Nutrioza/Nutrioza/public/index.php?page=login&role=Manager'">
                <h3>Manager</h3>
            </div>
            <div class="role-card" onclick="location.href='/SEProject/Nutrioza/Nutrioza/public/index.php?page=login&role=Viewer'">
                <h3>Viewer</h3>
            </div>
            <div class="role-card" onclick="location.href='/SEProject/Nutrioza/Nutrioza/public/index.php?page=login&role=Warehouse Staff'">
                <h3>Warehouse Staff</h3>
            </div>
            <div class="role-card" onclick="location.href='/SEProject/Nutrioza/Nutrioza/public/index.php?page=login&role=Supplier'">
                <h3>Supplier</h3>
            </div>
            <div class="role-card" onclick="location.href='/SEProject/Nutrioza/Nutrioza/public/index.php?page=login&role=Public User'">
                <h3>Public User</h3>
            </div>
        </div>
    </div>
</body>
</html>
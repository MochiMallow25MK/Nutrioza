<?php
session_start();
require_once 'config/app.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrioza - Food Distribution Management</title>
    <link rel="stylesheet" href="/nutrioza/assets/css/app.css">
    <link rel="stylesheet" href="/nutrioza/assets/css/public.css">
</head>
<body>
    <nav class="navbar">
        <a href="/nutrioza/index.php" class="navbar-brand">Nutrioza</a>
        <ul class="navbar-menu">
            <li><a href="/nutrioza/index.php">Home</a></li>
            <li><a href="/nutrioza/about.php">About</a></li>
            <li><a href="/nutrioza/contact.php">Contact</a></li>
            <li><a href="/nutrioza/donate.php">Donate</a></li>
            <li><a href="/nutrioza/volunteer.php">Volunteer</a></li>
            <?php if(isset($_SESSION['user_id'])): ?>
                <li><a href="/nutrioza/dashboard.php">Dashboard</a></li>
                <li><a href="/nutrioza/logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="/nutrioza/login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    
    <div class="public-header" style="background: linear-gradient(135deg, #31694E 0%, #84B179 100%);">
        <h1 style="color: #FFCF50;">Welcome to Nutrioza</h1>
        <p>Connecting food surplus with community needs</p>
        <div style="margin-top: 30px;">
            <a href="/nutrioza/donate.php" class="btn btn-warning" style="margin-right: 15px;">Donate Now</a>
            <a href="/nutrioza/volunteer.php" class="btn btn-primary">Become a Volunteer</a>
        </div>
    </div>
    
    <div class="container" style="padding: 50px 20px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-bottom: 50px;">
            <div class="feature-box">
                <h3>Food Donations</h3>
                <p>Donate surplus food to help those in need</p>
                <a href="/nutrioza/donate.php" class="btn btn-success" style="margin-top: 15px;">Donate Food</a>
            </div>
            
            <div class="feature-box">
                <h3>Monetary Support</h3>
                <p>Financial contributions help us operate efficiently</p>
                <a href="/nutrioza/donate.php" class="btn btn-primary" style="margin-top: 15px;">Give Money</a>
            </div>
            
            <div class="feature-box">
                <h3>Volunteer</h3>
                <p>Join our team and make a difference</p>
                <a href="/nutrioza/volunteer.php" class="btn btn-warning" style="margin-top: 15px;">Sign Up</a>
            </div>
        </div>
        
        <div style="background: linear-gradient(135deg, #C7EABB 0%, #F0E491 100%); padding: 40px; border-radius: 15px; text-align: center;">
            <h2 style="color: #31694E; margin-bottom: 20px;">Our Impact</h2>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                <div>
                    <h3 style="color: #626F47; font-size: 2rem;">5000+</h3>
                    <p>People Fed</p>
                </div>
                <div>
                    <h3 style="color: #626F47; font-size: 2rem;">10000+</h3>
                    <p>KG Food Distributed</p>
                </div>
                <div>
                    <h3 style="color: #626F47; font-size: 2rem;">50+</h3>
                    <p>Partner Organizations</p>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="footer">
        <p>&copy; 2024 Nutrioza. All rights reserved.</p>
    </footer>
</body>
</html>
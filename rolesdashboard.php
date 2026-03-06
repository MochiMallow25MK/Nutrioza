<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Roles Dashboard - Nutrioza</title>
    <link rel="stylesheet" href="rolesdashboard.css">
</head>
<body>
    <h1 class="dashboard-title">Nutrioza Roles Dashboard</h1>
    
    <div class="cards-container">
        <div class="role-card" onclick="location.href='login.php?role=Admin'">
            <h3>Admin</h3>
            <p>Full system access and user management</p>
        </div>
        
        <div class="role-card" onclick="location.href='login.php?role=Manager'">
            <h3>Manager</h3>
            <p>Manage food items and categories</p>
        </div>
        
        <div class="role-card" onclick="location.href='login.php?role=Warehouse Staff'">
            <h3>Warehouse Staff</h3>
            <p>Manage distributions and recipients</p>
        </div>
        
        <div class="role-card" onclick="location.href='login.php?role=Supplier'">
            <h3>Supplier</h3>
            <p>Manage supplier information and purchase orders</p>
        </div>
        
        <div class="role-card" onclick="location.href='login.php?role=Viewer'">
            <h3>Viewer</h3>
            <p>Generate and view reports</p>
        </div>
        
        <div class="role-card" onclick="location.href='login.php?role=Public User'">
            <h3>Public User</h3>
            <p>Submit donation and volunteer forms</p>
        </div>
    </div>
</body>
</html>
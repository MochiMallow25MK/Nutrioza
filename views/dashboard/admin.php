<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Nutrioza</title>
    <link rel="stylesheet" href="/nutrioza/assets/css/app.css">
    <link rel="stylesheet" href="/nutrioza/assets/css/dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="sidebar-header">
                <h3>Nutrioza</h3>
                <p>Admin Panel</p>
            </div>
            
            <ul class="sidebar-menu">
                <li><a href="/nutrioza/dashboard.php"><i>📊</i> Dashboard</a></li>
                <li><a href="/nutrioza/users.php"><i>👥</i> Users</a></li>
                <li><a href="/nutrioza/inventory.php"><i>📦</i> Inventory</a></li>
                <li><a href="/nutrioza/suppliers.php"><i>🏢</i> Suppliers</a></li>
                <li><a href="/nutrioza/distributions.php"><i>🚚</i> Distributions</a></li>
                <li><a href="/nutrioza/donations.php"><i>💰</i> Donations</a></li>
                <li><a href="/nutrioza/volunteers.php"><i>🤝</i> Volunteers</a></li>
                <li><a href="/nutrioza/reports.php"><i>📈</i> Reports</a></li>
                <li><a href="/nutrioza/logout.php"><i>🚪</i> Logout</a></li>
            </ul>
        </div>
        
        <div class="main-content">
            <div class="top-bar">
                <h2>Welcome, <?php echo $_SESSION['user_name']; ?></h2>
                <div class="user-info">
                    <span>Admin</span>
                    <div class="user-avatar">A</div>
                </div>
            </div>
            
            <div class="dashboard-stats">
                <div class="stat-card" style="background: #84B179;">
                    <h3><?php echo $stats['total_items']; ?></h3>
                    <p>Total Items</p>
                </div>
                
                <div class="stat-card" style="background: #FFCF50;">
                    <h3><?php echo $stats['low_stock']; ?></h3>
                    <p>Low Stock Items</p>
                </div>
                
                <div class="stat-card" style="background: #BBC863;">
                    <h3><?php echo $stats['near_expiry']; ?></h3>
                    <p>Near Expiry</p>
                </div>
                
                <div class="stat-card" style="background: #A2CB8B;">
                    <h3><?php echo $stats['pending_distributions']; ?></h3>
                    <p>Pending Distributions</p>
                </div>
            </div>
            
            <div class="dashboard-stats">
                <div class="stat-card" style="background: #31694E;">
                    <h3><?php echo $stats['pending_donations']; ?></h3>
                    <p>Pending Donations</p>
                </div>
                
                <div class="stat-card" style="background: #626F47;">
                    <h3><?php echo $stats['pending_volunteers']; ?></h3>
                    <p>Pending Volunteers</p>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3>Quick Actions</h3>
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                    <a href="/nutrioza/users/create.php" class="btn btn-primary">Add User</a>
                    <a href="/nutrioza/inventory/create.php" class="btn btn-success">Add Food Item</a>
                    <a href="/nutrioza/donations.php" class="btn btn-warning">Review Donations</a>
                    <a href="/nutrioza/volunteers.php" class="btn btn-primary">Review Volunteers</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
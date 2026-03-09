<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: /Nutrioza/public/index.php?page=roles-dashboard");
    exit();
}
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Workspace - <?php echo $role; ?></title>
    <link rel="stylesheet" href="/Nutrioza/public/css/workspace.css">
</head>
<body>
    <div class="workspace-container">
        <div class="sidebar">
            <h2><?php echo $role; ?> Workspace</h2>
            <ul class="tasks-list">
                <?php if ($role == 'Admin'): ?>
                    <li><a href="/Nutrioza/app/controllers/roles_index.php" target="workarea">Manage Roles</a></li>
                    <li><a href="/Nutrioza/app/controllers/users_index.php" target="workarea">Manage Users</a></li>
                    <li><a href="/Nutrioza/app/controllers/donations_index.php" target="workarea">Manage Donations</a></li>
                    <li><a href="/Nutrioza/app/controllers/volunteers_index.php" target="workarea">Manage Volunteers</a></li>
                <?php elseif ($role == 'Manager'): ?>
                    <li><a href="/Nutrioza/app/controllers/food_items_index.php" target="workarea">Manage Food Items</a></li>
                    <li><a href="/Nutrioza/app/controllers/categories_index.php" target="workarea">Manage Categories</a></li>
                <?php elseif ($role == 'Supplier'): ?>
                    <li><a href="/Nutrioza/app/controllers/suppliers_index.php" target="workarea">Manage Suppliers</a></li>
                <?php elseif ($role == 'Warehouse Staff'): ?>
                    <li><a href="/Nutrioza/app/controllers/distributions_index.php" target="workarea">Manage Distributions</a></li>
                    <li><a href="/Nutrioza/app/controllers/distribution_details_index.php" target="workarea">Manage Distribution Details</a></li>
                    <li><a href="/Nutrioza/app/controllers/recipients_index.php" target="workarea">Manage Recipients</a></li>
                <?php elseif ($role == 'Viewer'): ?>
                    <li><a href="/Nutrioza/app/views/reports/stock_report.php" target="workarea">Stock Report</a></li>
                    <li><a href="/Nutrioza/app/views/reports/distribution_report.php" target="workarea">Distribution History Report</a></li>
                <?php elseif ($role == 'Public User'): ?>
                    <li><a href="/Nutrioza/public/index.php?page=donation-form" target="workarea">Submit Donation Form</a></li>
                    <li><a href="/Nutrioza/public/index.php?page=volunteer-form" target="workarea">Submit Volunteering Form</a></li>
                <?php endif; ?>
            </ul>
            <a href="/Nutrioza/public/index.php?page=logout" class="logout-btn">Logout</a>
        </div>
        <div class="main-content">
            <iframe name="workarea" src="/Nutrioza/public/index.php?page=welcome"></iframe>
        </div>
    </div>
</body>
</html>
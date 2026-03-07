<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: rolesdashboard.php");
    exit();
}
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Workspace - <?php echo $role; ?></title>
    <link rel="stylesheet" href="workspace.css">
</head>
<body>
    <div class="workspace-container">
        <div class="sidebar">
            <h2><?php echo $role; ?> Workspace</h2>
            <ul class="tasks-list">
                <?php if ($role == 'Admin'): ?>
                    <li><a href="roles_index.php" target="workarea">Manage Roles</a></li>
                    <li><a href="users_index.php" target="workarea">Manage Users</a></li>
                    <li><a href="donations_index.php" target="workarea">Manage Donations</a></li>
                    <li><a href="volunteers_index.php" target="workarea">Manage Volunteers</a></li>
                <?php elseif ($role == 'Manager'): ?>
                    <li><a href="food_items_index.php" target="workarea">Manage Food Items</a></li>
                    <li><a href="categories_index.php" target="workarea">Manage Categories</a></li>
                <?php elseif ($role == 'Supplier'): ?>
                    <li><a href="suppliers_index.php" target="workarea">Manage Suppliers</a></li>
                <?php elseif ($role == 'Warehouse Staff'): ?>
                    <li><a href="distributions_index.php" target="workarea">Manage Distributions</a></li>
                    <li><a href="distribution_details_index.php" target="workarea">Manage Distribution Details</a></li>
                    <li><a href="recipients_index.php" target="workarea">Manage Recipients</a></li>
                <?php elseif ($role == 'Viewer'): ?>
                    <li><a href="stock_report.php" target="workarea">Stock Report</a></li>
                    <li><a href="distribution_report.php" target="workarea">Distribution History Report</a></li>
                <?php elseif ($role == 'Public User'): ?>
                    <li><a href="donationform.php" target="workarea">Submit Donation Form</a></li>
                    <li><a href="volunteeringform.php" target="workarea">Submit Volunteering Form</a></li>
                <?php endif; ?>
            </ul>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
        <div class="main-content">
            <iframe name="workarea" src="welcome.php"></iframe>
        </div>
    </div>
</body>
</html>
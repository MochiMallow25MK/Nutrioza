<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location:/SEProject/Nutrioza/Nutrioza/views/auth/login.php");
    exit();
} 
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Workspace - <?php echo $role; ?></title>
    <link rel="stylesheet" href="/SEProject/Nutrioza/Nutrioza/public/css/workspace.css">
</head>
<body>
    <div class="workspace-container">
        <div class="sidebar">
            <h2><?php echo $role; ?> Workspace</h2>
            <ul class="tasks-list">
                <?php if ($role == 'Admin'): ?>
                    <li><a href="/SEProject/Nutrioza/Nutrioza/app/controllers/RolesController.php" target="workarea">Manage Roles</a></li>
                    <li><a href="/SEProject/Nutrioza/Nutrioza/app/controllers/UsersController.php" target="workarea">Manage Users</a></li>
                    <li><a href="/SEProject/Nutrioza/Nutrioza/app/controllers/DonationsController.php" target="workarea">Manage Donations</a></li>
                    <li><a href="/SEProject/Nutrioza/Nutrioza/app/controllers/VolunteersController.php" target="workarea">Manage Volunteers</a></li>
                <?php elseif ($role == 'Manager'): ?>
                    <li><a href="/SEProject/Nutrioza/Nutrioza/app/controllers/FoodItemsController.php" target="workarea">Manage Food Items</a></li>
                    <li><a href="/SEProject/Nutrioza/Nutrioza/app/controllers/CategoriesController.php" target="workarea">Manage Categories</a></li>
                <?php elseif ($role == 'Supplier'): ?>
                    <li><a href="/SEProject/Nutrioza/Nutrioza/app/controllers/SuppliersController.php" target="workarea">Manage Suppliers</a></li>
                <?php elseif ($role == 'Warehouse Staff'): ?>
                    <li><a href="/SEProject/Nutrioza/Nutrioza/app/controllers/DistributionsController.php" target="workarea">Manage Distributions</a></li>
                    <li><a href="/SEProject/Nutrioza/Nutrioza/app/controllers/DistributionDetailsController.php" target="workarea">Manage Distribution Details</a></li>
                    <li><a href="/SEProject/Nutrioza/Nutrioza/app/controllers/RecipientsController.php" target="workarea">Manage Recipients</a></li>
                <?php elseif ($role == 'Viewer'): ?>
                    <li><a href="/SEProject/Nutrioza/Nutrioza/app/views/reports/stock_report.php" target="workarea">Stock Report</a></li>
                    <li><a href="/SEProject/Nutrioza/Nutrioza/app/views/reports/distribution_report.php" target="workarea">Distribution History Report</a></li>
                <?php elseif ($role == 'Public User'): ?>
                    <li><a href="/SEProject/Nutrioza/Nutrioza/views/forms/donationform.php?page=donation-form" target="workarea">Submit Donation Form</a></li>
                    <li><a href="/SEProject/Nutrioza/Nutrioza/views/forms/volunteerform.php?page=volunteer-form" target="workarea">Submit Volunteering Form</a></li>
                <?php endif; ?>
            </ul>
            <a href="/SEProject/Nutrioza/Nutrioza/views\pages\homepage.php?page=logout" class="logout-btn">Logout</a>
        </div>
        <div class="main-content">
            <iframe name="workarea" src="/SEProject/Nutrioza/Nutrioza/public/index.php?page=welcome"></iframe>
        </div>
    </div>
</body>
</html> 
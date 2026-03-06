<?php
session_start();
require 'config.php';

$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-01', strtotime('-3 months'));
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');

$sql = "SELECT s.*, 
        COUNT(DISTINCT f.item_id) as total_items,
        SUM(f.quantity) as total_quantity,
        MAX(f.expiry_date) as latest_expiry,
        MIN(f.expiry_date) as earliest_expiry
        FROM suppliers s 
        LEFT JOIN food_items f ON s.supplier_id = f.supplier_id 
        WHERE f.created_at BETWEEN '$start_date' AND '$end_date' OR f.created_at IS NULL
        GROUP BY s.supplier_id";

$result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Supplier Performance Report</title>
    <link rel="stylesheet" href="table.css">
    <style>
        .report-header { background-color: #31694E; color: #FEFAE0; padding: 20px; margin-bottom: 20px; }
        .filter-form { background-color: #C7EABB; padding: 20px; margin-bottom: 20px; border-radius: 5px; }
        .print-btn { background-color: #FFCF50; color: #31694E; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin-top: 20px; }
        .rating { font-weight: bold; }
        .rating-high { color: #31694E; }
        .rating-medium { color: #FFCF50; }
        .rating-low { color: #ff4444; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
    <div class="report-header no-print">
        <h1>Supplier Performance Report</h1>
        <p>Generated on: <?= date('Y-m-d H:i:s') ?></p>
    </div>
    
    <div class="filter-form no-print">
        <form method="GET">
            <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                <div class="form-group">
                    <label>Start Date:</label>
                    <input type="date" name="start_date" value="<?= $start_date ?>">
                </div>
                <div class="form-group">
                    <label>End Date:</label>
                    <input type="date" name="end_date" value="<?= $end_date ?>">
                </div>
                <div>
                    <button type="submit">Generate Report</button>
                </div>
            </div>
        </form>
    </div>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Supplier Name</th>
            <th>Contact Info</th>
            <th>Total Items Supplied</th>
            <th>Total Quantity</th>
            <th>Earliest Expiry</th>
            <th>Latest Expiry</th>
            <th>Performance</th>
        </tr>
        
        <?php 
        while ($row = mysqli_fetch_assoc($result)) { 
            $rating = 'Average';
            $rating_class = 'rating-medium';
            
            if ($row['total_items'] > 10) {
                $rating = 'High Volume';
                $rating_class = 'rating-high';
            } elseif ($row['total_items'] < 3) {
                $rating = 'Low Volume';
                $rating_class = 'rating-low';
            }
            
            $expiry_score = 'Good';
            if ($row['earliest_expiry'] && strtotime($row['earliest_expiry']) < time() + 30 * 24 * 60 * 60) {
                $expiry_score = 'Short shelf life';
            }
        ?>
        <tr>
            <td><?= $row['supplier_id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['contact_info'] ?></td>
            <td><?= $row['total_items'] ?? 0 ?></td>
            <td><?= $row['total_quantity'] ?? 0 ?></td>
            <td><?= $row['earliest_expiry'] ?? 'N/A' ?></td>
            <td><?= $row['latest_expiry'] ?? 'N/A' ?></td>
            <td class="rating <?= $rating_class ?>"><?= $rating ?></td>
        </tr>
        <?php } ?>
    </table>
    
    <div class="no-print" style="margin-top: 20px;">
        <button onclick="window.print()" class="print-btn">Print Report</button>
        <a href="workspace.php" class="back-link" style="margin-left: 20px;">Back to Workspace</a>
    </div>
</body>
</html>
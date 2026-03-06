<?php
session_start();
require 'config.php';

$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-01');
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');
$status = isset($_GET['status']) ? $_GET['status'] : '';

$sql = "SELECT d.*, r.name as recipient_name, r.type, u.name as approver_name 
        FROM distributions d 
        JOIN recipients r ON d.recipient_id = r.recipient_id 
        LEFT JOIN users u ON d.approved_by = u.user_id 
        WHERE d.distribution_date BETWEEN '$start_date' AND '$end_date'";

if ($status) {
    $sql .= " AND d.status = '$status'";
}

$sql .= " ORDER BY d.distribution_date DESC";

$result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Distribution Report</title>
    <link rel="stylesheet" href="table.css">
    <style>
        .report-header { background-color: #31694E; color: #FEFAE0; padding: 20px; margin-bottom: 20px; }
        .filter-form { background-color: #C7EABB; padding: 20px; margin-bottom: 20px; border-radius: 5px; }
        .print-btn { background-color: #FFCF50; color: #31694E; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin-top: 20px; }
        .summary-box { background-color: #84B179; color: #FEFAE0; padding: 15px; margin-bottom: 20px; border-radius: 5px; display: inline-block; margin-right: 10px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
    <div class="report-header no-print">
        <h1>Distribution History Report</h1>
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
                <div class="form-group">
                    <label>Status:</label>
                    <select name="status">
                        <option value="">All Status</option>
                        <option value="Pending" <?= $status == 'Pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="Approved" <?= $status == 'Approved' ? 'selected' : '' ?>>Approved</option>
                        <option value="Delivered" <?= $status == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                    </select>
                </div>
                <div>
                    <button type="submit">Generate Report</button>
                </div>
            </div>
        </form>
    </div>
    
    <?php
    $total_distributions = mysqli_num_rows($result);
    $total_items = 0;
    $pending_count = 0;
    $delivered_count = 0;
    
    mysqli_data_seek($result, 0);
    while ($row = mysqli_fetch_assoc($result)) {
        $details = mysqli_query($link, "SELECT SUM(quantity) as total FROM distribution_details WHERE distribution_id={$row['distribution_id']}");
        $detail = mysqli_fetch_assoc($details);
        $total_items += $detail['total'];
        
        if ($row['status'] == 'Pending') $pending_count++;
        if ($row['status'] == 'Delivered') $delivered_count++;
    }
    mysqli_data_seek($result, 0);
    ?>
    
    <div class="no-print">
        <div class="summary-box">Total Distributions: <?= $total_distributions ?></div>
        <div class="summary-box">Total Items Distributed: <?= $total_items ?></div>
        <div class="summary-box">Pending: <?= $pending_count ?></div>
        <div class="summary-box">Delivered: <?= $delivered_count ?></div>
    </div>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Recipient</th>
            <th>Type</th>
            <th>Status</th>
            <th>Approved By</th>
        </tr>
        
        <?php while ($row = mysqli_fetch_assoc($result)) { 
            $details = mysqli_query($link, "SELECT dd.*, f.name FROM distribution_details dd JOIN food_items f ON dd.item_id = f.item_id WHERE dd.distribution_id={$row['distribution_id']}");
        ?>
        <tr>
            <td><?= $row['distribution_id'] ?></td>
            <td><?= $row['distribution_date'] ?></td>
            <td><?= $row['recipient_name'] ?></td>
            <td><?= $row['type'] ?></td>
            <td><?= $row['status'] ?></td>
            <td><?= $row['approver_name'] ?? 'Not approved' ?></td>
        </tr>
        <tr style="background-color: #E8F5BD;">
            <td colspan="6">
                <strong>Items:</strong> 
                <?php 
                $items_list = [];
                while($item = mysqli_fetch_assoc($details)) {
                    $items_list[] = $item['name'] . " (" . $item['quantity'] . ")";
                }
                echo implode(', ', $items_list);
                ?>
            </td>
        </tr>
        <?php } ?>
    </table>
    
    <div class="no-print" style="margin-top: 20px;">
        <button onclick="window.print()" class="print-btn">Print Report</button>
        <a href="workspace.php" class="back-link" style="margin-left: 20px;">Back to Workspace</a>
    </div>
</body>
</html>
<?php
session_start();
require 'config.php';

$category_filter = isset($_GET['category']) ? (int)$_GET['category'] : '';
$low_stock = isset($_GET['low_stock']) ? $_GET['low_stock'] : '';

$sql = "SELECT f.*, c.category_name, s.name as supplier_name FROM food_items f 
        JOIN categories c ON f.category_id = c.category_id 
        JOIN suppliers s ON f.supplier_id = s.supplier_id WHERE 1=1";

if ($category_filter) {
    $sql .= " AND f.category_id = $category_filter";
}

if ($low_stock == 'yes') {
    $sql .= " AND f.quantity < 50";
}

$sql .= " ORDER BY f.expiry_date ASC";

$result = mysqli_query($link, $sql);
$categories = mysqli_query($link, "SELECT * FROM categories");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Stock Report</title>
    <link rel="stylesheet" href="table.css">
    <style>
        .report-header { background-color: #31694E; color: #FEFAE0; padding: 20px; margin-bottom: 20px; }
        .filter-form { background-color: #C7EABB; padding: 20px; margin-bottom: 20px; border-radius: 5px; }
        .print-btn { background-color: #FFCF50; color: #31694E; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin-top: 20px; }
        .low-stock { background-color: #FFCF50; font-weight: bold; }
        .expiring-soon { background-color: #ff4444; color: white; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
    <div class="report-header no-print">
        <h1>Stock Report</h1>
        <p>Generated on: <?= date('Y-m-d H:i:s') ?></p>
    </div>
    
    <div class="filter-form no-print">
        <form method="GET">
            <div style="display: flex; gap: 20px; align-items: flex-end;">
                <div class="form-group">
                    <label>Category:</label>
                    <select name="category">
                        <option value="">All Categories</option>
                        <?php while($cat = mysqli_fetch_assoc($categories)) { ?>
                            <option value="<?= $cat['category_id'] ?>" <?= $category_filter == $cat['category_id'] ? 'selected' : '' ?>>
                                <?= $cat['category_name'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="low_stock" value="yes" <?= $low_stock == 'yes' ? 'checked' : '' ?>> Show Low Stock Only
                    </label>
                </div>
                <div>
                    <button type="submit">Apply Filters</button>
                </div>
            </div>
        </form>
    </div>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Item Name</th>
            <th>Category</th>
            <th>Supplier</th>
            <th>Quantity</th>
            <th>Expiry Date</th>
            <th>Status</th>
        </tr>
        
        <?php 
        $total_items = 0;
        $total_quantity = 0;
        while ($row = mysqli_fetch_assoc($result)) { 
            $total_items++;
            $total_quantity += $row['quantity'];
            $row_class = '';
            $status = '';
            
            if ($row['quantity'] < 50) {
                $row_class = 'low-stock';
                $status = 'LOW STOCK';
            }
            
            $days_to_expiry = (strtotime($row['expiry_date']) - time()) / (60 * 60 * 24);
            if ($days_to_expiry < 7) {
                $row_class = 'expiring-soon';
                $status = 'EXPIRING SOON';
            }
        ?>
        <tr class="<?= $row_class ?>">
            <td><?= $row['item_id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['category_name'] ?></td>
            <td><?= $row['supplier_name'] ?></td>
            <td><?= $row['quantity'] ?></td>
            <td><?= $row['expiry_date'] ?></td>
            <td><?= $status ?></td>
        </tr>
        <?php } ?>
        
        <tr style="background-color: #31694E; color: #FEFAE0; font-weight: bold;">
            <td colspan="4">Totals</td>
            <td><?= $total_quantity ?></td>
            <td colspan="2">Total Items: <?= $total_items ?></td>
        </tr>
    </table>
    
    <div class="no-print" style="margin-top: 20px;">
        <button onclick="window.print()" class="print-btn">Print Report</button>
        <a href="workspace.php" class="back-link" style="margin-left: 20px;">Back to Workspace</a>
    </div>
</body>
</html>
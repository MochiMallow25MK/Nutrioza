<?php
session_start();
require 'config.php';

$suppliers = mysqli_query($link, "SELECT * FROM suppliers");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['generate'])) {
    $supplier_id = (int)$_POST['supplier_id'];
    $supplier = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM suppliers WHERE supplier_id=$supplier_id"));
    $items = mysqli_query($link, "SELECT f.*, c.category_name FROM food_items f JOIN categories c ON f.category_id = c.category_id WHERE f.supplier_id=$supplier_id AND f.quantity < 50");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Purchase Orders</title>
    <link rel="stylesheet" href="form.css">
    <style>
        .print-btn { background-color: #FFCF50; color: #31694E; margin-top: 20px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Generate Purchase Order</h2>
        
        <form method="POST" class="no-print">
            <div class="form-group">
                <label>Select Supplier</label>
                <select name="supplier_id" required>
                    <option value="">Choose Supplier</option>
                    <?php while($sup = mysqli_fetch_assoc($suppliers)) { ?>
                        <option value="<?= $sup['supplier_id'] ?>" <?= isset($supplier_id) && $supplier_id == $sup['supplier_id'] ? 'selected' : '' ?>><?= $sup['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" name="generate">Generate Purchase Order</button>
        </form>
        
        <?php if (isset($supplier) && isset($items) && mysqli_num_rows($items) > 0): ?>
            <div style="margin-top: 30px;">
                <h3>PURCHASE ORDER</h3>
                <p><strong>Date:</strong> <?= date('Y-m-d') ?></p>
                <p><strong>Supplier:</strong> <?= $supplier['name'] ?></p>
                <p><strong>Contact:</strong> <?= $supplier['contact_info'] ?></p>
                <p><strong>Address:</strong> <?= $supplier['address'] ?></p>
                
                <table style="width:100%; border-collapse:collapse; margin-top:20px;">
                    <tr style="background-color:#31694E; color:#FEFAE0;">
                        <th style="padding:10px;">Item</th>
                        <th style="padding:10px;">Category</th>
                        <th style="padding:10px;">Current Stock</th>
                        <th style="padding:10px;">Recommended Order</th>
                    </tr>
                    <?php while($item = mysqli_fetch_assoc($items)) { 
                        $order_qty = 100 - $item['quantity'];
                    ?>
                    <tr style="border-bottom:1px solid #A4B465;">
                        <td style="padding:10px;"><?= $item['name'] ?></td>
                        <td style="padding:10px;"><?= $item['category_name'] ?></td>
                        <td style="padding:10px;"><?= $item['quantity'] ?></td>
                        <td style="padding:10px;"><?= $order_qty ?></td>
                    </tr>
                    <?php } ?>
                </table>
                
                <button onclick="window.print()" class="print-btn no-print">Print Purchase Order</button>
            </div>
        <?php elseif (isset($_POST['generate'])): ?>
            <p style="color:#626F47; margin-top:20px;">No items need reordering for this supplier.</p>
        <?php endif; ?>
        
        <a href="workspace.php" class="back-link no-print">Back to Workspace</a>
    </div>
</body>
</html>
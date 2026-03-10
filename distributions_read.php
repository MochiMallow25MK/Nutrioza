<?php
session_start();
require 'config.php';

if (isset($_GET['distribution_id'])) {
    $distribution_id = (int)$_GET['distribution_id'];
    $sql = "SELECT d.*, r.name as recipient_name, r.type, r.contact_info, r.address, u.name as approver_name 
            FROM distributions d 
            JOIN recipients r ON d.recipient_id = r.recipient_id 
            LEFT JOIN users u ON d.approved_by = u.user_id 
            WHERE d.distribution_id = $distribution_id";
    $result = mysqli_query($link, $sql);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $details = mysqli_query($link, "SELECT dd.*, f.name as item_name FROM distribution_details dd JOIN food_items f ON dd.item_id = f.item_id WHERE dd.distribution_id = $distribution_id");
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Distribution</title>
    <link rel="stylesheet" href="form.css">
    <style>
        table { width:100%; border-collapse:collapse; margin:20px 0; }
        th { background-color:#31694E; color:#FEFAE0; padding:10px; }
        td { padding:10px; border-bottom:1px solid #A4B465; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Distribution Details</h2>
        <p><strong>ID:</strong> <?= $row['distribution_id'] ?></p>
        <p><strong>Recipient:</strong> <?= $row['recipient_name'] ?></p>
        <p><strong>Recipient Type:</strong> <?= $row['type'] ?></p>
        <p><strong>Contact:</strong> <?= $row['contact_info'] ?></p>
        <p><strong>Address:</strong> <?= nl2br($row['address']) ?></p>
        <p><strong>Status:</strong> <?= $row['status'] ?></p>
        <p><strong>Distribution Date:</strong> <?= $row['distribution_date'] ?></p>
        <p><strong>Created At:</strong> <?= $row['created_at'] ?></p>
        <?php if ($row['approver_name']): ?>
            <p><strong>Approved By:</strong> <?= $row['approver_name'] ?></p>
        <?php endif; ?>
        
        <h3>Distribution Items</h3>
        <table>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
            </tr>
            <?php while($item = mysqli_fetch_assoc($details)) { ?>
            <tr>
                <td><?= $item['item_name'] ?></td>
                <td><?= $item['quantity'] ?></td>
            </tr>
            <?php } ?>
        </table>
        
        <a href="distributions_index.php" class="back-link">Back to Distributions</a>
    </div>
</body>
</html>
<?php
    } else {
        echo "Distribution not found. <a href='distributions_index.php'>Back</a>";
    }
}
?>
<?php
session_start();
require 'config.php';

if (isset($_GET['donation_id'])) {
    $donation_id = (int)$_GET['donation_id'];
    $sql = "SELECT d.*, u.name as reviewer_name FROM donations d LEFT JOIN users u ON d.reviewed_by = u.user_id WHERE d.donation_id = $donation_id";
    $result = mysqli_query($link, $sql);
    
    if ($row = mysqli_fetch_assoc($result)) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Donation</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Donation Details</h2>
        <p><strong>ID:</strong> <?= $row['donation_id'] ?></p>
        <p><strong>Donor Name:</strong> <?= $row['donor_name'] ?></p>
        <p><strong>Donor Email:</strong> <?= $row['donor_email'] ?></p>
        <p><strong>Donor Phone:</strong> <?= $row['donor_phone'] ?></p>
        <p><strong>Donation Type:</strong> <?= $row['donation_type'] ?></p>
        <p><strong>Description:</strong> <?= $row['description'] ?></p>
        <?php if ($row['donation_type'] == 'Food'): ?>
            <p><strong>Quantity:</strong> <?= $row['quantity'] ?></p>
        <?php else: ?>
            <p><strong>Amount:</strong> $<?= $row['amount'] ?></p>
        <?php endif; ?>
        <p><strong>Status:</strong> <?= $row['status'] ?></p>
        <p><strong>Submitted At:</strong> <?= $row['submitted_at'] ?></p>
        <?php if ($row['reviewer_name']): ?>
            <p><strong>Reviewed By:</strong> <?= $row['reviewer_name'] ?></p>
        <?php endif; ?>
        <a href="donations_index.php" class="back-link">Back to Donations</a>
    </div>
</body>
</html>
<?php
    } else {
        echo "Donation not found. <a href='donations_index.php'>Back</a>";
    }
}
?>
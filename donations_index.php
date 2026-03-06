<?php
session_start();
require 'config.php';
$result = mysqli_query($link, "SELECT d.*, u.name as reviewer_name FROM donations d LEFT JOIN users u ON d.reviewed_by = u.user_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Donations Management</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <h2>Donations Management</h2>
    <a class="add-btn" href="donations_create.php">Add New Donation</a>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Donor Name</th>
            <th>Email</th>
            <th>Type</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['donation_id'] ?></td>
            <td><?= $row['donor_name'] ?></td>
            <td><?= $row['donor_email'] ?></td>
            <td><?= $row['donation_type'] ?></td>
            <td><?= $row['status'] ?></td>
            <td class="actions">
                <a class="btn view" href="donations_read.php?donation_id=<?= $row['donation_id'] ?>">View</a>
                <a class="btn edit" href="donations_update.php?donation_id=<?= $row['donation_id'] ?>">Edit</a>
                <a class="btn delete" href="donations_delete.php?donation_id=<?= $row['donation_id'] ?>" 
                   onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
<?php
session_start();
require 'config.php';

if (isset($_GET['volunteer_id'])) {
    $volunteer_id = (int)$_GET['volunteer_id'];
    $sql = "SELECT v.*, u.name as reviewer_name FROM volunteers v LEFT JOIN users u ON v.reviewed_by = u.user_id WHERE v.volunteer_id = $volunteer_id";
    $result = mysqli_query($link, $sql);
    
    if ($row = mysqli_fetch_assoc($result)) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Volunteer</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Volunteer Details</h2>
        <p><strong>ID:</strong> <?= $row['volunteer_id'] ?></p>
        <p><strong>Full Name:</strong> <?= $row['full_name'] ?></p>
        <p><strong>Email:</strong> <?= $row['email'] ?></p>
        <p><strong>Phone:</strong> <?= $row['phone'] ?></p>
        <p><strong>Availability:</strong> <?= $row['availability'] ?></p>
        <p><strong>Skills:</strong> <?= $row['skills'] ?></p>
        <p><strong>Status:</strong> <?= $row['status'] ?></p>
        <p><strong>Applied At:</strong> <?= $row['applied_at'] ?></p>
        <?php if ($row['reviewer_name']): ?>
            <p><strong>Reviewed By:</strong> <?= $row['reviewer_name'] ?></p>
        <?php endif; ?>
        <a href="volunteers_index.php" class="back-link">Back to Volunteers</a>
    </div>
</body>
</html>
<?php
    } else {
        echo "Volunteer not found. <a href='volunteers_index.php'>Back</a>";
    }
}
?>
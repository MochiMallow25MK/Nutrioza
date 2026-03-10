<?php
session_start();
require 'config.php';

if (isset($_GET['recipient_id'])) {
    $recipient_id = (int)$_GET['recipient_id'];
    $sql = "SELECT * FROM recipients WHERE recipient_id = $recipient_id";
    $result = mysqli_query($link, $sql);
    
    if ($row = mysqli_fetch_assoc($result)) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Recipient</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Recipient Details</h2>
        <p><strong>ID:</strong> <?= $row['recipient_id'] ?></p>
        <p><strong>Name:</strong> <?= $row['name'] ?></p>
        <p><strong>Type:</strong> <?= $row['type'] ?></p>
        <p><strong>Contact Info:</strong> <?= $row['contact_info'] ?></p>
        <p><strong>Address:</strong> <?= nl2br($row['address']) ?></p>
        <a href="recipients_index.php" class="back-link">Back to Recipients</a>
    </div>
</body>
</html>
<?php
    } else {
        echo "Recipient not found. <a href='recipients_index.php'>Back</a>";
    }
}
?>
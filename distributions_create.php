<?php
session_start();
require 'config.php';

$recipients = mysqli_query($link, "SELECT * FROM recipients");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipient_id = (int)$_POST['recipient_id'];
    $distribution_date = mysqli_real_escape_string($link, $_POST['distribution_date']);
    
    $sql = "INSERT INTO distributions (recipient_id, distribution_date, status) VALUES ($recipient_id, '$distribution_date', 'Pending')";
    
    if (mysqli_query($link, $sql)) {
        $distribution_id = mysqli_insert_id($link);
        header("Location: distribution_details_create.php?distribution_id=$distribution_id");
        exit();
    } else {
        echo "Error: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Distribution</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Create New Distribution</h2>
        <form method="POST">
            <div class="form-group">
                <label>Recipient</label>
                <select name="recipient_id" required>
                    <option value="">Select Recipient</option>
                    <?php while($rec = mysqli_fetch_assoc($recipients)) { ?>
                        <option value="<?= $rec['recipient_id'] ?>"><?= $rec['name'] ?> (<?= $rec['type'] ?>)</option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Distribution Date</label>
                <input type="date" name="distribution_date" required>
            </div>
            <button type="submit">Create Distribution</button>
        </form>
        <a href="distributions_index.php" class="back-link">Back to Distributions</a>
    </div>
</body>
</html>
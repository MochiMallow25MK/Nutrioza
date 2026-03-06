<?php
session_start();
require 'config.php';

if (isset($_GET['recipient_id'])) {
    $recipient_id = (int)$_GET['recipient_id'];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = mysqli_real_escape_string($link, $_POST['name']);
        $type = mysqli_real_escape_string($link, $_POST['type']);
        $contact_info = mysqli_real_escape_string($link, $_POST['contact_info']);
        $address = mysqli_real_escape_string($link, $_POST['address']);
        
        $sql = "UPDATE recipients SET name='$name', type='$type', contact_info='$contact_info', address='$address' WHERE recipient_id=$recipient_id";
        
        if (mysqli_query($link, $sql)) {
            header("Location: recipients_index.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }
    
    $result = mysqli_query($link, "SELECT * FROM recipients WHERE recipient_id=$recipient_id");
    $row = mysqli_fetch_assoc($result);
    
    if (!$row) {
        echo "Recipient not found. <a href='recipients_index.php'>Back</a>";
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Recipient</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Update Recipient</h2>
        <form method="POST">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?= $row['name'] ?>" required>
            </div>
            <div class="form-group">
                <label>Type</label>
                <select name="type" required>
                    <option value="NGO" <?= $row['type'] == 'NGO' ? 'selected' : '' ?>>NGO</option>
                    <option value="Kitchen" <?= $row['type'] == 'Kitchen' ? 'selected' : '' ?>>Kitchen</option>
                    <option value="Store" <?= $row['type'] == 'Store' ? 'selected' : '' ?>>Store</option>
                    <option value="Other" <?= $row['type'] == 'Other' ? 'selected' : '' ?>>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label>Contact Information</label>
                <input type="text" name="contact_info" value="<?= $row['contact_info'] ?>">
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea name="address" rows="3"><?= $row['address'] ?></textarea>
            </div>
            <button type="submit">Update Recipient</button>
        </form>
        <a href="recipients_index.php" class="back-link">Back to Recipients</a>
    </div>
</body>
</html>
<?php } ?>
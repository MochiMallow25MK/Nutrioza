<?php
session_start();
require 'config.php';

if (isset($_GET['donation_id'])) {
    $donation_id = (int)$_GET['donation_id'];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $donor_name = mysqli_real_escape_string($link, $_POST['donor_name']);
        $donor_email = mysqli_real_escape_string($link, $_POST['donor_email']);
        $donor_phone = mysqli_real_escape_string($link, $_POST['donor_phone']);
        $donation_type = mysqli_real_escape_string($link, $_POST['donation_type']);
        $description = mysqli_real_escape_string($link, $_POST['description']);
        $status = mysqli_real_escape_string($link, $_POST['status']);
        $quantity = $_POST['quantity'] ? (int)$_POST['quantity'] : 'NULL';
        $amount = $_POST['amount'] ? (float)$_POST['amount'] : 'NULL';
        
        $sql = "UPDATE donations SET donor_name='$donor_name', donor_email='$donor_email', donor_phone='$donor_phone', donation_type='$donation_type', description='$description', status='$status', quantity=$quantity, amount=$amount WHERE donation_id=$donation_id";
        
        if (mysqli_query($link, $sql)) {
            header("Location: donations_index.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }
    
    $result = mysqli_query($link, "SELECT * FROM donations WHERE donation_id=$donation_id");
    $row = mysqli_fetch_assoc($result);
    
    if (!$row) {
        echo "Donation not found. <a href='donations_index.php'>Back</a>";
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Donation</title>
    <link rel="stylesheet" href="form.css">
    <script>
    function toggleFields() {
        var type = document.getElementById('donation_type').value;
        document.getElementById('foodFields').style.display = type == 'Food' ? 'block' : 'none';
        document.getElementById('moneyFields').style.display = type == 'Money' ? 'block' : 'none';
    }
    </script>
</head>
<body>
    <div class="form-container">
        <h2>Update Donation</h2>
        <form method="POST">
            <div class="form-group">
                <label>Donor Name</label>
                <input type="text" name="donor_name" value="<?= $row['donor_name'] ?>" required>
            </div>
            <div class="form-group">
                <label>Donor Email</label>
                <input type="email" name="donor_email" value="<?= $row['donor_email'] ?>" required>
            </div>
            <div class="form-group">
                <label>Donor Phone</label>
                <input type="text" name="donor_phone" value="<?= $row['donor_phone'] ?>">
            </div>
            <div class="form-group">
                <label>Donation Type</label>
                <select name="donation_type" id="donation_type" onchange="toggleFields()" required>
                    <option value="Food" <?= $row['donation_type'] == 'Food' ? 'selected' : '' ?>>Food</option>
                    <option value="Money" <?= $row['donation_type'] == 'Money' ? 'selected' : '' ?>>Money</option>
                </select>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="3" required><?= $row['description'] ?></textarea>
            </div>
            <div id="foodFields" style="display:<?= $row['donation_type'] == 'Food' ? 'block' : 'none' ?>;">
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" name="quantity" value="<?= $row['quantity'] ?>">
                </div>
            </div>
            <div id="moneyFields" style="display:<?= $row['donation_type'] == 'Money' ? 'block' : 'none' ?>;">
                <div class="form-group">
                    <label>Amount</label>
                    <input type="number" step="0.01" name="amount" value="<?= $row['amount'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="Pending" <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Approved" <?= $row['status'] == 'Approved' ? 'selected' : '' ?>>Approved</option>
                    <option value="Rejected" <?= $row['status'] == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                </select>
            </div>
            <button type="submit">Update Donation</button>
        </form>
        <a href="donations_index.php" class="back-link">Back to Donations</a>
    </div>
</body>
</html>
<?php } ?>
<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $donor_name = mysqli_real_escape_string($link, $_POST['donor_name']);
    $donor_email = mysqli_real_escape_string($link, $_POST['donor_email']);
    $donor_phone = mysqli_real_escape_string($link, $_POST['donor_phone']);
    $donation_type = mysqli_real_escape_string($link, $_POST['donation_type']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $quantity = $_POST['quantity'] ? (int)$_POST['quantity'] : 'NULL';
    $amount = $_POST['amount'] ? (float)$_POST['amount'] : 'NULL';
    
    $sql = "INSERT INTO donations (donor_name, donor_email, donor_phone, donation_type, description, quantity, amount) 
            VALUES ('$donor_name', '$donor_email', '$donor_phone', '$donation_type', '$description', $quantity, $amount)";
    
    if (mysqli_query($link, $sql)) {
        header("Location: donations_index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Donation</title>
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
        <h2>Add New Donation</h2>
        <form method="POST">
            <div class="form-group">
                <label>Donor Name</label>
                <input type="text" name="donor_name" required>
            </div>
            <div class="form-group">
                <label>Donor Email</label>
                <input type="email" name="donor_email" required>
            </div>
            <div class="form-group">
                <label>Donor Phone</label>
                <input type="text" name="donor_phone">
            </div>
            <div class="form-group">
                <label>Donation Type</label>
                <select name="donation_type" id="donation_type" onchange="toggleFields()" required>
                    <option value="">Select Type</option>
                    <option value="Food">Food</option>
                    <option value="Money">Money</option>
                </select>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="3" required></textarea>
            </div>
            <div id="foodFields" style="display:none;">
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" name="quantity">
                </div>
            </div>
            <div id="moneyFields" style="display:none;">
                <div class="form-group">
                    <label>Amount</label>
                    <input type="number" step="0.01" name="amount">
                </div>
            </div>
            <button type="submit">Add Donation</button>
        </form>
        <a href="donations_index.php" class="back-link">Back to Donations</a>
    </div>
</body>
</html>
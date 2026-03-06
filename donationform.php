<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Donation Form - Nutrioza</title>
    <link rel="stylesheet" href="form.css">
    <script src="form_validation.js"></script>
</head>
<body>
    <div class="form-container">
        <h2>Make a Donation</h2>
        
        <form id="donationForm" onsubmit="return validateDonationForm()" action="submit_donation.php" method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" id="donor_name" name="donor_name">
                <span id="nameError" class="error"></span>
            </div>
            
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" id="donor_email" name="donor_email">
                <span id="emailError" class="error"></span>
            </div>
            
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" id="donor_phone" name="donor_phone">
                <span id="phoneError" class="error"></span>
            </div>
            
            <div class="form-group">
                <label>Donation Type</label>
                <select id="donation_type" name="donation_type">
                    <option value="">Select Type</option>
                    <option value="Food">Food</option>
                    <option value="Money">Money</option>
                </select>
                <span id="typeError" class="error"></span>
            </div>
            
            <div class="form-group">
                <label>Description</label>
                <textarea id="description" name="description" rows="3"></textarea>
                <span id="descError" class="error"></span>
            </div>
            
            <div class="form-group" id="foodQuantity">
                <label>Quantity (for food donations)</label>
                <input type="number" id="quantity" name="quantity">
            </div>
            
            <div class="form-group" id="moneyAmount">
                <label>Amount (for money donations)</label>
                <input type="number" step="0.01" id="amount" name="amount">
            </div>
            
            <button type="submit">Submit Donation</button>
        </form>
        
        <a href="workspace.php" class="back-link">Back to Workspace</a>
    </div>
</body>
</html>
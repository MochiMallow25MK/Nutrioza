<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrioza - Donate</title>
    <link href="https://fonts.googleapis.com/css2?family=Vidaloka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<script>alert('Welcome to the Donations page!');</script>

<nav class="navbar">
    <a href="homepage.php">Home</a>
    <a href="about.php">About Us</a>
    <a href="contact.php">Contact Us</a>
    <a href="volunteering_form.php">Volunteering</a>
    <a href="management.php">Management</a>
</nav>

<div class="container">
    <h1 class="page-title">Make a Donation 🌾</h1>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Form submitted successfully! Thank you for your generous donation.</div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-error">Something went wrong. Please try again.</div>
    <?php endif; ?>

    <div class="card" style="max-width:560px; margin:0 auto;">
        <form method="POST" action="submit_donation.php" id="donationForm" novalidate>

            <div class="form-group">
                <label for="donor_name">Full Name</label>
                <input type="text" id="donor_name" name="donor_name" placeholder="Enter your full name">
                <span class="error-msg" id="nameErr">Full name is required.</span>
            </div>

            <div class="form-group">
                <label for="donor_email">Email</label>
                <input type="email" id="donor_email" name="donor_email" placeholder="Enter your email">
                <span class="error-msg" id="emailErr">Please enter a valid email address.</span>
            </div>

            <div class="form-group">
                <label for="donor_phone_number">Phone Number</label>
                <input type="text" id="donor_phone_number" name="donor_phone_number" placeholder="e.g. +20 123 4567890">
                <span class="error-msg" id="phoneErr">Phone number is required.</span>
            </div>

            <div class="form-group">
                <label for="donation_amount">Donation Amount</label>
                <input type="text" id="donation_amount" name="donation_amount" placeholder="e.g. $100.00">
                <span class="error-msg" id="amountErr">Please enter a valid donation amount (e.g. $50.00).</span>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;">SUBMIT DONATION</button>
        </form>
    </div>
</div>

<script>
document.getElementById('donationForm').addEventListener('submit', function(e) {
    let valid = true;

    document.querySelectorAll('.error-msg').forEach(el => el.style.display = 'none');
    document.querySelectorAll('input').forEach(el => el.classList.remove('error'));

    function fail(inputId, errId) {
        document.getElementById(inputId).classList.add('error');
        document.getElementById(errId).style.display = 'block';
        valid = false;
    }

    const name   = document.getElementById('donor_name').value.trim();
    const email  = document.getElementById('donor_email').value.trim();
    const phone  = document.getElementById('donor_phone_number').value.trim();
    const amount = document.getElementById('donation_amount').value.trim();

    if (!name)  fail('donor_name', 'nameErr');

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) fail('donor_email', 'emailErr');

    if (!phone) fail('donor_phone_number', 'phoneErr');

    // Allow formats like $100, $100.00, 100, 100.00
    if (!/^\$?\d+(\.\d{1,2})?$/.test(amount)) fail('donation_amount', 'amountErr');

    if (!valid) {
        e.preventDefault();
        alert('Wrong input! Please fix the highlighted fields before submitting.');
    }
});
</script>
</body>
</html>
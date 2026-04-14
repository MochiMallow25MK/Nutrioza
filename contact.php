<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrioza - Contact Us</title>
    <link href="https://fonts.googleapis.com/css2?family=Vidaloka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/contact.css">
</head>
<body>
<script>alert('Welcome to Contact Us!');</script>

<nav class="navbar">
    <a href="homepage.php">Home</a>
    <a href="about.php">About Us</a>
    <a href="donation_form.php">Donations</a>
    <a href="volunteering_form.php">Volunteering</a>
    <a href="management.php">Management</a>
</nav>

<div class="container">
    <h1 class="page-title">Contact Us 🌾</h1>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Thank you for contacting us! We'll get back to you soon.</div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-error">Something went wrong. Please try again.</div>
    <?php endif; ?>

    <div class="contact-container">
        <div class="contact-form-section card">
            <h2>Any questions or remarks? Just write us a message!</h2>
            <form method="POST" action="submit_contact.php" id="contactForm" novalidate>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name">
                    <span class="error-msg" id="nameErr">Name is required.</span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter a valid email address">
                    <span class="error-msg" id="emailErr">Please enter a valid email.</span>
                </div>
                <button type="submit" class="btn btn-primary">SUBMIT</button>
            </form>
        </div>

        <div class="contact-info-section">
            <div class="info-block">
                <h3>About Nutrioza</h3>
                <p>Food Distribution Management Company</p>
            </div>
            <div class="info-block">
                <h3>Phone</h3>
                <p>+20 123 4567890</p>
                <p>+20 098 7654321</p>
            </div>
            <div class="info-block">
                <h3>Our Location</h3>
                <p>Building B19, Kerdasa, Giza Governorate 12577, Egypt</p>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    let valid = true;
    const name  = document.getElementById('name');
    const email = document.getElementById('email');

    document.querySelectorAll('.error-msg').forEach(el => el.style.display = 'none');
    document.querySelectorAll('input').forEach(el => el.classList.remove('error'));

    if (!name.value.trim()) {
        document.getElementById('nameErr').style.display = 'block';
        name.classList.add('error');
        valid = false;
    }
    const emailReg = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailReg.test(email.value.trim())) {
        document.getElementById('emailErr').style.display = 'block';
        email.classList.add('error');
        valid = false;
    }
    if (!valid) {
        e.preventDefault();
        alert('Wrong input! Please fix the errors before submitting.');
    }
});
</script>
</body>
</html>
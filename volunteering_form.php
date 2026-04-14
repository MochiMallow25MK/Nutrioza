<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrioza - Volunteer</title>
    <link href="https://fonts.googleapis.com/css2?family=Vidaloka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<script>alert('Welcome to the Volunteering page!');</script>

<nav class="navbar">
    <a href="homepage.php">Home</a>
    <a href="about.php">About Us</a>
    <a href="contact.php">Contact Us</a>
    <a href="donation_form.php">Donations</a>
    <a href="management.php">Management</a>
</nav>

<div class="container">
    <h1 class="page-title">Volunteer With Us 🌾</h1>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Form submitted successfully! We'll be in touch soon.</div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-error">Something went wrong. Please try again.</div>
    <?php endif; ?>

    <div class="card" style="max-width:560px; margin:0 auto;">
        <form method="POST" action="submit_volunteer.php" id="volunteerForm" novalidate>

            <div class="form-group">
                <label for="volunteer_name">Full Name</label>
                <input type="text" id="volunteer_name" name="volunteer_name" placeholder="Enter your full name">
                <span class="error-msg" id="nameErr">Full name is required.</span>
            </div>

            <div class="form-group">
                <label for="volunteer_email">Email</label>
                <input type="email" id="volunteer_email" name="volunteer_email" placeholder="Enter your email">
                <span class="error-msg" id="emailErr">Please enter a valid email address.</span>
            </div>

            <div class="form-group">
                <label for="volunteer_phone">Phone Number</label>
                <input type="text" id="volunteer_phone" name="volunteer_phone" placeholder="e.g. +20 123 4567890">
                <span class="error-msg" id="phoneErr">Phone number is required.</span>
            </div>

            <div class="form-group">
                <label for="availability">Availability</label>
                <select id="availability" name="availability">
                    <option value="">-- Select availability --</option>
                    <option value="Weekdays">Weekdays</option>
                    <option value="Weekends">Weekends</option>
                    <option value="Evenings">Evenings</option>
                    <option value="Flexible">Flexible</option>
                    <option value="Emergency Only">Emergency Only</option>
                </select>
                <span class="error-msg" id="availErr">Please select your availability.</span>
            </div>

            <div class="form-group">
                <label for="skills">Skills</label>
                <textarea id="skills" name="skills" rows="3" placeholder="Describe your skills (e.g. First aid, Driving, Bilingual)"></textarea>
                <span class="error-msg" id="skillsErr">Please describe your skills.</span>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;">SUBMIT APPLICATION</button>
        </form>
    </div>
</div>

<script>
document.getElementById('volunteerForm').addEventListener('submit', function(e) {
    let valid = true;

    document.querySelectorAll('.error-msg').forEach(el => el.style.display = 'none');
    document.querySelectorAll('input, select, textarea').forEach(el => el.classList.remove('error'));

    function fail(inputId, errId) {
        document.getElementById(inputId).classList.add('error');
        document.getElementById(errId).style.display = 'block';
        valid = false;
    }

    if (!document.getElementById('volunteer_name').value.trim())   fail('volunteer_name',  'nameErr');
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(document.getElementById('volunteer_email').value.trim())) fail('volunteer_email', 'emailErr');
    if (!document.getElementById('volunteer_phone').value.trim())  fail('volunteer_phone', 'phoneErr');
    if (!document.getElementById('availability').value)            fail('availability',    'availErr');
    if (!document.getElementById('skills').value.trim())           fail('skills',          'skillsErr');

    if (!valid) {
        e.preventDefault();
        alert('Wrong input! Please fix the highlighted fields before submitting.');
    }
});
</script>
</body>
</html>
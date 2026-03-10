<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrioza - Contact Us</title>
    <link href="https://fonts.googleapis.com/css2?family=Vidaloka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="contact.css">
</head>
<body>
    <?php if (isset($_GET['success'])): ?>
        <div style="background-color: #84B179; color: white; padding: 15px; text-align: center; margin-bottom: 20px; border-radius: 5px; max-width: 1200px; margin: 20px auto;">
            Thank you for contacting us! We'll get back to you soon.
        </div>
    <?php elseif (isset($_GET['error'])): ?>
        <div style="background-color: #ff4444; color: white; padding: 15px; text-align: center; margin-bottom: 20px; border-radius: 5px; max-width: 1200px; margin: 20px auto;">
            Something went wrong. Please try again.
        </div>
    <?php endif; ?>

    <div class="container">
        <h1 class="main-title">Contact Us 🌾</h1>
        <nav class="navbar">
            <a href="homepage.php" class="nav-link">Home</a>
            <a href="about.php" class="nav-link">About Us</a>
            <a href="rolesdashboard.php" class="nav-link">Roles Dashboard</a>
        </nav>
        <div class="contact-container">
            <div class="contact-form-section">
                <h2>Any questions or remarks? Just write us a message!</h2>
                <form id="contactForm" method="POST" action="submit_contact.php">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter a valid email address" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your Name" required>
                    </div>
                    <button type="submit" class="submit-btn">SUBMIT</button>
                </form>
            </div>
            <div class="contact-info-section">
                <div class="info-block">
                    <h3>About Nutrioza</h3>
                    <p>Food Distribution Management Company</p>
                </div>
                <div class="info-block">
                    <h3>Phone (Landline)</h3>
                    <p>+20 123 4567890</p>
                    <p>+20 098 7654321</p>
                </div>
                <div class="info-block">
                    <h3>Our Company's Location</h3>
                    <p>Smart Villages Development and Management Company</p>
                    <p>Building B19, Kerdasa, Giza Governorate 12577, Egypt</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
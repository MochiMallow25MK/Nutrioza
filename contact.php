<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Us - Nutrioza</title>
    <link rel="stylesheet" href="contact.css">
</head>
<body>
    <div class="contact-container">
        <div class="contact-form">
            <h1>Contact Us</h1>
            <p class="subtitle">Any questions or remarks? Just write us a message!</p>
            
            <form action="submit_contact.php" method="POST">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter a valid email address" required>
                </div>
                
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Enter your Name" required>
                </div>
                
                <button type="submit">SUBMIT</button>
            </form>
        </div>
        
        <div class="contact-info">
            <div class="info-section">
                <h3>ABOUT CLUB</h3>
                <p>Running Guide<br>Workouts</p>
            </div>
            
            <div class="info-section">
                <h3>PHONE (LANDLINE)</h3>
                <p>+912 3 567 8987<br>+912 5 252 3336</p>
            </div>
            
            <div class="info-section">
                <h3>OUR OFFICE LOCATION</h3>
                <p>The Interior Design Studio Company<br>The Courtyard, Al Quoz 1, Colorado, USA</p>
            </div>
        </div>
    </div>
</body>
</html>
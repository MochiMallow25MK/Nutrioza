<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Volunteering Form - Nutrioza</title>
    <link rel="stylesheet" href="/Nutrioza/public/css/form.css">
    <script src="/Nutrioza/public/js/form_validation.js"></script>
</head>
<body>
    <div class="form-container">
        <h2>Become a Volunteer</h2>
        
        <form action="/Nutrioza/public/index.php?page=submit-volunteer" method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" id="full_name" name="full_name">
                <span id="nameError" class="error"></span>
            </div>
            
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" id="email" name="email">
                <span id="emailError" class="error"></span>
            </div>
            
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" id="phone" name="phone">
                <span id="phoneError" class="error"></span>
            </div>
            
            <div class="form-group">
                <label>Availability</label>
                <textarea id="availability" name="availability" rows="2" placeholder="When are you available? (e.g., Weekends, Evenings)"></textarea>
                <span id="availError" class="error"></span>
            </div>
            
            <div class="form-group">
                <label>Skills</label>
                <textarea id="skills" name="skills" rows="3" placeholder="What skills can you contribute?"></textarea>
                <span id="skillsError" class="error"></span>
            </div>
            
            <button type="submit">Submit Application</button>
        </form>
        
        <a href="/Nutrioza/public/index.php?page=workspace" class="back-link">Back to Workspace</a>
    </div>
</body>
</html>
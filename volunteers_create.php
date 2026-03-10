<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = mysqli_real_escape_string($link, $_POST['full_name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $phone = mysqli_real_escape_string($link, $_POST['phone']);
    $availability = mysqli_real_escape_string($link, $_POST['availability']);
    $skills = mysqli_real_escape_string($link, $_POST['skills']);
    
    $sql = "INSERT INTO volunteers (full_name, email, phone, availability, skills) 
            VALUES ('$full_name', '$email', '$phone', '$availability', '$skills')";
    
    if (mysqli_query($link, $sql)) {
        header("Location: volunteers_index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Volunteer</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Add New Volunteer</h2>
        <form method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone">
            </div>
            <div class="form-group">
                <label>Availability</label>
                <textarea name="availability" rows="2" required></textarea>
            </div>
            <div class="form-group">
                <label>Skills</label>
                <textarea name="skills" rows="3" required></textarea>
            </div>
            <button type="submit">Add Volunteer</button>
        </form>
        <a href="volunteers_index.php" class="back-link">Back to Volunteers</a>
    </div>
</body>
</html>
<?php
session_start();
require 'config.php';

$full_name = mysqli_real_escape_string($link, $_POST['full_name']);
$email = mysqli_real_escape_string($link, $_POST['email']);
$phone = mysqli_real_escape_string($link, $_POST['phone']);
$availability = mysqli_real_escape_string($link, $_POST['availability']);
$skills = mysqli_real_escape_string($link, $_POST['skills']);

$sql = "INSERT INTO volunteers (full_name, email, phone, availability, skills, status) 
        VALUES ('$full_name', '$email', '$phone', '$availability', '$skills', 'Pending')";

if (mysqli_query($link, $sql)) {
    echo "<script>alert('Volunteer application submitted successfully!'); window.location.href='workspace.php';</script>";
} else {
    echo "<script>alert('Error submitting application: " . mysqli_error($link) . "'); window.location.href='volunteeringform.php';</script>";
}
?>
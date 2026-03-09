<?php
session_start();
require 'config.php';

$donor_name = mysqli_real_escape_string($link, $_POST['donor_name']);
$donor_email = mysqli_real_escape_string($link, $_POST['donor_email']);
$donor_phone = mysqli_real_escape_string($link, $_POST['donor_phone']);
$donation_type = mysqli_real_escape_string($link, $_POST['donation_type']);
$description = mysqli_real_escape_string($link, $_POST['description']);
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : null;
$amount = isset($_POST['amount']) ? (float)$_POST['amount'] : null;

$sql = "INSERT INTO donations (donor_name, donor_email, donor_phone, donation_type, description, quantity, amount, status) 
        VALUES ('$donor_name', '$donor_email', '$donor_phone', '$donation_type', '$description', " . ($quantity ? $quantity : "NULL") . ", " . ($amount ? $amount : "NULL") . ", 'Pending')";

if (mysqli_query($link, $sql)) {
    echo "<script>alert('Donation submitted successfully!'); window.location.href='workspace.php';</script>";
} else {
    echo "<script>alert('Error submitting donation: " . mysqli_error($link) . "'); window.location.href='donationform.php';</script>";
}
?>
<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $donor_name        = trim($_POST['donor_name']        ?? '');
    $donor_email       = trim($_POST['donor_email']       ?? '');
    $donor_phone       = trim($_POST['donor_phone_number'] ?? '');
    $donation_amount   = trim($_POST['donation_amount']   ?? '');

    if (
        empty($donor_name) ||
        !filter_var($donor_email, FILTER_VALIDATE_EMAIL) ||
        empty($donor_phone) ||
        !preg_match('/^\$?\d+(\.\d{1,2})?$/', $donation_amount)
    ) {
        header("Location: donation_form.php?error=1");
        exit();
    }

    $db   = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("INSERT INTO donations (donor_name, donor_email, donor_phone_number, donation_amount, submitted_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param('ssss', $donor_name, $donor_email, $donor_phone, $donation_amount);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: donation_form.php?success=1");
    } else {
        $stmt->close();
        header("Location: donation_form.php?error=1");
    }
    exit();
} else {
    header("Location: donation_form.php");
    exit();
}
?>
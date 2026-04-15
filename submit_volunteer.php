<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $volunteer_name  = trim($_POST['volunteer_name']  ?? '');
    $volunteer_email = trim($_POST['volunteer_email'] ?? '');
    $volunteer_phone = trim($_POST['volunteer_phone_number'] ?? '');
    $availability    = trim($_POST['availability']    ?? '');
    $skills          = trim($_POST['skills']          ?? '');

    if (
        empty($volunteer_name) ||
        !filter_var($volunteer_email, FILTER_VALIDATE_EMAIL) ||
        empty($volunteer_phone) ||
        empty($availability) ||
        empty($skills)
    ) {
        header("Location: volunteering_form.php?error=1");
        exit();
    }

    $db   = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("INSERT INTO volunteers (volunteer_name, volunteer_email, volunteer_phone_number, volunteer_availability, volunteer_skills, applied_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param('sssss', $volunteer_name, $volunteer_email, $volunteer_phone, $availability, $skills);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: volunteering_form.php?success=1");
    } else {
        $stmt->close();
        header("Location: volunteering_form.php?error=1");
    }
    exit();
} else {
    header("Location: volunteering_form.php");
    exit();
}
?>
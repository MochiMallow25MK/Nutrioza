<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name']  ?? '');
    $email = trim($_POST['email'] ?? '');

    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.php?error=1");
        exit();
    }

    $db   = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("INSERT INTO messages (name, email, submitted_at) VALUES (?, ?, NOW())");
    $stmt->bind_param('ss', $name, $email);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: contact.php?success=1");
    } else {
        $stmt->close();
        header("Location: contact.php?error=1");
    }
    exit();
} else {
    header("Location: contact.php");
    exit();
}
?>
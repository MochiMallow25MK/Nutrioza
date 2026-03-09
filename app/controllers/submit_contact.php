<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    
    $sql = "INSERT INTO contact_messages (name, email, submitted_at) VALUES ('$name', '$email', NOW())";
    
    if (mysqli_query($link, $sql)) {
        $_SESSION['contact_success'] = true;
        header("Location: contact.php?success=1");
        exit();
    } else {
        header("Location: contact.php?error=1");
        exit();
    }
} else {
    header("Location: contact.php");
    exit();
}
?>
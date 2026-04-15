<?php
session_start();
require_once 'views/contact_view.php';
$success = isset($_GET['success']);
$error   = isset($_GET['error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrioza - Contact Us</title>
    <link href="https://fonts.googleapis.com/css2?family=Vidaloka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/contact.css">
</head>
<body>
<script>alert('Welcome to Contact Us!');</script>
<?php
$view = new ContactView();
$view->render($success, $error);
?>
</body>
</html>
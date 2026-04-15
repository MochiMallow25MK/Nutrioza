<?php
session_start();
require_once 'views/about_view.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrioza - About Us</title>
    <link href="https://fonts.googleapis.com/css2?family=Vidaloka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/about.css">
</head>
<body>
<script>alert('Welcome to About Us!');</script>
<?php
$view = new AboutView();
$view->render();
?>
</body>
</html>
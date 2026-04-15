<?php
session_start();
require_once 'views/homepage_view.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrioza - Food Distribution System</title>
    <link href="https://fonts.googleapis.com/css2?family=Vidaloka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/homepage.css">
</head>
<body>
<script>alert('Welcome to Nutrioza!');</script>
<?php
$view = new HomepageView();
$view->render();
?>
</body>
</html>
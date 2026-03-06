<?php
session_start();
require 'config.php';

$role = $_POST['role'];
$username = mysqli_real_escape_string($link, $_POST['username']);
$password = mysqli_real_escape_string($link, $_POST['password']);

$credentials = [
    'Admin' => ['username' => 'NutriozaAdmin', 'password' => 'Admin123'],
    'Manager' => ['username' => 'NutriozaManager', 'password' => 'Manager123'],
    'Viewer' => ['username' => 'NutriozaViewer', 'password' => 'Viewer123'],
    'Warehouse Staff' => ['username' => 'NutriozaWarehouseStaff', 'password' => 'WarehouseStaff123'],
    'Supplier' => ['username' => 'NutriozaSupplier', 'password' => 'Supplier123'],
    'Public User' => ['username' => 'NutriozaPublicUser', 'password' => 'PublicUser123']
];

if (isset($credentials[$role]) && $credentials[$role]['username'] === $username && $credentials[$role]['password'] === $password) {
    $_SESSION['role'] = $role;
    $_SESSION['username'] = $username;
    header("Location: workspace.php");
} else {
    echo "<script>alert('Invalid username or password for $role'); window.location.href='login.php?role=$role';</script>";
}
?>
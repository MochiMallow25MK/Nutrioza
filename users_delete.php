<?php
session_start();
require 'config.php';

if (isset($_GET['user_id'])) {
    $user_id = (int)$_GET['user_id'];
    
    $check = mysqli_query($link, "SELECT role_id FROM users WHERE user_id=$user_id");
    $user = mysqli_fetch_assoc($check);
    
    $role_check = mysqli_query($link, "SELECT role_name FROM roles WHERE role_id=" . $user['role_id']);
    $role = mysqli_fetch_assoc($role_check);
    
    if ($role['role_name'] == 'Admin') {
        echo "<script>alert('Cannot delete Admin users!'); window.location.href='users_index.php';</script>";
        exit();
    }
    
    $sql = "DELETE FROM users WHERE user_id=$user_id";
    
    if (mysqli_query($link, $sql)) {
        header("Location: users_index.php");
    } else {
        echo "Error: " . mysqli_error($link);
    }
} else {
    header("Location: users_index.php");
}
?>
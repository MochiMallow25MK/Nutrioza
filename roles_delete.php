<?php
session_start();
require 'config.php';

if (isset($_GET['role_id'])) {
    $role_id = (int)$_GET['role_id'];
    
    $check = mysqli_query($link, "SELECT * FROM users WHERE role_id=$role_id");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Cannot delete role with assigned users!'); window.location.href='roles_index.php';</script>";
        exit();
    }
    
    $sql = "DELETE FROM roles WHERE role_id=$role_id";
    
    if (mysqli_query($link, $sql)) {
        header("Location: roles_index.php");
    } else {
        echo "Error: " . mysqli_error($link);
    }
} else {
    header("Location: roles_index.php");
}
?>
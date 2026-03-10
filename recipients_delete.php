<?php
session_start();
require 'config.php';

if (isset($_GET['recipient_id'])) {
    $recipient_id = (int)$_GET['recipient_id'];
    
    $check = mysqli_query($link, "SELECT * FROM distributions WHERE recipient_id=$recipient_id");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Cannot delete recipient with distribution records!'); window.location.href='recipients_index.php';</script>";
        exit();
    }
    
    $sql = "DELETE FROM recipients WHERE recipient_id=$recipient_id";
    
    if (mysqli_query($link, $sql)) {
        header("Location: recipients_index.php");
    } else {
        echo "Error: " . mysqli_error($link);
    }
} else {
    header("Location: recipients_index.php");
}
?>
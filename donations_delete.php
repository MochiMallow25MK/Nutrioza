<?php
session_start();
require 'config.php';

if (isset($_GET['donation_id'])) {
    $donation_id = (int)$_GET['donation_id'];
    
    $sql = "DELETE FROM donations WHERE donation_id=$donation_id";
    
    if (mysqli_query($link, $sql)) {
        header("Location: donations_index.php");
    } else {
        echo "Error: " . mysqli_error($link);
    }
} else {
    header("Location: donations_index.php");
}
?>
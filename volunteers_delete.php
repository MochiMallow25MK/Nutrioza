<?php
session_start();
require 'config.php';

if (isset($_GET['volunteer_id'])) {
    $volunteer_id = (int)$_GET['volunteer_id'];
    
    $sql = "DELETE FROM volunteers WHERE volunteer_id=$volunteer_id";
    
    if (mysqli_query($link, $sql)) {
        header("Location: volunteers_index.php");
    } else {
        echo "Error: " . mysqli_error($link);
    }
} else {
    header("Location: volunteers_index.php");
}
?>
<?php
session_start();
require 'config.php';

if (isset($_GET['distribution_id'])) {
    $distribution_id = (int)$_GET['distribution_id'];
    
    mysqli_query($link, "DELETE FROM distribution_details WHERE distribution_id=$distribution_id");
    
    $sql = "DELETE FROM distributions WHERE distribution_id=$distribution_id";
    
    if (mysqli_query($link, $sql)) {
        header("Location: distributions_index.php");
    } else {
        echo "Error: " . mysqli_error($link);
    }
} else {
    header("Location: distributions_index.php");
}
?>
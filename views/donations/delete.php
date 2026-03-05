<?php
require_once "../../controllers/DonationController.php";

$id=$_GET['id'];

DonationController::delete($id);

header("Location:list.php");
?>
<?php
require_once "../../controllers/DistributionController.php";

$id = $_GET['id'];

DistributionController::delete($id);

header("Location:list.php");
?>
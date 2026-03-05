<?php
require_once "../../controllers/DistributionDetailController.php";

$id=$_GET['id'];

DistributionDetailController::delete($id);

header("Location:list.php");
?>
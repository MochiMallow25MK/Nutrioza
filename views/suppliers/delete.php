<?php
require_once "../../controllers/SupplierController.php";

$id = $_GET['id'];

SupplierController::delete($id);

header("Location:list.php");
?>
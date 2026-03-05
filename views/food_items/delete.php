<?php
require_once "../../controllers/InventoryController.php";

$id=$_GET['id'];
InventoryController::delete($id);

header("Location:list.php");
?>
<?php
require_once "../../controllers/RoleController.php";

$id = $_GET['id'];

RoleController::delete($id);

header("Location:list.php");
?>
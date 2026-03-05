<?php
require_once "../../controllers/UserController.php";

$id = $_GET['id'];

UserController::delete($id);

header("Location:list.php");
?>
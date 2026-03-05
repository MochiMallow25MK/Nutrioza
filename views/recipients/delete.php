<?php
require_once "../../controllers/RecipientController.php";

$id = $_GET['id'];

RecipientController::delete($id);

header("Location:list.php");
?>
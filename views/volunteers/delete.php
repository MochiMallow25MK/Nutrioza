<?php
require_once "../../controllers/VolunteerController.php";

$id = $_GET['id'];

VolunteerController::delete($id);

header("Location:list.php");
?>
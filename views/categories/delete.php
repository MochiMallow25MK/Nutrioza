<?php
require 'db.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM categories WHERE category_id = ?");
    $stmt->execute([$id]);
}

header("Location: list.php");
exit();
?>
<?php
require_once "../config/config.php";

class ReportModel{

public static function getStock(){
global $link;
$sql = "SELECT fi.item_id, fi.name, c.category_name, s.name AS supplier_name, fi.quantity, fi.expiry_date
        FROM food_items fi
        JOIN categories c ON fi.category_id = c.category_id
        JOIN suppliers s ON fi.supplier_id = s.supplier_id";
return mysqli_query($link,$sql);
}

public static function getDistributions(){
global $link;
$sql = "SELECT d.distribution_id, r.name AS recipient_name, u.name AS approved_by, d.status, d.distribution_date
        FROM distributions d
        JOIN recipients r ON d.recipient_id = r.recipient_id
        LEFT JOIN users u ON d.approved_by = u.user_id";
return mysqli_query($link,$sql);
}

public static function getSuppliers(){
global $link;
$sql = "SELECT supplier_id, name, contact_info, address, created_at FROM suppliers";
return mysqli_query($link,$sql);
}

}
?>
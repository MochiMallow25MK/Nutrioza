<?php
require_once "../config/config.php";

class DistributionDetailModel{
public static function getAll($distribution_id){
global $link;
$sql="SELECT dd.*,f.name AS item_name FROM distribution_details dd JOIN food_items f ON dd.item_id=f.item_id WHERE dd.distribution_id=$distribution_id";
return mysqli_query($link,$sql);
}
public static function create($distribution_id,$item_id,$qty){
global $link;
$sql="INSERT INTO distribution_details(distribution_id,item_id,quantity) VALUES('$distribution_id','$item_id','$qty')";
mysqli_query($link,$sql);
}
public static function delete($id){
global $link;
$sql="DELETE FROM distribution_details WHERE detail_id=$id";
mysqli_query($link,$sql);
}
}
?>
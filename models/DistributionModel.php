<?php
require_once "../config/config.php";

class DistributionModel{
public static function getAll(){
global $link;
$sql="SELECT d.*,r.name AS recipient_name,u.name AS approved_name FROM distributions d LEFT JOIN recipients r ON d.recipient_id=r.recipient_id LEFT JOIN users u ON d.approved_by=u.user_id";
return mysqli_query($link,$sql);
}
public static function getById($id){
global $link;
$sql="SELECT * FROM distributions WHERE distribution_id=$id";
return mysqli_query($link,$sql);
}
public static function create($recipient_id,$date){
global $link;
$sql="INSERT INTO distributions(recipient_id,distribution_date) VALUES('$recipient_id','$date')";
mysqli_query($link,$sql);
}
public static function approve($id,$user_id){
global $link;
$sql="UPDATE distributions SET approved_by='$user_id',status='Approved' WHERE distribution_id=$id";
mysqli_query($link,$sql);
}
public static function delete($id){
global $link;
$sql="DELETE FROM distributions WHERE distribution_id=$id";
mysqli_query($link,$sql);
}
}
?>
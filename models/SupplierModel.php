<?php
require_once "../config/config.php";

class SupplierModel{
public static function getAll(){
global $link;
$sql="SELECT * FROM suppliers";
return mysqli_query($link,$sql);
}
public static function getById($id){
global $link;
$sql="SELECT * FROM suppliers WHERE supplier_id=$id";
return mysqli_query($link,$sql);
}
public static function create($name,$contact,$address){
global $link;
$sql="INSERT INTO suppliers(name,contact_info,address) VALUES('$name','$contact','$address')";
mysqli_query($link,$sql);
}
public static function update($id,$name,$contact,$address){
global $link;
$sql="UPDATE suppliers SET name='$name',contact_info='$contact',address='$address' WHERE supplier_id=$id";
mysqli_query($link,$sql);
}
public static function delete($id){
global $link;
$sql="DELETE FROM suppliers WHERE supplier_id=$id";
mysqli_query($link,$sql);
}
}
?>
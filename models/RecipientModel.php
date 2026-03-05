<?php
require_once "../config/config.php";

class RecipientModel{
public static function getAll(){
global $link;
$sql="SELECT * FROM recipients";
return mysqli_query($link,$sql);
}
public static function getById($id){
global $link;
$sql="SELECT * FROM recipients WHERE recipient_id=$id";
return mysqli_query($link,$sql);
}
public static function create($name,$type,$contact,$address){
global $link;
$sql="INSERT INTO recipients(name,type,contact_info,address) VALUES('$name','$type','$contact','$address')";
mysqli_query($link,$sql);
}
public static function update($id,$name,$type,$contact,$address){
global $link;
$sql="UPDATE recipients SET name='$name',type='$type',contact_info='$contact',address='$address' WHERE recipient_id=$id";
mysqli_query($link,$sql);
}
public static function delete($id){
global $link;
$sql="DELETE FROM recipients WHERE recipient_id=$id";
mysqli_query($link,$sql);
}
}
?>
<?php
require_once "../config/config.php";

class CategoryModel{
public static function getAll(){
global $link;
$sql="SELECT * FROM categories";
return mysqli_query($link,$sql);
}
public static function getById($id){
global $link;
$sql="SELECT * FROM categories WHERE category_id=$id";
return mysqli_query($link,$sql);
}
public static function create($name){
global $link;
$sql="INSERT INTO categories(category_name) VALUES('$name')";
mysqli_query($link,$sql);
}
public static function update($id,$name){
global $link;
$sql="UPDATE categories SET category_name='$name' WHERE category_id=$id";
mysqli_query($link,$sql);
}
public static function delete($id){
global $link;
$sql="DELETE FROM categories WHERE category_id=$id";
mysqli_query($link,$sql);
}
}
?>
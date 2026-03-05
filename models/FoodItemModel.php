<?php
require_once "../config/config.php";

class FoodItemModel{
public static function getAll(){
global $link;
$sql="SELECT f.*,c.category_name,s.name AS supplier_name FROM food_items f JOIN categories c ON f.category_id=c.category_id JOIN suppliers s ON f.supplier_id=s.supplier_id";
return mysqli_query($link,$sql);
}
public static function getById($id){
global $link;
$sql="SELECT * FROM food_items WHERE item_id=$id";
return mysqli_query($link,$sql);
}
public static function create($name,$category,$supplier,$qty,$expiry){
global $link;
$sql="INSERT INTO food_items(name,category_id,supplier_id,quantity,expiry_date) VALUES('$name','$category','$supplier','$qty','$expiry')";
mysqli_query($link,$sql);
}
public static function update($id,$name,$category,$supplier,$qty,$expiry){
global $link;
$sql="UPDATE food_items SET name='$name',category_id='$category',supplier_id='$supplier',quantity='$qty',expiry_date='$expiry' WHERE item_id=$id";
mysqli_query($link,$sql);
}
public static function delete($id){
global $link;
$sql="DELETE FROM food_items WHERE item_id=$id";
mysqli_query($link,$sql);
}
}
?>
<?php
require_once "../models/FoodItemModel.php";

class InventoryController{

public static function list(){
return FoodItemModel::getAll();
}

public static function get($id){
return FoodItemModel::getById($id);
}

public static function create($name,$category,$supplier,$qty,$expiry){
FoodItemModel::create($name,$category,$supplier,$qty,$expiry);
}

public static function update($id,$name,$category,$supplier,$qty,$expiry){
FoodItemModel::update($id,$name,$category,$supplier,$qty,$expiry);
}

public static function delete($id){
FoodItemModel::delete($id);
}

}
?>
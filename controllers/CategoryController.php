<?php
require_once "../models/CategoryModel.php";

class CategoryController{

public static function list(){
return CategoryModel::getAll();
}

public static function get($id){
return CategoryModel::getById($id);
}

public static function create($name){
CategoryModel::create($name);
}

public static function update($id,$name){
CategoryModel::update($id,$name);
}

public static function delete($id){
CategoryModel::delete($id);
}

}
?>
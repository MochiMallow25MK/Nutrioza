<?php
require_once "../models/SupplierModel.php";

class SupplierController{

public static function list(){
return SupplierModel::getAll();
}

public static function get($id){
return SupplierModel::getById($id);
}

public static function create($name,$contact,$address){
SupplierModel::create($name,$contact,$address);
}

public static function update($id,$name,$contact,$address){
SupplierModel::update($id,$name,$contact,$address);
}

public static function delete($id){
SupplierModel::delete($id);
}

}
?>
<?php
require_once "../models/RecipientModel.php";

class RecipientController{

public static function list(){
return RecipientModel::getAll();
}

public static function get($id){
return RecipientModel::getById($id);
}

public static function create($name,$type,$contact,$address){
RecipientModel::create($name,$type,$contact,$address);
}

public static function update($id,$name,$type,$contact,$address){
RecipientModel::update($id,$name,$type,$contact,$address);
}

public static function delete($id){
RecipientModel::delete($id);
}

}
?>
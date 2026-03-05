<?php
require_once "../models/DistributionModel.php";

class DistributionController{

public static function list(){
return DistributionModel::getAll();
}

public static function get($id){
return DistributionModel::getById($id);
}

public static function create($recipient,$date){
DistributionModel::create($recipient,$date);
}

public static function approve($id,$user){
DistributionModel::approve($id,$user);
}

public static function delete($id){
DistributionModel::delete($id);
}

}
?>
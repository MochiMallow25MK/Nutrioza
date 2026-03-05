<?php
require_once "../models/DistributionDetailModel.php";

class DistributionDetailController{

public static function list(){
return DistributionDetailModel::getAll();
}

public static function create($distribution_id,$item_id,$quantity){
DistributionDetailModel::create($distribution_id,$item_id,$quantity);
}

public static function update($id,$distribution_id,$item_id,$quantity){
DistributionDetailModel::update($id,$distribution_id,$item_id,$quantity);
}

public static function delete($id){
DistributionDetailModel::delete($id);
}

}
?>
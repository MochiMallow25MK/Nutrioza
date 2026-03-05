<?php
require_once "../models/FoodItemModel.php";
require_once "../models/DistributionModel.php";
require_once "../models/SupplierModel.php";

class ReportController{

public static function stock(){
return FoodItemModel::getAll();
}

public static function distributions(){
return DistributionModel::getAll();
}

public static function suppliers(){
return SupplierModel::getAll();
}

}
?>
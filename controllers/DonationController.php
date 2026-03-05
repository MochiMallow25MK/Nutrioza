<?php
require_once "../models/DonationModel.php";

class DonationController{

public static function list(){
return DonationModel::getAll();
}

public static function create($name,$email,$phone,$type,$desc,$qty,$amount){
DonationModel::create($name,$email,$phone,$type,$desc,$qty,$amount);
}

public static function approve($id,$user){
DonationModel::approve($id,$user);
}

public static function reject($id,$user){
DonationModel::reject($id,$user);
}

}
?>
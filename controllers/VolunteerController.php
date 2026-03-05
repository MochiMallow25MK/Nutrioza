<?php
require_once "../models/VolunteerModel.php";

class VolunteerController{

public static function list(){
return VolunteerModel::getAll();
}

public static function create($name,$email,$phone,$availability,$skills){
VolunteerModel::create($name,$email,$phone,$availability,$skills);
}

public static function approve($id,$user){
VolunteerModel::approve($id,$user);
}

public static function reject($id,$user){
VolunteerModel::reject($id,$user);
}

}
?>
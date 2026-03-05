<?php
require_once "../models/UserModel.php";

class UserController{

public static function list(){
return UserModel::getAll();
}

public static function get($id){
return UserModel::getById($id);
}

public static function create($name,$email,$password,$role){
UserModel::create($name,$email,$password,$role);
}

public static function update($id,$name,$email,$role,$status){
UserModel::update($id,$name,$email,$role,$status);
}

public static function delete($id){
UserModel::delete($id);
}

}
?>
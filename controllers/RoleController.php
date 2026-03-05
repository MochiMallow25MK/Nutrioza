<?php
require_once "../models/RoleModel.php";

class RoleController{

public static function list(){
return RoleModel::getAll();
}

public static function create($role_name){
global $link;
$sql="INSERT INTO roles (role_name) VALUES ('".mysqli_real_escape_string($link,$role_name)."')";
mysqli_query($link,$sql);
}

public static function update($id,$role_name){
global $link;
$sql="UPDATE roles SET role_name='".mysqli_real_escape_string($link,$role_name)."' WHERE role_id=".intval($id);
mysqli_query($link,$sql);
}

public static function delete($id){
global $link;
$sql="DELETE FROM roles WHERE role_id=".intval($id);
mysqli_query($link,$sql);
}

}
?>
<?php
require_once "../config/config.php";

class RoleModel{
public static function getAll(){
global $link;
$sql="SELECT * FROM roles";
return mysqli_query($link,$sql);
}
}
?>
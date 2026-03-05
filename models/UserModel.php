<?php
require_once "../config/config.php";

class UserModel{

public static function getAll(){
global $link;
$sql="SELECT u.*,r.role_name FROM users u JOIN roles r ON u.role_id=r.role_id";
return mysqli_query($link,$sql);
}

public static function getById($id){
global $link;
$sql="SELECT * FROM users WHERE user_id=$id";
return mysqli_query($link,$sql);
}

public static function create($name,$email,$password,$role){
global $link;
$pass=password_hash($password,PASSWORD_DEFAULT);
$sql="INSERT INTO users(name,email,password,role_id) VALUES('$name','$email','$pass','$role')";
mysqli_query($link,$sql);
}

public static function update($id,$name,$email,$role,$status){
global $link;
$sql="UPDATE users SET name='$name',email='$email',role_id='$role',status='$status' WHERE user_id=$id";
mysqli_query($link,$sql);
}

public static function delete($id){
global $link;
$sql="DELETE FROM users WHERE user_id=$id";
mysqli_query($link,$sql);
}

public static function getByEmail($email){
global $link;
$sql="SELECT * FROM users WHERE email='$email'";
return mysqli_query($link,$sql);
}

}
?>
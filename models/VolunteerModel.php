<?php
require_once "../config/config.php";

class VolunteerModel{
public static function getAll(){
global $link;
$sql="SELECT v.*,u.name AS reviewer_name FROM volunteers v LEFT JOIN users u ON v.reviewed_by=u.user_id";
return mysqli_query($link,$sql);
}
public static function getById($id){
global $link;
$sql="SELECT * FROM volunteers WHERE volunteer_id=$id";
return mysqli_query($link,$sql);
}
public static function create($name,$email,$phone,$avail,$skills){
global $link;
$sql="INSERT INTO volunteers(full_name,email,phone,availability,skills) VALUES('$name','$email','$phone','$avail','$skills')";
mysqli_query($link,$sql);
}
public static function approve($id,$user_id){
global $link;
$sql="UPDATE volunteers SET status='Approved',reviewed_by='$user_id' WHERE volunteer_id=$id";
mysqli_query($link,$sql);
}
public static function reject($id,$user_id){
global $link;
$sql="UPDATE volunteers SET status='Rejected',reviewed_by='$user_id' WHERE volunteer_id=$id";
mysqli_query($link,$sql);
}
}
?>
<?php
require_once "../config/config.php";

class DonationModel{
public static function getAll(){
global $link;
$sql="SELECT d.*,u.name AS reviewer_name FROM donations d LEFT JOIN users u ON d.reviewed_by=u.user_id";
return mysqli_query($link,$sql);
}
public static function getById($id){
global $link;
$sql="SELECT * FROM donations WHERE donation_id=$id";
return mysqli_query($link,$sql);
}
public static function create($name,$email,$phone,$type,$desc,$qty,$amt){
global $link;
$sql="INSERT INTO donations(donor_name,donor_email,donor_phone,donation_type,description,quantity,amount) VALUES('$name','$email','$phone','$type','$desc','$qty','$amt')";
mysqli_query($link,$sql);
}
public static function approve($id,$user_id){
global $link;
$sql="UPDATE donations SET status='Approved',reviewed_by='$user_id' WHERE donation_id=$id";
mysqli_query($link,$sql);
}
public static function reject($id,$user_id){
global $link;
$sql="UPDATE donations SET status='Rejected',reviewed_by='$user_id' WHERE donation_id=$id";
mysqli_query($link,$sql);
}
}
?>
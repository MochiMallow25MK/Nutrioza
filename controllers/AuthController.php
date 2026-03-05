<?php
require_once "../config/config.php";
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){

$email=$_POST["email"];
$password=$_POST["password"];

$sql="SELECT * FROM users WHERE email='$email'";
$result=mysqli_query($link,$sql);

if(mysqli_num_rows($result)==1){

$user=mysqli_fetch_assoc($result);

if(password_verify($password,$user["password"])){

$_SESSION["user_id"]=$user["user_id"];
$_SESSION["role_id"]=$user["role_id"];

switch($user["role_id"]){

case 1:
header("Location: ../views/dashboard/admin.php");
break;

case 2:
header("Location: ../views/dashboard/manager.php");
break;

case 3:
header("Location: ../views/dashboard/warehouse.php");
break;

case 4:
header("Location: ../views/dashboard/supplier.php");
break;

case 5:
header("Location: ../views/dashboard/viewer.php");
break;

}

}else{
echo "<script>alert('Invalid password');window.history.back();</script>";
}

}else{
echo "<script>alert('User not found');window.history.back();</script>";
}

}
?>
<?php
class DashboardController{

public static function redirectByRole($role){
if($role=="Admin") header("Location:views/dashboard/admin.php");
if($role=="Manager") header("Location:views/dashboard/manager.php");
if($role=="Warehouse Staff") header("Location:views/dashboard/warehouse.php");
if($role=="Supplier") header("Location:views/dashboard/supplier.php");
if($role=="Viewer") header("Location:views/dashboard/viewer.php");
}

}
?>
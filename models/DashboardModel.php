<?php
require_once "../config/config.php";

class DashboardModel{

public static function getUserRole($user_id){
    global $link;
    $sql = "SELECT r.role_name 
            FROM users u
            JOIN roles r ON u.role_id = r.role_id
            WHERE u.user_id = $user_id";
    $res = mysqli_query($link, $sql);
    if($row = mysqli_fetch_assoc($res)){
        return $row['role_name'];
    }
    return null;
}

}
?>
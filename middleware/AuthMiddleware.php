<?php
class AuthMiddleware {
    public static function check() {
        session_start();
        if(!isset($_SESSION['user_id'])) {
            header('Location: /nutrioza/login.php');
            exit();
        }
        
        require_once 'config/session.php';
        checkSessionTimeout();
    }
}
?>
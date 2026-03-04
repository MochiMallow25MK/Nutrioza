<?php
require_once 'models/User.php';

class LoginController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function showLoginForm() {
        include 'views/auth/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $user = $this->userModel->login($email, $password);
            
            if ($user) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role_id'];
                $_SESSION['role_name'] = $user['role_name'];
                $_SESSION['last_activity'] = time();
                
                header('Location: /nutrioza/dashboard.php');
            } else {
                $_SESSION['error'] = 'Invalid email or password';
                header('Location: /nutrioza/login.php');
            }
        }
    }
}
?>
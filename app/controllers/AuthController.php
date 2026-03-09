<?php
require_once 'Controller.php';

class AuthController extends Controller {
    
    public function login() {
        $role = isset($_GET['role']) ? $_GET['role'] : '';
        require_once __DIR__ . '/../views/auth/login.php';
    }
    
    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $role = $_POST['role'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $credentials = [
                'Admin' => ['username' => 'NutriozaAdmin', 'password' => 'Admin123'],
                'Manager' => ['username' => 'NutriozaManager', 'password' => 'Manager123'],
                'Viewer' => ['username' => 'NutriozaViewer', 'password' => 'Viewer123'],
                'Warehouse Staff' => ['username' => 'NutriozaWarehouseStaff', 'password' => 'WarehouseStaff123'],
                'Supplier' => ['username' => 'NutriozaSupplier', 'password' => 'Supplier123'],
                'Public User' => ['username' => 'NutriozaPublicUser', 'password' => 'PublicUser123']
            ];
            
            if (isset($credentials[$role]) && 
                $credentials[$role]['username'] === $username && 
                $credentials[$role]['password'] === $password) {
                
                $_SESSION['role'] = $role;
                $_SESSION['username'] = $username;
                $_SESSION['logged_in'] = true;
                
                $this->redirect('/workspace');
            } else {
                $_SESSION['error'] = "Invalid username or password for $role";
                $this->redirect("/login?role=$role");
            }
        }
    }
    
    public function logout() {
        session_destroy();
        $this->redirect('/');
    }
    
    public function rolesDashboard() {
        require_once __DIR__ . '/../views/dashboard/rolesdashboard.php';
    }
    
    public function workspace() {
        if (!isset($_SESSION['role'])) {
            $this->redirect('/roles-dashboard');
        }
        require_once __DIR__ . '/../views/dashboard/workspace.php';
    }
}
?>
<?php
class Controller {
    protected function view($view, $data = []) {
        extract($data);
        
        $viewPath = BASE_PATH . '/views/' . str_replace('.', '/', $view) . '.php';
        
        if (file_exists($viewPath)) {
            require_once BASE_PATH . '/views/layouts/header.php';
            require_once $viewPath;
            require_once BASE_PATH . '/views/layouts/footer.php';
        } else {
            die("View not found: " . $viewPath);
        }
    }
    
    protected function redirect($url) {
        header("Location: " . BASE_URL . $url);
        exit();
    }
    
    protected function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
    
    protected function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
    
    protected function requireLogin() {
        if (!$this->isLoggedIn()) {
            $this->redirect('/login');
        }
    }
    
    protected function hasRole($role) {
        return isset($_SESSION['role']) && $_SESSION['role'] == $role;
    }
}
?>
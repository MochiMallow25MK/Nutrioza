<?php
$request = $_SERVER['REQUEST_URI'];
$base = '/nutrioza';

switch($request) {
    case $base . '/':
    case $base . '/index.php':
        require 'controllers/PublicPageController.php';
        $controller = new PublicPageController();
        $controller->home();
        break;
        
    case $base . '/about':
        require 'views/public-pages/about.php';
        break;
        
    case $base . '/contact':
        require 'views/public-pages/contact.php';
        break;
        
    case $base . '/donate':
        require 'views/public-pages/donate.php';
        break;
        
    case $base . '/volunteer':
        require 'views/public-pages/volunteer.php';
        break;
        
    case $base . '/login':
        require 'controllers/auth/LoginController.php';
        $controller = new LoginController();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controller->login();
        } else {
            $controller->showLoginForm();
        }
        break;
        
    case $base . '/dashboard':
        require 'middleware/AuthMiddleware.php';
        AuthMiddleware::check();
        
        require 'controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->index();
        break;
        
    case $base . '/users':
        require 'middleware/AuthMiddleware.php';
        require 'middleware/RoleMiddleware.php';
        AuthMiddleware::check();
        RoleMiddleware::check([1]);
        
        require 'controllers/UserController.php';
        $controller = new UserController();
        
        if(isset($_GET['action']) && $_GET['action'] == 'create') {
            $controller->create();
        } elseif(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
            $controller->edit($_GET['id']);
        } elseif(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
            $controller->delete($_GET['id']);
        } else {
            $controller->index();
        }
        break;
        
    case $base . '/inventory':
        require 'middleware/AuthMiddleware.php';
        require 'middleware/RoleMiddleware.php';
        AuthMiddleware::check();
        RoleMiddleware::check([1,2,3]);
        
        require 'controllers/FoodItemController.php';
        $controller = new FoodItemController();
        
        if(isset($_GET['action']) && $_GET['action'] == 'create') {
            $controller->create();
        } elseif(isset($_GET['action']) && $_GET['action'] == 'low-stock') {
            $controller->lowStock();
        } elseif(isset($_GET['action']) && $_GET['action'] == 'expiring') {
            $controller->nearExpiry();
        } else {
            $controller->index();
        }
        break;
        
    case $base . '/logout':
        session_destroy();
        header('Location: /nutrioza/login.php');
        break;
        
    default:
        http_response_code(404);
        echo '404 - Page Not Found';
        break;
}
?>
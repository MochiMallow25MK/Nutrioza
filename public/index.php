<?php
session_start();

define('BASE_PATH', dirname(__DIR__));
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/Nutrioza');

require_once BASE_PATH . '/config/config.php';

spl_autoload_register(function ($className) {
    $paths = [
        BASE_PATH . '/models/' . $className . '.php',
        BASE_PATH . '/app/controllers/' . $className . '.php'
    ];
    
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

$request = $_SERVER['REQUEST_URI'];
$scriptName = $_SERVER['SCRIPT_NAME'];
$basePath = str_replace('index.php', '', $scriptName);
$request = str_replace($basePath, '', $request);
$request = strtok($request, '?');

$routes = require BASE_PATH . '/routes/web.php';

$matched = false;
foreach ($routes as $route => $handler) {
    $pattern = '#^' . $route . '$#';
    if (preg_match($pattern, $request, $matches)) {
        array_shift($matches);
        
        if (is_callable($handler)) {
            echo call_user_func_array($handler, $matches);
        } elseif (is_string($handler)) {
            list($controller, $method) = explode('@', $handler);
            $controllerFile = BASE_PATH . '/app/controllers/' . $controller . '.php';
            
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                $controllerInstance = new $controller();
                
                if (method_exists($controllerInstance, $method)) {
                    echo call_user_func_array([$controllerInstance, $method], $matches);
                } else {
                    http_response_code(404);
                    echo "Method not found";
                }
            } else {
                http_response_code(404);
                echo "Controller not found";
            }
        }
        
        $matched = true;
        break;
    }
}

if (!$matched) {
    $viewPath = BASE_PATH . '/views/pages' . $request . '.php';
    if (file_exists($viewPath)) {
        require_once BASE_PATH . '/views/layouts/header.php';
        require_once $viewPath;
        require_once BASE_PATH . '/views/layouts/footer.php';
    } else {
        http_response_code(404);
        echo "404 - Page Not Found";
    }
}
?>
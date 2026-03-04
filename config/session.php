<?php
ini_set('session.gc_maxlifetime', 600);
ini_set('session.cookie_lifetime', 600);
session_start();

function checkSessionTimeout() {
    $timeout = 600;
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
        session_unset();
        session_destroy();
        header('Location: /nutrioza/login.php');
        exit();
    }
    $_SESSION['last_activity'] = time();
}
?>
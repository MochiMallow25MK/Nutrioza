<?php
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'nutrioza');
define('DB_PORT', 3307);

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
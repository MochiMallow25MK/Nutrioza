<?php
define('ROLE_ADMIN', 1);
define('ROLE_MANAGER', 2);
define('ROLE_WAREHOUSE', 3);
define('ROLE_SUPPLIER', 4);
define('ROLE_VIEWER', 5);

function getRoleName($role_id) {
    $roles = [
        1 => 'Admin',
        2 => 'Manager',
        3 => 'Warehouse Staff',
        4 => 'Supplier',
        5 => 'Viewer'
    ];
    return $roles[$role_id] ?? 'Unknown';
}
?>
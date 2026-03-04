<?php
$permissions = [
    ROLE_ADMIN => [
        'manage_users', 'manage_inventory', 'manage_suppliers',
        'manage_distributions', 'view_reports', 'manage_donations',
        'manage_volunteers', 'approve_distributions'
    ],
    ROLE_MANAGER => [
        'manage_inventory', 'manage_suppliers', 'manage_distributions',
        'view_reports', 'approve_distributions'
    ],
    ROLE_WAREHOUSE => [
        'manage_inventory', 'view_suppliers', 'create_distributions'
    ],
    ROLE_SUPPLIER => [
        'view_inventory', 'view_distributions'
    ],
    ROLE_VIEWER => [
        'view_inventory', 'view_distributions', 'view_reports'
    ]
];
?>
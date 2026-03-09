<?php
return [
    '/' => function() {
        require_once BASE_PATH . '/views/pages/homepage.php';
    },
    
    '/home' => function() {
        require_once BASE_PATH . '/views/pages/homepage.php';
    },
    
    '/about' => function() {
        require_once BASE_PATH . '/views/pages/about.php';
    },
    
    '/contact' => function() {
        require_once BASE_PATH . '/views/pages/contact.php';
    },
    
    '/submit-contact' => function() {
        require_once BASE_PATH . '/app/controllers/submit_contact.php';
    },
    
    '/dashboard' => function() {
        require_once BASE_PATH . '/views/dashboard/rolesdashboard.php';
    },
    
    '/login' => function() {
        $role = $_GET['role'] ?? '';
        require_once BASE_PATH . '/views/auth/login.php';
    },
    
    '/authenticate' => function() {
        require_once BASE_PATH . '/app/controllers/authenticate.php';
    },
    
    '/workspace' => function() {
        require_once BASE_PATH . '/views/dashboard/workspace.php';
    },
    
    '/logout' => function() {
        require_once BASE_PATH . '/app/controllers/logout.php';
    },
    
    '/welcome' => function() {
        require_once BASE_PATH . '/views/pages/welcome.php';
    },
    
    '/donation-form' => function() {
        require_once BASE_PATH . '/views/forms/donationform.php';
    },
    
    '/volunteer-form' => function() {
        require_once BASE_PATH . '/views/forms/volunteeringform.php';
    },
    
    '/submit-donation' => function() {
        require_once BASE_PATH . '/app/controllers/submit_donation.php';
    },
    
    '/submit-volunteer' => function() {
        require_once BASE_PATH . '/app/controllers/submit_volunteer.php';
    },
    
    '/stock-report' => function() {
        require_once BASE_PATH . '/views/reports/stock_report.php';
    },
    
    '/distribution-report' => function() {
        require_once BASE_PATH . '/views/reports/distribution_report.php';
    },
    
    '/supplier-report' => function() {
        require_once BASE_PATH . '/views/reports/supplier_report.php';
    },
    
    // Users Routes
    '/users' => 'UsersController@index',
    '/users/create' => 'UsersController@create',
    '/users/store' => 'UsersController@store',
    '/users/(\d+)' => 'UsersController@show',
    '/users/(\d+)/edit' => 'UsersController@edit',
    '/users/(\d+)/update' => 'UsersController@update',
    '/users/(\d+)/delete' => 'UsersController@destroy',
    
    // Roles Routes
    '/roles' => 'RolesController@index',
    '/roles/create' => 'RolesController@create',
    '/roles/store' => 'RolesController@store',
    '/roles/(\d+)' => 'RolesController@show',
    '/roles/(\d+)/edit' => 'RolesController@edit',
    '/roles/(\d+)/update' => 'RolesController@update',
    '/roles/(\d+)/delete' => 'RolesController@destroy',
    
    // Donations Routes
    '/donations' => 'DonationsController@index',
    '/donations/create' => 'DonationsController@create',
    '/donations/store' => 'DonationsController@store',
    '/donations/(\d+)' => 'DonationsController@show',
    '/donations/(\d+)/edit' => 'DonationsController@edit',
    '/donations/(\d+)/update' => 'DonationsController@update',
    '/donations/(\d+)/delete' => 'DonationsController@destroy',
    
    // Volunteers Routes
    '/volunteers' => 'VolunteersController@index',
    '/volunteers/create' => 'VolunteersController@create',
    '/volunteers/store' => 'VolunteersController@store',
    '/volunteers/(\d+)' => 'VolunteersController@show',
    '/volunteers/(\d+)/edit' => 'VolunteersController@edit',
    '/volunteers/(\d+)/update' => 'VolunteersController@update',
    '/volunteers/(\d+)/delete' => 'VolunteersController@destroy',
    
    // Food Items Routes
    '/food-items' => 'FoodItemsController@index',
    '/food-items/create' => 'FoodItemsController@create',
    '/food-items/store' => 'FoodItemsController@store',
    '/food-items/(\d+)' => 'FoodItemsController@show',
    '/food-items/(\d+)/edit' => 'FoodItemsController@edit',
    '/food-items/(\d+)/update' => 'FoodItemsController@update',
    '/food-items/(\d+)/delete' => 'FoodItemsController@destroy',
    
    // Categories Routes
    '/categories' => 'CategoriesController@index',
    '/categories/create' => 'CategoriesController@create',
    '/categories/store' => 'CategoriesController@store',
    '/categories/(\d+)' => 'CategoriesController@show',
    '/categories/(\d+)/edit' => 'CategoriesController@edit',
    '/categories/(\d+)/update' => 'CategoriesController@update',
    '/categories/(\d+)/delete' => 'CategoriesController@destroy',
    
    // Suppliers Routes
    '/suppliers' => 'SuppliersController@index',
    '/suppliers/create' => 'SuppliersController@create',
    '/suppliers/store' => 'SuppliersController@store',
    '/suppliers/(\d+)' => 'SuppliersController@show',
    '/suppliers/(\d+)/edit' => 'SuppliersController@edit',
    '/suppliers/(\d+)/update' => 'SuppliersController@update',
    '/suppliers/(\d+)/delete' => 'SuppliersController@destroy',
    '/purchase-orders' => 'SuppliersController@purchaseOrders',
    
    // Distributions Routes
    '/distributions' => 'DistributionsController@index',
    '/distributions/create' => 'DistributionsController@create',
    '/distributions/store' => 'DistributionsController@store',
    '/distributions/(\d+)' => 'DistributionsController@show',
    '/distributions/(\d+)/edit' => 'DistributionsController@edit',
    '/distributions/(\d+)/update' => 'DistributionsController@update',
    '/distributions/(\d+)/delete' => 'DistributionsController@destroy',
    
    // Distribution Details Routes
    '/distribution-details' => 'DistributionDetailsController@index',
    '/distribution-details/create' => 'DistributionDetailsController@create',
    '/distribution-details/store' => 'DistributionDetailsController@store',
    '/distribution-details/(\d+)' => 'DistributionDetailsController@show',
    '/distribution-details/(\d+)/edit' => 'DistributionDetailsController@edit',
    '/distribution-details/(\d+)/update' => 'DistributionDetailsController@update',
    '/distribution-details/(\d+)/delete' => 'DistributionDetailsController@destroy',
    
    // Recipients Routes
    '/recipients' => 'RecipientsController@index',
    '/recipients/create' => 'RecipientsController@create',
    '/recipients/store' => 'RecipientsController@store',
    '/recipients/(\d+)' => 'RecipientsController@show',
    '/recipients/(\d+)/edit' => 'RecipientsController@edit',
    '/recipients/(\d+)/update' => 'RecipientsController@update',
    '/recipients/(\d+)/delete' => 'RecipientsController@destroy',
];
?>
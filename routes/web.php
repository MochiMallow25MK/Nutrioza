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
    
    '/submit-contact' => 'FormController@submitContact',
    
    '/roles-dashboard' => 'AuthController@rolesDashboard',
    
    '/login' => 'AuthController@login',
    
    '/authenticate' => 'AuthController@authenticate',
    
    '/workspace' => 'AuthController@workspace',
    
    '/logout' => 'AuthController@logout',
    
    '/welcome' => function() {
        require_once BASE_PATH . '/views/pages/welcome.php';
    },
    
    '/donation-form' => 'FormController@showDonationForm',
    
    '/volunteer-form' => 'FormController@showVolunteerForm',
    
    '/submit-donation' => 'FormController@submitDonation',
    
    '/submit-volunteer' => 'FormController@submitVolunteer',
    
    '/stock-report' => function() {
        require_once BASE_PATH . '/views/reports/stock_report.php';
    },
    
    '/distribution-report' => function() {
        require_once BASE_PATH . '/views/reports/distribution_report.php';
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
    '/donations/(\d+)/approve' => 'DonationsController@approve',
    '/donations/(\d+)/reject' => 'DonationsController@reject',
    
    // Volunteers Routes
    '/volunteers' => 'VolunteersController@index',
    '/volunteers/create' => 'VolunteersController@create',
    '/volunteers/store' => 'VolunteersController@store',
    '/volunteers/(\d+)' => 'VolunteersController@show',
    '/volunteers/(\d+)/edit' => 'VolunteersController@edit',
    '/volunteers/(\d+)/update' => 'VolunteersController@update',
    '/volunteers/(\d+)/delete' => 'VolunteersController@destroy',
    '/volunteers/(\d+)/approve' => 'VolunteersController@approve',
    '/volunteers/(\d+)/reject' => 'VolunteersController@reject',
    
    // Food Items Routes
    '/food-items' => 'FoodItemsController@index',
    '/food-items/create' => 'FoodItemsController@create',
    '/food-items/store' => 'FoodItemsController@store',
    '/food-items/(\d+)' => 'FoodItemsController@show',
    '/food-items/(\d+)/edit' => 'FoodItemsController@edit',
    '/food-items/(\d+)/update' => 'FoodItemsController@update',
    '/food-items/(\d+)/delete' => 'FoodItemsController@destroy',
    '/food-items/low-stock' => 'FoodItemsController@lowStock',
    '/food-items/near-expiry' => 'FoodItemsController@nearExpiry',
    
    // Categories Routes
    '/categories' => 'CategoriesController@index',
    '/categories/create' => 'CategoriesController@create',
    '/categories/store' => 'CategoriesController@store',
    '/categories/(\d+)' => 'CategoriesController@show',
    '/categories/(\d+)/edit' => 'CategoriesController@edit',
    '/categories/(\d+)/update' => 'CategoriesController@update',
    '/categories/(\d+)/delete' => 'CategoriesController@destroy',
    '/categories/stats' => 'CategoriesController@stats',
    
    // Suppliers Routes
    '/suppliers' => 'SuppliersController@index',
    '/suppliers/create' => 'SuppliersController@create',
    '/suppliers/store' => 'SuppliersController@store',
    '/suppliers/(\d+)' => 'SuppliersController@show',
    '/suppliers/(\d+)/edit' => 'SuppliersController@edit',
    '/suppliers/(\d+)/update' => 'SuppliersController@update',
    '/suppliers/(\d+)/delete' => 'SuppliersController@destroy',
    '/purchase-orders' => 'SuppliersController@purchaseOrders',
    '/suppliers/performance' => 'SuppliersController@performance',
    
    // Distributions Routes
    '/distributions' => 'DistributionsController@index',
    '/distributions/create' => 'DistributionsController@create',
    '/distributions/store' => 'DistributionsController@store',
    '/distributions/(\d+)' => 'DistributionsController@show',
    '/distributions/(\d+)/edit' => 'DistributionsController@edit',
    '/distributions/(\d+)/update' => 'DistributionsController@update',
    '/distributions/(\d+)/delete' => 'DistributionsController@destroy',
    '/distributions/(\d+)/approve' => 'DistributionsController@approve',
    '/distributions/(\d+)/deliver' => 'DistributionsController@deliver',
    '/distributions/(\d+)/add-items' => 'DistributionsController@addItems',
    
    // Distribution Details Routes
    '/distribution-details' => 'DistributionDetailsController@index',
    '/distribution-details/create' => 'DistributionDetailsController@create',
    '/distribution-details/store' => 'DistributionDetailsController@store',
    '/distribution-details/(\d+)' => 'DistributionDetailsController@show',
    '/distribution-details/(\d+)/edit' => 'DistributionDetailsController@edit',
    '/distribution-details/(\d+)/update' => 'DistributionDetailsController@update',
    '/distribution-details/(\d+)/delete' => 'DistributionDetailsController@destroy',
    '/distributions/(\d+)/details' => 'DistributionDetailsController@byDistribution',
    
    // Recipients Routes
    '/recipients' => 'RecipientsController@index',
    '/recipients/create' => 'RecipientsController@create',
    '/recipients/store' => 'RecipientsController@store',
    '/recipients/(\d+)' => 'RecipientsController@show',
    '/recipients/(\d+)/edit' => 'RecipientsController@edit',
    '/recipients/(\d+)/update' => 'RecipientsController@update',
    '/recipients/(\d+)/delete' => 'RecipientsController@destroy',
    '/recipients/type/([^/]+)' => 'RecipientsController@byType',
];
?>
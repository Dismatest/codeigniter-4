<?php

use Modules\SupperAdmin\Controllers\SupperAdmin;

$routes = $routes ?? '';

$routes->group('supperAdmin', ['namespace' => 'Modules\SupperAdmin\Controllers'], function ($routes) {
    $routes->match(['post', 'get'],'login', 'SupperAdminAuth::login');
    $routes->match(['post', 'get'],'register', 'SupperAdminAuth::register');
    $routes->match(['post', 'get'], 'logout', 'SupperAdminAuth::logout');
    $routes->get('dashboard', 'SupperAdmin::dashboard');

    //sacco routes
    $routes->match(['post', 'get'], 'register-sacco', 'SupperAdmin::registerSacco');
    $routes->match(['post', 'get'], 'manage-sacco', 'SupperAdmin::manageSacco');
    $routes->match(['post', 'get'], 'manage-sacco/edit/(:alphanum)', 'SupperAdmin::manageSaccoEdit/$1');
    $routes->match(['post', 'get'], 'manage-sacco/delete/(:alphanum)', 'SupperAdmin::manageSaccoDelete/$1');

    //user routes
    $routes->get('list-users', 'SupperAdmin::listUsers');
    $routes->get('user-log-in-activities', 'SupperAdmin::userLogInActivities');
    $routes->get('user-log-in-activities/(:num)', 'SupperAdmin::userLogInActivitiesDelete/$1');

    $routes->match(['post', 'get'], 'manage-users', 'SupperAdmin::manageUsers');
    $routes->match(['post', 'get'], 'manage-users/edit/(:alphanum)', 'SupperAdmin::manageUsersEdit/$1');
    $routes->match(['post', 'get'], 'manage-users/delete/(:alphanum)', 'SupperAdmin::manageUsersDelete/$1');


    //shares routes

    $routes->get('approved-shares', 'SupperAdmin::approvedShares');
    $routes->get('not-approved-shares', 'SupperAdmin::notApprovedShares');
    $routes->match(['post', 'get'], 'approve-share/(:alphanum)', 'SupperAdmin::approveShare/$1');
    $routes->get('manage-shares', 'SupperAdmin::manageShares');
    $routes->match(['post', 'get'], 'manage-shares/delete/(:alphanum)', 'SupperAdmin::manageSharesDelete/$1');
    $routes->match(['post', 'get'], 'manage-shares/edit/(:alphanum)', 'SupperAdmin::manageSharesEdit/$1');
});

<?php

use Modules\Admin\Controllers\Admin;


$routes->group('admin', ['namespace' => 'Modules\Admin\Controllers'], function ($routes) {
    $routes->match(['post','get'],'login', 'Admin::login');
    $routes->match(['post','get'],'logout', 'Admin::logout');
    $routes->match(['post','get'],'change-password', 'Admin::changePassword');
    $routes->get('notifications', 'Admin::notifications');
    $routes->get('delete-notification/(:any)', 'Admin::deleteNotification/$1');
    $routes->get('read-notification/(:any)', 'Admin::readNotification/$1');
    $routes->get('manage-shares', 'Admin::manageShares');
    $routes->get('dashboard', 'Admin::dashboard');

});

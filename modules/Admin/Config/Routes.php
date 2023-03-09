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
    $routes->post('verify-share/(:alphanum)', 'Admin::verifyShares/$1');
    $routes->get('delete-share/(:alphanum)', 'Admin::deleteShares/$1');

    //user management routes
    $routes->get('manage-users', 'Admin::manageUsers');
    $routes->match(['post','get'],'add-user-shares', 'Admin::addUserShares');
    $routes->post('update-user-shares/(:num)', 'Admin::updateUserShares/$1');
    $routes->get('delete-user-shares/(:num)', 'Admin::deleteUserShares/$1');

    $routes->get('new-members', 'Admin::newMembers');
    $routes->get('approve-member-request/(:num)', 'Admin::approveMemberRequest/$1');
    $routes->get('delete-member-request/(:num)', 'Admin::deleteMemberRequest/$1');
    $routes->get('dashboard', 'Admin::dashboard');

});

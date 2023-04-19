<?php

use Modules\Admin\Controllers\Admin;


$routes->group('admin', ['namespace' => 'Modules\Admin\Controllers'], function ($routes) {
    $routes->match(['post','get'],'login', 'Admin::login');
    $routes->match(['post','get'],'logout', 'Admin::logout');
    $routes->match(['post','get'],'change-password', 'Admin::changePassword');
    $routes->get('notifications', 'Admin::notifications');
    $routes->get('manage-shares', 'Admin::manageShares');
    $routes->post('verify-share/(:alphanum)', 'Admin::verifyShares/$1');
    $routes->post('manage_shares/approve', 'Admin::approveShare');
    $routes->get('delete-share/(:alphanum)', 'Admin::deleteShares/$1');
    $routes->match(['post', 'get'],'create_share', 'Admin::createShare');

    //user management routes
    $routes->get('list_members', 'Admin::listMembers');
    $routes->get('manage-users', 'Admin::manageUsers');
    $routes->match(['post','get'],'add-user-shares', 'Admin::addUserShares');
    $routes->post('update-user-shares/(:num)', 'Admin::updateUserShares/$1');
    $routes->get('delete-user-shares/(:num)', 'Admin::deleteUserShares/$1');

    $routes->get('new-members', 'Admin::newMembers');
    $routes->get('approve-member-request/(:num)', 'Admin::approveMemberRequest/$1');
    $routes->get('delete-member-request/(:num)', 'Admin::deleteMemberRequest/$1');
    $routes->get('dashboard', 'Admin::dashboard');

    $routes->get('upload_files', 'Admin::uploadAgreementFile');
    $routes->post('upload_agreement_files', 'Admin::uploadAgreementFilesDocument');
    $routes->get('reports', 'Admin::reports');
    $routes->post('reports/view', 'Admin::viewReports');
    $routes->match(['get', 'post'], 'reports/mark_as_complete/(:alphanum)', 'Admin::markAsComplete/$1');

//    creating member shares
    $routes->match(['get', 'post'],'price_per_share', 'Admin::pricePerShare');
//    end

    $routes->get('view_share_notification', 'Admin::viewShareNotification');
    $routes->post('get_each_share_notification', 'Admin::viewEachShareNotification');
    $routes->post('reject_share', 'Admin::rejectShare');
    $routes->post('approve_share', 'Admin::approveShare');
    $routes->post('update_reject_shares', 'Admin::updateRejectShares');

//    new user
    $routes->get('new_user', 'Admin::newUser');
    $routes->post('new_user_post', 'Admin::newUserPost');
//    end

});

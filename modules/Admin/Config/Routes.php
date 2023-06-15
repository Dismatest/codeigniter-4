<?php

use Modules\Admin\Controllers\Admin;
use Modules\Admin\Filters\SaccoAdminLoginFilter;


$routes->group('admin', ['namespace' => 'Modules\Admin\Controllers', 'filter' => SaccoAdminLoginFilter::class], function ($routes) {
    $routes->match(['post','get'],'logout', 'Admin::logout');
    $routes->match(['post','get'],'change-password', 'Admin::changePassword');
    $routes->get('notifications', 'Admin::notifications');
    $routes->get('manage-shares-on-sale', 'Admin::manageShares');
    $routes->post('verify-share/(:segment)', 'Admin::verifyShares/$1');
    $routes->post('manage_shares/approve', 'Admin::approveShare');
    $routes->match(['get', 'post'], 'delete-share/(:segment)', 'Admin::deleteShares/$1');
    $routes->match(['post', 'get'],'create_share', 'Admin::createShare');
    $routes->match(['post', 'get'],'view-sold-shares', 'Admin::viewSoldShares');
    $routes->match(['post', 'get'],'view-statistics', 'Admin::viewStatistics');

    //user management routes
    $routes->get('list_members', 'Admin::listMembers');
    $routes->get('manage-new-users', 'Admin::manageNewUsers');
    $routes->match(['post','get'],'add-user-shares', 'Admin::addUserShares');
    $routes->post('update-user-shares/(:num)', 'Admin::updateUserShares/$1');
    $routes->get('delete-user-shares/(:num)', 'Admin::deleteUserShares/$1');

    $routes->get('new-members', 'Admin::newMembers');
    $routes->get('approve-member-request/(:num)', 'Admin::approveMemberRequest/$1');
    $routes->get('delete-member-request/(:num)', 'Admin::deleteMemberRequest/$1');
    $routes->get('dashboard', 'Admin::dashboard');

    $routes->get('upload_files', 'Admin::uploadAgreementFile');
    $routes->post('upload_agreement_files', 'Admin::uploadAgreementFilesDocument');

//  transactions
    $routes->get('view-transactions', 'Admin::viewTransactions');
    $routes->post('reports/view', 'Admin::viewReports');
    $routes->match(['get', 'post'], 'reports/mark_as_complete/(:segment)', 'Admin::markAsComplete/$1');

    $routes->get('completed-transaction', 'Admin::viewCompletedTransactions');
    $routes->get('pending-transaction', 'Admin::viewPendingTransactions');
    $routes->match(['get', 'post'], 'delete/attempted-transaction/(:num)', 'Admin::viewRejectedTransactions/$1');

//    bids report
    $routes->get('bids-report', 'Admin::bidsReport');
    $routes->post('bids-report/view', 'Admin::viewBidsReport');

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
    $routes->post('new_user_post_csv', 'Admin::newUserPostCsv');

    $routes->get('get-all-app-users', 'Admin::getAllAppUsers');
    $routes->post('admin-sell-shares', 'Admin::adminSellShares');

    $routes->get('update-account', 'Admin::UpdateAccount');
    $routes->post('update-sacco-profile', 'Admin::UpdateAccountPost');

    $routes->get('get-updated-profile', 'Admin::getUpdatedProfile');

    $routes->get('get_sacco_image', 'Admin::getSaccoImage');
//    end

});

$routes->group('admin', ['namespace' => 'Modules\Admin\Controllers'], function ($routes) {
    $routes->match(['post','get'],'login', 'Admin::login');
    $routes->match(['post','get'],'forgot-password', 'Admin::forgotPassword');
    $routes->match(['post','get'],'password-reset-link/(:segment)', 'Admin::resetPassword/$1');
});

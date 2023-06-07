<?php

use Modules\SupperAdmin\Controllers\SupperAdmin;
use Modules\SupperAdmin\Filters\AdminLoginFilter;

$routes = $routes ?? '';

$routes->group('supperAdmin', ['namespace' => 'Modules\SupperAdmin\Controllers', 'filter' => AdminLoginFilter::class], function ($routes) {
    $routes->match(['post', 'get'], 'logout', 'SupperAdminAuth::logout');
    $routes->get('dashboard', 'SupperAdmin::dashboard');

    //sacco routes
    $routes->match(['post', 'get'], 'register-sacco', 'SupperAdmin::registerSacco');
    $routes->match(['post', 'get'], 'manage-sacco', 'SupperAdmin::manageSacco');
    $routes->match(['post', 'get'], 'manage-sacco/edit/(:segment)', 'SupperAdmin::manageSaccoEdit/$1');
    $routes->match(['post', 'get'], 'manage-sacco/delete/(:segment)', 'SupperAdmin::manageSaccoDelete/$1');

    //user routes
    $routes->get('list-users', 'SupperAdmin::listUsers');
    $routes->get('user-log-in-activities', 'SupperAdmin::userLogInActivities');
    $routes->get('user-log-in-activities/(:num)', 'SupperAdmin::userLogInActivitiesDelete/$1');

    $routes->match(['post', 'get'], 'manage-users', 'SupperAdmin::manageUsers');
    $routes->match(['post', 'get'], 'manage-users/edit/(:alphanum)', 'SupperAdmin::manageUsersEdit/$1');
    $routes->match(['post', 'get'], 'manage-users/delete/(:alphanum)', 'SupperAdmin::manageUsersDelete/$1');


    //shares routes

    $routes->get('approved-shares', 'SupperAdmin::approvedShares');

    $routes->get('set_buyer_commission', 'SupperAdmin::setBuyerCommission');
    $routes->post('set_commission/buyer_commission', 'SupperAdmin::setCommissionAjax');
    $routes->get('set_commission/get_buyer_commission', 'SupperAdmin::getBuyerCommissionAjax');
    $routes->get('set_commission/get_buyer_commission_by_id', 'SupperAdmin::getBuyerCommissionByIdAjax');
    $routes->post('set_commission/update_buyer_commission_by_id', 'SupperAdmin::updateBuyerCommissionByIdAjax');
    $routes->post('set_commission/delete_buyer_commission_by_id', 'SupperAdmin::deleteBuyerCommissionByIdAjax');

//    set seller commission
    $routes->get('set_seller_commission', 'SupperAdmin::setSellerCommission');

//    set commission for sacco
    $routes->get('set_sacco_commission', 'SupperAdmin::setSaccoCommission');
    $routes->post('set_sacco_commission', 'SupperAdmin::setSaccoCommissionAjax');
    $routes->get('set_sacco_commission/get_sacco_commission', 'SupperAdmin::getSaccoCommissionAjax');
    $routes->get('set_sacco_commission/get_sacco_commission_by_id', 'SupperAdmin::getSaccoCommissionByIdAjax');
    $routes->post('set_sacco_commission/update_sacco_commission_by_id', 'SupperAdmin::updateSaccoCommissionByIdAjax');
    $routes->post('set_sacco_commission/delete_sacco_commission_by_id', 'SupperAdmin::deleteSaccoCommissionByIdAjax');


    $routes->get('not-approved-shares', 'SupperAdmin::notApprovedShares');
    $routes->get('rejected-shares', 'SupperAdmin::rejectedShares');
    $routes->match(['post', 'get'], 'approve-share/(:alphanum)', 'SupperAdmin::approveShare/$1');
    $routes->get('manage-shares', 'SupperAdmin::manageShares');
    $routes->match(['post', 'get'], 'manage-shares/delete/(:alphanum)', 'SupperAdmin::manageSharesDelete/$1');
    $routes->match(['post', 'get'], 'manage-shares/edit/(:alphanum)', 'SupperAdmin::manageSharesEdit/$1');

    //audit trail routes

    $routes->get('audit_trail', 'SupperAdmin::auditTrail');
    $routes->get('delete-audit-trail/(:num)', 'SupperAdmin::auditTrailDelete/$1');

    $routes->get('view-transactions', 'SupperAdmin::viewTransactions');
    $routes->get('view-pending-transactions', 'SupperAdmin::pendingTransactions');

    $routes->match(['get', 'post'], 'register-new_admin', 'SupperAdmin::registerNewAdmin');
    $routes->match(['get', 'post'], 'change-password', 'SupperAdmin::changePassword');
});

//routes without login filters

$routes->group('supperAdmin', ['namespace' => 'Modules\SupperAdmin\Controllers'], function ($routes) {
    $routes->match(['post', 'get'],'login', 'SupperAdminAuth::login');
    $routes->match(['post', 'get'],'register', 'SupperAdminAuth::register');
    $routes->match(['get', 'post'], 'forget-password', 'SupperAdminAuth::forgetPassword');
    $routes->match(['get', 'post'], 'password-reset-link/(:segment)', 'SupperAdminAuth::resetPassword/$1');
});
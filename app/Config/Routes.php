<?php

namespace Config;

// Create a new instance of our RouteCollection class.
use App\Controllers\Home;

$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

//all the client routes
$routes->group('', function($routes){
    $routes->match(['get', 'post'], 'register', 'Auth::register');
    $routes->match(['get', 'post'], 'activate/(:alphanum)', 'Auth::activate/$1');

});

//routes with login filter
//$routes->group('', function($routes){
    $routes->group('', ['filter'=>'isLoggedInFilter'], function($routes){
    $routes->match(['get', 'post'], 'index', 'Home::indexPage');
    $routes->match(['get', 'post'], 'dashboard', 'Home::dashboard');
    $routes->match(['get', 'post'], 'share/(:alphanum)', 'Home::share/$1');
    $routes->match(['get', 'post'], 'update-profile', 'Profile::updateProfile');
    $routes->match(['get', 'post'], 'share/(:alphanum)/bid', 'Home::bid/$1/bid');
    $routes->match(['get', 'post'], 'my_bids', 'Home::bids');
    $routes->match(['get', 'post'], 'my_bids/accept/(:num)', 'Home::acceptBid/$1');
    $routes->match(['get', 'post'], 'my_bids/reject/(:num)', 'Home::rejectBid/$1');
    $routes->match(['get', 'post'], 'payment/initiate_payment', 'Home::payment');
    $routes->match(['get', 'post'], 'sacco_membership', 'Home::saccoMembership');
    $routes->match(['get', 'post'], 'saved', 'Home::savedShares');
    $routes->match(['get', 'post'], 'profile', 'Home::profile');
    $routes->match(['get', 'post'], 'saved/need_help', 'Home::needHelp');
    $routes->match(['get', 'post'], 'saved/your_active_shares', 'Home::activeShares');
    $routes->match(['get', 'post'], 'saved/your_share_history', 'Home::shareHistory');
    $routes->match(['get', 'post'], 'saved/your_membership', 'Home::membershipStatus');
    $routes->match(['get', 'post'], 'messages', 'Home::messages');
    $routes->match(['get', 'post'], 'message/(:num)', 'Home::message/1$');
    $routes->match(['get', 'post'], 'index/search', 'Home::search');
    $routes->match(['get', 'post'], 'saved/your_share_history/(:alpahnum)', 'Home::saveShare/1$');
    $routes->match(['get', 'post'], 'sell', 'Home::sell');
    $routes->match(['get', 'post'], 'sell-now/', 'Home::sellNow');
    $routes->match(['get', 'post'], 'share/(:alphanum)/request_membership', 'Home::requestMembership/$1');
    $routes->post('share/save_new_membership', 'Home::saveMembershipAjax');
    $routes->match(['get', 'post'], 'notifications', 'Home::notifications');
    $routes->get('share/delete_bid/(:alphanum)', 'Home::delete_accepted_bid_sharesAjax/$1');
    $routes->get('share/delete_bid_rejected/(:alphanum)', 'Home::delete_rejected_bid_sharesAjax/$1');


    $routes->match(['get', 'post'], 'sell-now/requestSell', 'Home::sellNowAjax');
    $routes->post('get_sacco_cost_per_share', 'Home::getSaccoCostPerShare');

    $routes->get('saved/shares_status', 'Home::yourShareStatus');


    $routes->match(['get', 'post'], 'sell/verify_memberNumber', 'Home::verifyMemberNumber');
    $routes->match(['get', 'post'], 'logout', 'Auth::logout');

});

//routes without login filter
$routes->group('', function ($routes){
    $routes->match(['post', 'get'], '/', 'Home::welcomePage');
    $routes->match(['post', 'get'], 'login', 'Auth::login');
    $routes->match(['get', 'post'], 'forgot-password', 'Home::forgotPassword');
    $routes->match(['get', 'post'], 'password-reset/(:alphanum)', 'Home::passwordReset/$1');
    $routes->match(['get', 'post'], 'payment_callback', 'Home::paymentCallback');
    $routes->get('sacco-all-shares/(:alphanum)', 'Home::getSaccoAllShares/$1');
    $routes->get('all_sacco_shares/', 'Home::getSaccoShares');
});

//routes for server error

$routes->group('', function ($routes){
    $routes->get('/server-errors/many-requests', 'ServerError::manyRequests');
});

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

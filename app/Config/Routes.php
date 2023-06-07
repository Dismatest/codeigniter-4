<?php

namespace Config;

// Create a new instance of our RouteCollection class.
use App\Controllers\Home;
use App\Controllers\Server;

$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

//all the client routes
$routes->group('', function ($routes) {
    $routes->match(['get', 'post'], 'register', 'Auth::register');
    $routes->match(['get', 'post'], 'activate/(:segment)', 'Auth::activate/$1');

});

//routes with login filter
//$routes->group('', function($routes){
$routes->group('', ['filter' => 'isLoggedInFilter'], function ($routes) {
    $routes->match(['get', 'post'], 'index', 'Home::indexPage');
    $routes->match(['get', 'post'], 'explore', 'Home::explorePage');

    $routes->get('explore/get_recommended', 'Home::getRecommendedShares');

    $routes->match(['get', 'post'], 'share/(:segment)', 'Home::share/$1');
    $routes->match(['get', 'post'], 'update-profile', 'Profile::updateProfile');
    $routes->match(['get', 'post'], 'share/(:segment)/bid', 'Home::bid/$1/bid');
    $routes->get('has_bid/(:segment)/', 'Home::hasBid/$1');
    $routes->get('has_active_bid/(:segment)/', 'Home::hasActiveBid/$1');
    $routes->match(['get', 'post'], 'my_bids/accept/(:num)', 'Home::acceptBid/$1');
    $routes->match(['get', 'post'], 'my_bids/reject/(:num)', 'Home::rejectBid/$1');
    $routes->match(['get', 'post'], 'payment/initiate_payment', 'Home::payment');
    $routes->post('payment/confirm_payment', 'Home::confirmPayment');
    $routes->post('payment/get_bid', 'Home::getBid');

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
    $routes->post('saved/saved_share', 'Home::saveShare');
    $routes->match(['get', 'post'], 'sell', 'Home::sell');
    $routes->match(['get', 'post'], 'sell-now/', 'Home::sellNow');
    $routes->match(['get', 'post'], 'my_bids', 'Home::bids');
    $routes->match(['get', 'post'], 'share/(:segment)/request_membership', 'Home::requestMembership/$1');
    $routes->post('share/(:segment)/save_new_membership/save', 'Home::saveMembershipAjax/$1');
    $routes->match(['get', 'post'], 'notifications', 'Home::notifications');
    $routes->get('share/delete_bid/(:segment)', 'Home::delete_accepted_bid_sharesAjax/$1');
    $routes->get('share/delete_bid_rejected/(:segment)', 'Home::delete_rejected_bid_sharesAjax/$1');


    $routes->match(['get', 'post'], 'sell-now/requestSell', 'Home::sellNowAjax');
    $routes->post('get_sacco_cost_per_share', 'Home::getSaccoCostPerShare');

    $routes->get('saved/shares_status', 'Home::yourShareStatus');

    $routes->get('get-all-sacco', 'Home::getSacco');

    $routes->match(['get', 'post'], 'sell/verify_memberNumber', 'Home::verifyMemberNumber');
    $routes->match(['get', 'post'], 'logout', 'Auth::logout');

    $routes->post('saved/saved_shares', 'Home::savedSharesAjax');
    $routes->get('saved/get-all-saved-shares', 'Home::getAllSavedSharesAjax');
    $routes->post('saved/delete-saved-share', 'Home::deleteSavedShareAjax');

//    explore search routes

    $routes->get('explore/search', 'Home::exploreSearch');

});

//routes without login filter
$routes->group('', function ($routes) {
    $routes->match(['post', 'get'], '/', 'Home::welcomePage');
    $routes->match(['post', 'get'], 'login', 'Auth::login');
    $routes->match(['get', 'post'], 'forgot-password', 'Home::forgotPassword');
    $routes->match(['get', 'post'], 'password-reset/(:segment)', 'Home::passwordReset/$1');
    $routes->match(['get', 'post'], 'payment_callback', 'Home::paymentCallback');
    $routes->get('sacco-all-shares/(:segment)', 'Home::getSaccoAllShares/$1');
    $routes->get('all_sacco_shares/', 'Home::getSaccoShares');
    $routes->cli('server/index', 'Server::index');

});

//routes for server error

$routes->group('', function ($routes) {
    $routes->get('/server-errors/many-requests', 'ServerError::manyRequests');
});

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

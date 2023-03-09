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
    $routes->match(['get', 'post'], 'logout', 'Auth::logout');
});

//routes with login filter
$routes->group('', ['filter'=>'isLoggedInFilter'], function($routes){
    $routes->match(['get', 'post'], 'welcome_page', 'Home::welcomePage');
    $routes->match(['get', 'post'], 'index', 'Home::indexPage');
    $routes->match(['get', 'post'], 'dashboard', 'Home::dashboard');
    $routes->match(['get', 'post'], 'share/(:alphanum)', 'Home::share/$1');
    $routes->match(['get', 'post'], 'update-profile', 'Profile::updateProfile');
    $routes->match(['get', 'post'], 'payment/initiate_payment', 'Home::payment');
    $routes->match(['get', 'post'], 'sacco_membership', 'Home::saccoMembership');
    $routes->match(['get', 'post'], 'messages', 'Home::messages');
    $routes->match(['get', 'post'], 'message/(:num)', 'Home::message/1$');
    $routes->match(['get', 'post'], 'payment_callback', 'Home::paymentCallback');
    $routes->post('payment_callbacks', 'Home::paymentConfirmationCallBack');

});

//Home::indexPage

//routes without login filter
$routes->group('', function ($routes){
    $routes->match(['post', 'get'], '/', 'Auth::login');
    $routes->match(['get', 'post'], 'change-password', 'Auth::changePassword');
    $routes->match(['get', 'post'], 'password-reset/(:alphanum)', 'Home::verifyEmail/$1');

});

//routes for server error

$routes->group('', function ($routes){
    $routes->get('/server-errors/many-requests', 'ServerError::manyRequests');
});

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

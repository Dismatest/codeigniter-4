<?php

use Modules\SupperAdmin\Controllers\SupperAdmin;

$routes->group('auth', ['namespace' => 'Modules\SupperAdmin\Controllers'], function ($routes) {
    $routes->get('/', 'SupperAdmin::login');
    $routes->get('admin', 'SupperAdmin::index');
});
<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'isAdminLoggedInFilter' => \Modules\SupperAdmin\Filters\AdminLoginFilter::class,
        'isSaccoAdminLoggedInFilter' => \Modules\Admin\Filters\SaccoAdminLoginFilter::class,
        'isLoggedInFilter' => \App\Filters\LoginFilter::class,
        'ipBlocker' => \App\Filters\IpBlocker::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     */
    public array $globals = [
        'before' => [
             //this is the filter that will be applied to all routes
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
//            'isLoggedInFilter' => [
//                'except' => [
//                    '',
//                    '/*',
//            'isAdminLoggedInFilter' => [
//                'before' => ['Modules\SupperAdmin\Controllers\SupperAdmin/*'],
//            ],

            ],
//        ],
//        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     */
    public array $methods = [

        // applying this filter to all post routes
        'post' => ['ipBlocker'],

    ];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     */
    public array $filters = [];
}

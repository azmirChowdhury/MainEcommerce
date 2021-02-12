<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Laravel\Jetstream\Http\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'admin'=>\App\Http\Middleware\AdminUserDashBoardLog::class,
        'AdminValidation'=>\App\Http\Middleware\admin\AdminValidation::class,
        'DashboardAuth'=>\App\Http\Middleware\admin\DashboardAuth::class,
        'AdminStatusValidation'=>\App\Http\Middleware\admin\AdminStatusValidation::class,

        'email'=>\App\Http\Middleware\admin\coUser\EmailMiddleware::class,
        'order'=>\App\Http\Middleware\admin\coUser\OrderMiddleware::class,
        'appearance'=>\App\Http\Middleware\admin\coUser\AppearenceMiddleware::class,
        'brand'=>\App\Http\Middleware\admin\coUser\BrandMiddleware::class,
        'coupon'=>\App\Http\Middleware\admin\coUser\CuponMiddleware::class,
        'customer'=>\App\Http\Middleware\admin\coUser\CustomerMiddleware::class,
        'deals'=>\App\Http\Middleware\admin\coUser\DealsMiddleware::class,
        'htmlBlocks'=>\App\Http\Middleware\admin\coUser\HtmlBlockMiddleware::class,
        'page'=>\App\Http\Middleware\admin\coUser\PagesMiddleware::class,
        'parentMenu'=>\App\Http\Middleware\admin\coUser\ParentMunuMiddleware::class,
        'product'=>\App\Http\Middleware\admin\coUser\ProductsMiddleware::class,
        'size_color'=>\App\Http\Middleware\admin\coUser\SizeColorMiddleware::class,
        'slider'=>\App\Http\Middleware\admin\coUser\SliderMiddleware::class,
        'subcategory'=>\App\Http\Middleware\admin\coUser\SubcategoryMiddleware::class,
        'utilities'=>\App\Http\Middleware\admin\coUser\UtilitiesMiddleware::class,

    ];
}

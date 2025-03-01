<?php

namespace App\Http;

use App\Http\Middleware\ActivityInProject;
use App\Http\Middleware\AddAppNavigationBarCounts;
use App\Http\Middleware\AddProjectNavigationBarCounts;
use App\Http\Middleware\DatasetInProject;
use App\Http\Middleware\EntityInProject;
use App\Http\Middleware\EntityStateInProject;
use App\Http\Middleware\ExperimentInProject;
use App\Http\Middleware\FileInProject;
use App\Http\Middleware\PublicRouteDatasetIsPublished;
use App\Http\Middleware\UserCanAccessProject;
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
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
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
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            UserCanAccessProject::class,
            AddProjectNavigationBarCounts::class,
            AddAppNavigationBarCounts::class,
            FileInProject::class,
            ActivityInProject::class,
            EntityInProject::class,
            EntityStateInProject::class,
            DatasetInProject::class,
            ExperimentInProject::class,
            PublicRouteDatasetIsPublished::class,
        ],

        'api' => [
            'throttle:300,1',
            'bindings',
            UserCanAccessProject::class,
            FileInProject::class,
            ActivityInProject::class,
            EntityInProject::class,
            EntityStateInProject::class,
            DatasetInProject::class,
            ExperimentInProject::class,
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
        'auth'          => \App\Http\Middleware\Authenticate::class,
        'auth.basic'    => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings'      => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can'           => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'         => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed'        => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle'      => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified'      => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'feature'       => \YlsIdeas\FeatureFlags\Middleware\FeatureFlagState::class,
    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\Authenticate::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\Authorize::class,
    ];
}

<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        $router->model('article',  'App\Article');
        $router->model('category', 'App\Category');
        $router->model('language', 'App\Language');
        $router->model('page', 'App\Page');
        $router->model('setting', 'App\Setting');
        $router->model('user', 'App\User');
        $router->model('carousel', 'App\Carousel');
        $router->model('partner', 'App\Partner');
        $router->model('promotion', 'App\Promotion');
        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function($router)
        {
            require app_path('Http/routes.php');
        });
    }

}

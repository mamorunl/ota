<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 13-6-2015
 * Time: 20:13
 */

namespace mamorunl\OTA;


use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class OTAServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    public function boot()
    {
        $this->setupViews();

        $this->setupTranslations();

        $this->setupRoutes($this->app->router);
    }

    protected function setupViews()
    {
        $this->loadViewsFrom(realpath(__DIR__ . '/resources/views'), 'mamorunl-ota');
    }

    protected function setupTranslations()
    {
        $this->loadTranslationsFrom(realpath(__DIR__ . '/resources/lang'), 'mamorunl-ota');
    }

    protected function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'mamorunl\OTA\Http\Controllers'], function (Router $router) {
            require __DIR__ . '/Http/routes.php';
        });
    }
}
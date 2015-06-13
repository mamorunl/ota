<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 13-6-2015
 * Time: 20:13
 */

namespace mamorunl\OTA;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use mamorunl\OTA\Models\OTAHandler;

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

        $this->setupPublishers();

        $this->setupRoutes($this->app->router);

        $this->setupOTAFacade($this->app);
    }

    protected function setupViews()
    {
        $this->loadViewsFrom(realpath(__DIR__ . '/resources/views'), 'mamorunl-ota');
    }

    protected function setupTranslations()
    {
        $this->loadTranslationsFrom(realpath(__DIR__ . '/resources/lang'), 'mamorunl-ota');
    }

    protected function setupPublishers()
    {
        $this->publishes([
            realpath(__DIR__ . '/config/providers.php') => config_path('providers.php')
        ]);
    }

    protected function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'mamorunl\OTA\Http\Controllers'], function (Router $router) {
            require __DIR__ . '/Http/routes.php';
        });
    }

    protected function setupOTAFacade(Application $app)
    {
        $app->singleton('mamorunl\OTA\Models\OTAHandler', function($app) {
            return new OTAHandler();
        });
    }
}
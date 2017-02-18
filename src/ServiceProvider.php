<?php namespace Jeffchung\Awesome;

use Collective\Html\HtmlBuilder;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {

        $this->handleConfigs();
        // $this->handleMigrations();
        // $this->handleViews();
        // $this->handleTranslations();
         $this->handleRoutes();
         $this->registerFormBuilder();
    }
//
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

        // Bind any implementations.

    }
    private function registerFormBuilder()
    {
        $this->app->bind(
            'collective::html',
            function ($app) {
                return new HtmlBuilder($app->make('url'), $app->make('view'));
            }
        );
        $this->app->bind(
            'jeffchungawesome::form',
            function ($app) {
                $form = new Form(
                    $app->make('collective::html'),
                    $app->make('url'),
                    $app->make('view'),
                    $app['session.store']->getToken()
                );

                return $form->setSessionStore($app['session.store']);
            },
            true
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {

        return [];
    }

    private function handleConfigs() {

        $configPath = __DIR__ . '/../config/jeffchung-awesome.php';

        $this->publishes([$configPath => config_path('jeffchung-awesome.php')]);

        $this->mergeConfigFrom($configPath, 'packagename');
    }

    private function handleTranslations() {

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'packagename');
    }

    private function handleViews() {

        $this->loadViewsFrom(__DIR__.'/../views', 'packagename');

        $this->publishes([__DIR__.'/../views' => base_path('resources/views/vendor/packagename')]);
    }

    private function handleMigrations() {

        $this->publishes([__DIR__ . '/../migrations' => base_path('database/migrations')]);
    }

    private function handleRoutes() {

        include __DIR__.'/../routes.php';
    }
}

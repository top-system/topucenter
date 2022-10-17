<?php

namespace TopSystem\UCenter;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use TopSystem\TopAdmin\Facades\Admin;
use TopSystem\TopAdmin\Seed;
use TopSystem\UCenter\Http\Middleware\MemberMiddleware;
use TopSystem\UCenter\Facades\UCenter as UCenterFacade;

class UCenterServiceProvider extends ServiceProvider{
    /**
     * Register the application services.
     */
    public function register()
    {

        $loader = AliasLoader::getInstance();
        $loader->alias('UCenter', UCenterFacade::class);

        $this->app->singleton('UCenterGuard', function () {
            return 'uc';
        });

        $this->registerConfigs();

        $this->loadHelpers();

        if ($this->app->runningInConsole()) {
            $this->registerPublishableResources();
            $this->registerConsoleCommands();
        }

    }

    /**
     * Bootstrap the application services.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router, Dispatcher $event)
    {

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ucenter');

        $router->aliasMiddleware('admin.member', MemberMiddleware::class);
        $router->aliasMiddleware('auth.api', EnsureFrontendRequestsAreStateful::class);

    }

    /**
     * Register the publishable files.
     */
    private function registerPublishableResources()
    {
        $publishablePath = dirname(__DIR__).'/publishable';

        $publishable = [
            'dummy_seeds' => [
                "{$publishablePath}/database/seeds/" => database_path(Seed::getFolderName()),
            ],
//            'dummy_content' => [
//                "{$publishablePath}/dummy_content/" => storage_path('app/public'),
//            ],
//            'dummy_config' => [
//                "{$publishablePath}/config/admin_dummy.php" => config_path('admin.php'),
//            ],
            'dummy_migrations' => [
                "{$publishablePath}/database/migrations/" => database_path('migrations'),
            ],

        ];

        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }

    public function registerConfigs()
    {
//        $this->mergeConfigFrom(
//            dirname(__DIR__).'/../publishable/config/admin_dummy.php',
//            'portal'
//        );
    }

    /**
     * Load helpers.
     */
    protected function loadHelpers()
    {
        foreach (glob(__DIR__.'/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }


    /**
     * Register the commands accessible from the Console.
     */
    private function registerConsoleCommands()
    {
        $this->commands(Commands\InstallCommand::class);
    }
}
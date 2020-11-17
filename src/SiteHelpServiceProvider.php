<?php

namespace Qihucms\SiteHelp;

use Illuminate\Support\ServiceProvider;

class SiteHelpServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'site-help');
        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/site-help'),
        ]);
    }
}

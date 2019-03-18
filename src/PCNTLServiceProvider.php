<?php

namespace Savin\PCNTL;

use Illuminate\Support\ServiceProvider;

class PCNTLServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'savin');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // Register the service the package provides.
        $this->app->singleton('savin.pcntl', function ($app) {
            return new PCNTL;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['savin.pcntl'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {

        // Publishing the translation files.
        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/savin'),
        ], 'savin.pcntl.lang');

    }
}

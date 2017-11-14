<?php

namespace Selfreliance\Balance;

use Illuminate\Support\ServiceProvider;

class BalanceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        include __DIR__.'/routes.php';
        $this->app->make('Selfreliance\Balance\BalanceController');
        $this->loadViewsFrom(__DIR__.'/views', 'balance');

        $this->publishes([
            __DIR__.'/js/' => public_path('vendor/balance'),
        ], 'assets');
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
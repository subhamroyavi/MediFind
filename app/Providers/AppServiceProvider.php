<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // if (request()->getHost() === 'localhost') {
        //     // Localhost settings
        //     Config::set('app.env', 'local');
        //     Config::set('app.debug', true);
        //     Config::set('database.connections.mysql.host', '127.0.0.1');
        //     Config::set('database.connections.mysql.port', '3306');
        //     Config::set('database.connections.mysql.database', 'medifind');
        //     Config::set('database.connections.mysql.username', 'root');
        //     Config::set('database.connections.mysql.password', '');
        // } else {
        //     // Railway (Production) settings
        //     Config::set('app.env', 'production');
        //     Config::set('app.debug', false);
        //     Config::set('database.connections.mysql.host', 'yamabiko.proxy.rlwy.net');
        //     Config::set('database.connections.mysql.port', '38233');
        //     Config::set('database.connections.mysql.database', 'railway');
        //     Config::set('database.connections.mysql.username', 'root');
        //     Config::set('database.connections.mysql.password', 'FqxmygqLUZwProxNlZSxKQwpDsmqIkGA');
        // }
    }
}

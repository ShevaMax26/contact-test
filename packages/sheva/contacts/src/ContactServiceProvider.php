<?php

namespace Sheva\Contacts;

use Sheva\Cart\Contracts\CartsStorage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ContactServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/contacts.php', 'contacts');
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->configureRoutes();
    }

    protected function configureRoutes(): void
    {
        Route::group([
            'domain' => config('contacts.domain'),
            'prefix' => config('contacts.prefix'),
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/contacts.php');
        });
    }
}

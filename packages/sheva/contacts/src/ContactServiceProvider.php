<?php

namespace Sheva\Contacts;

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
        $this->configureRoutes();
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    protected function configureRoutes(): void
    {
        Route::group([
            'prefix' => config('contacts.prefix'),
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/contacts.php');
        });
    }
}

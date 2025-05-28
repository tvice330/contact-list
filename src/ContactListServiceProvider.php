<?php

namespace Tvice\ContactList;

use Illuminate\Support\ServiceProvider;
use Tvice\ContactList\Services\ContactService;
use function Tvice\ContactList\Providers\database_path;
use function Tvice\ContactList\Providers\public_path;
use function Tvice\ContactList\Providers\resource_path;

class ContactListServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('contact-list', function () {
            return new ContactService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../src/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../src/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'contact-list');

        $this->publishes([
            __DIR__ . '/../src/database/seeders' => $this->app->databasePath('seeders'),
        ], 'contact-list-seeders');
        $this->publishes([
            __DIR__ . '/../dist' => $this->app->publicPath('vendor/tvice/contact-list/dist'),
        ], 'public');
    }
}
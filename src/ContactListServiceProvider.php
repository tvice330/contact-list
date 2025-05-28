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
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'contact-list');
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/contact-list'),
        ]);
        $this->publishes([
            __DIR__.'/../Database/migrations' => database_path('migrations'),
        ], 'migrations');
        $this->publishes([
            __DIR__.'/../Database/seeders' => database_path('seeders'),
        ], 'seeders');
        $this->publishes([
            __DIR__.'/../../dist' => public_path('vendor/tvice/contact-list/dist'),
        ], 'public');
    }
}
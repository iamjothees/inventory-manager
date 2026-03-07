<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private $domains;
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
        $this->domains = collect([
            'Address',
            'Location',
        ]);
        $this->domains->each(function ($domain) {
            $this->loadMigrationsFrom(__DIR__ . "/../{$domain}/Database/Migrations");
        });
        Relation::morphMap([
            'user' => \App\Models\User::class,
            'location' => \App\Models\Location::class,
        ]);
    }
}

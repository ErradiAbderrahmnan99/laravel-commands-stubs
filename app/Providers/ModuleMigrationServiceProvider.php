<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleMigrationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $modules = [
            'Commande',
        ];

        foreach ($modules as $module) {
            $this->loadMigrationsFrom(base_path("Modules/{$module}/database/migrations"));
        }
    }
}

<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Factory::guessFactoryNamesUsing(function (string $modelName) {
            $modelBasename = class_basename($modelName);

            // Assuming Modules are in the base_path('Modules') directory
            $modulesPath = base_path('Modules');

            // Scan through the Modules directory to find the correct module
            foreach (File::directories($modulesPath) as $modulePath) {
                $moduleName = pathinfo($modulePath, PATHINFO_FILENAME);
                $factoryClass = "Modules\\Commande\\Database\\Factories\\{$modelBasename}\\{$modelBasename}Factory";

                // Check if the factory class exists
                if (class_exists($factoryClass)) {
                    return $factoryClass;
                }
            }

            // If no matching factory is found, handle it gracefully
            throw new \Exception("No factory found for model {$modelName}");
        });
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateModuleRoute extends Command
{
    protected $signature = 'make:module-route {module} {name} {route_name} {folderName?}';
    protected $description = 'Create a new route file in the specified module and optionally in a folder';

    public function handle()
    {
        $module = $this->argument('module');
        $name = $this->argument('name');
        $routeName = $this->argument('route_name');
        $folderName = $this->argument('folderName');

        $routePath = base_path("Modules/{$module}/Routes");

        if ($folderName) {
            $routePath .= "/{$folderName}";
        }

        $routePath .= "/{$name}.php";

        if (File::exists($routePath)) {
            $this->error("Route file for {$name} already exists in module {$module}.");
            return;
        }

        $stub = File::get(base_path('resources/stubs/module.sub-route.stub'));

        // Determine namespace based on folderName
        $namespace = "Modules\\{$module}\\Controllers";
        if ($folderName) {
            $namespace .= "\\{$folderName}";
        }

        // Replace placeholders in the stub
        $stub = str_replace(
            ['{{ module }}', '{{ name }}', '{{ route_name }}', '{{ namespace }}'],
            [$module, $name, $routeName, $namespace],
            $stub
        );

        // Ensure the directory exists
        File::ensureDirectoryExists(dirname($routePath));

        // Create the route file
        File::put($routePath, $stub);

        $this->info("Route file for {$name} created successfully in module {$module}" . ($folderName ? " in folder {$folderName}" : "") . ".");
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateModuleController extends Command
{
    protected $signature = 'make:module-controller {module} {name} {folderName?}';
    protected $description = 'Create a new controller in the specified module and optionally in a folder';

    public function handle()
    {
        $module = $this->argument('module');
        $name = $this->argument('name');
        $folderName = $this->argument('folderName');

        $controllerName = $name . 'Controller';
        $controllerPath = base_path("Modules/{$module}/Controllers");

        if ($folderName) {
            $controllerPath .= "/{$folderName}";
        }

        $controllerPath .= "/{$controllerName}.php";

        if (File::exists($controllerPath)) {
            $this->error("Controller {$controllerName} already exists in module {$module}.");
            return;
        }

        $stub = File::get(base_path('resources/stubs/module.controller.stub'));

        // Replace placeholders in the stub
        $stub = str_replace(
            ['{{ namespace }}', '{{ name }}'],
            ["Modules\\{$module}\\Controllers" . ($folderName ? "\\{$folderName}" : ""), $name],
            $stub
        );

        // Ensure the directory exists
        File::ensureDirectoryExists(dirname($controllerPath));

        // Create the controller file
        File::put($controllerPath, $stub);

        $this->info("Controller {$controllerName} created successfully in module {$module}" . ($folderName ? " in folder {$folderName}" : "") . ".");
    }
}

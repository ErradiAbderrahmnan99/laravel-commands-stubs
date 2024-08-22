<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateModuleFactory extends Command
{
    protected $signature = 'make:module-factory {module} {name} {folderName?}';
    protected $description = 'Create a new factory in the specified module and optionally in a folder';

    public function handle()
    {
        $module = $this->argument('module');
        $name = $this->argument('name');
        $folderName = $this->argument('folderName');

        $factoryName = $name . 'Factory';
        $factoryPath = base_path("Modules/{$module}/database/factories");

        if ($folderName) {
            $factoryPath .= "/{$folderName}";
        }

        $factoryPath .= "/{$factoryName}.php";

        if (File::exists($factoryPath)) {
            $this->error("Factory {$factoryName} already exists in module {$module}.");
            return;
        }

        $stub = File::get(base_path('resources/stubs/module.factory.stub'));

        // Determine the namespace and model import based on folderName
        $namespace = "Modules\\{$module}\\database\\factories";
        if ($folderName) {
            $namespace .= "\\{$folderName}";
        }

        $modelImport = "Modules\\{$module}\\Models";
        if ($folderName) {
            $modelImport .= "\\{$folderName}";
        }
        $modelImport .= "\\{$name}";

        // Replace placeholders in the stub
        $stub = str_replace(
            ['{{ namespace }}', '{{ modelImport }}', '{{ modelName }}', '{{ factoryName }}'],
            [$namespace, $modelImport, $name, $factoryName],
            $stub
        );

        // Ensure the directory exists
        File::ensureDirectoryExists(dirname($factoryPath));

        // Create the factory file
        File::put($factoryPath, $stub);

        $this->info("Factory {$factoryName} created successfully in module {$module}" . ($folderName ? " in folder {$folderName}" : "") . ".");
    }
}

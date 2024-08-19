<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateModuleFactory extends Command
{
    protected $signature = 'make:module-factory {module} {name}';
    protected $description = 'Create a new factory in the specified module';

    public function handle()
    {
        $module = $this->argument('module');
        $name = $this->argument('name');
        $factoryName = $name . 'Factory';
        $factoryPath = base_path("Modules/{$module}/database/factories/{$factoryName}.php");

        if (File::exists($factoryPath)) {
            $this->error("Factory {$factoryName} already exists in module {$module}.");
            return;
        }

        $stub = File::get(base_path('resources/stubs/module.factory.stub'));

        // Replace placeholders in the stub
        $stub = str_replace(
            ['{{ namespace }}', '{{ module }}', '{{ factoryName }}', '{{ modelName }}'],
            ["Modules\\{$module}\\database\\factories", $module,  $factoryName, $name],
            $stub
        );

        // Ensure the directory exists
        File::ensureDirectoryExists(dirname($factoryPath));

        // Create the factory file
        File::put($factoryPath, $stub);

        $this->info("Factory {$factoryName} created successfully in module {$module}.");
    }
}

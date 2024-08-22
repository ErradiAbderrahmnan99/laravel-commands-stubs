<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateModuleModels extends Command
{
    protected $signature = 'make:module-model {module} {name} {folderName?}';
    protected $description = 'Create a new model in the specified module and optionally in a folder';

    public function handle()
    {
        $module = $this->argument('module');
        $name = $this->argument('name');
        $folderName = $this->argument('folderName');

        $modelPath = base_path("Modules/{$module}/Models");

        if ($folderName) {
            $modelPath .= "/{$folderName}";
        }

        $modelPath .= "/{$name}.php";

        if (File::exists($modelPath)) {
            $this->error("Model {$name} already exists in module {$module}.");
            return;
        }

        $stub = File::get(base_path('resources/stubs/module.model.stub'));

        // Replace placeholders in the stub
        $stub = str_replace(
            ['{{ namespace }}', '{{ name }}', '{{ table }}'],
            ["Modules\\{$module}\\Models" . ($folderName ? "\\{$folderName}" : ""), $name, Str::snake($name)],
            $stub
        );

        // Ensure the directory exists
        File::ensureDirectoryExists(dirname($modelPath));

        // Create the model file
        File::put($modelPath, $stub);

        $this->info("Model {$name} created successfully in module {$module}" . ($folderName ? " in folder {$folderName}" : "") . ".");
    }
}

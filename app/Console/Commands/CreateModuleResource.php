<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateModuleResource extends Command
{
    protected $signature = 'make:module-resource {module} {name} {folderName?}';
    protected $description = 'Create a new resource in the specified module and optionally in a folder';

    public function handle()
    {
        $module = $this->argument('module');
        $name = $this->argument('name');
        $folderName = $this->argument('folderName');

        // Construct the file path
        $resourcePath = base_path("Modules/{$module}/Http/Resources");
        if ($folderName) {
            $resourcePath .= "/{$folderName}";
        }
        $resourcePath .= "/{$name}Resource.php";

        // Check if the file already exists
        if (File::exists($resourcePath)) {
            $this->error("Resource {$name}Resource already exists in module {$module}.");
            return;
        }

        // Get the stub content
        $stub = File::get(base_path('resources/stubs/module.resource.stub'));

        // Replace placeholders in the stub
        $stub = str_replace(
            ['{{ namespace }}', '{{ name }}'],
            ["Modules\\{$module}\\Http\\Resources" . ($folderName ? "\\{$folderName}" : ""), $name],
            $stub
        );

        // Ensure the directory exists
        File::ensureDirectoryExists(dirname($resourcePath));

        // Create the resource file
        File::put($resourcePath, $stub);

        $this->info("Resource {$name}Resource created successfully in module {$module}" . ($folderName ? " in folder {$folderName}" : "") . ".");
    }
}

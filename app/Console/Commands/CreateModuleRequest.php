<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateModuleRequest extends Command
{
    protected $signature = 'make:module-request {module} {name} {folderName?}';
    protected $description = 'Create a new request in the specified module and optionally in a folder';

    public function handle()
    {
        $module = $this->argument('module');
        $name = $this->argument('name');
        $folderName = $this->argument('folderName');

        // Construct the file path
        $requestPath = base_path("Modules/{$module}/Requests");
        if ($folderName) {
            $requestPath .= "/{$folderName}";
        }
        $requestPath .= "/{$name}Request.php";

        // Check if the file already exists
        if (File::exists($requestPath)) {
            $this->error("Request {$name}Request already exists in module {$module}.");
            return;
        }

        // Get the stub content
        $stub = File::get(base_path('resources/stubs/module.request.stub'));

        // Replace placeholders in the stub
        $stub = str_replace(
            ['{{ namespace }}', '{{ name }}'],
            ["Modules\\{$module}\\Requests" . ($folderName ? "\\{$folderName}" : ""), $name],
            $stub
        );

        // Ensure the directory exists
        File::ensureDirectoryExists(dirname($requestPath));

        // Create the request file
        File::put($requestPath, $stub);

        $this->info("Request {$name}Request created successfully in module {$module}" . ($folderName ? " in folder {$folderName}" : "") . ".");
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateModuleSeeder extends Command
{
    protected $signature = 'make:module-seeder {module} {name} {folderName?}';
    protected $description = 'Create a new seeder in the specified module and optionally in a folder';

    public function handle()
    {
        $module = $this->argument('module');
        $name = $this->argument('name');
        $folderName = $this->argument('folderName');

        $seederName = $name . 'Seeder';
        $seederPath = base_path("Modules/{$module}/database/seeders");

        if ($folderName) {
            $seederPath .= "/{$folderName}";
        }

        $seederPath .= "/{$seederName}.php";

        if (File::exists($seederPath)) {
            $this->error("Seeder {$seederName} already exists in module {$module}.");
            return;
        }

        $modelImport = "Modules\\{$module}\\Models";
        if ($folderName) {
            $modelImport .= "\\{$folderName}";
        }
        $modelImport .= "\\{$name}";

        $stub = File::get(base_path('resources/stubs/module.seeder.stub'));

        // Replace placeholders in the stub
        $stub = str_replace(
            ['{{ namespace }}', '{{ modelImport }}', '{{ seederName }}', '{{ modelName }}'],
            ["Modules\\{$module}\\database\\seeders" . ($folderName ? "\\{$folderName}" : ""), $modelImport, $seederName, $name],
            $stub
        );

        // Ensure the directory exists
        File::ensureDirectoryExists(dirname($seederPath));

        // Create the seeder file
        File::put($seederPath, $stub);

        $this->info("Seeder {$seederName} created successfully in module {$module}" . ($folderName ? " in folder {$folderName}" : "") . ".");
    }
}

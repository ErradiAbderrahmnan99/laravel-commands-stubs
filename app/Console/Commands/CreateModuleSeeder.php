<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateModuleSeeder extends Command
{
    protected $signature = 'make:module-seeder {module} {name}';
    protected $description = 'Create a new seeder in the specified module';

    public function handle()
    {
        $module = $this->argument('module');
        $name = $this->argument('name');
        $seederName = $name . 'Seeder';
        $seederPath = base_path("Modules/{$module}/database/seeders/{$seederName}.php");

        if (File::exists($seederPath)) {
            $this->error("Seeder {$seederName} already exists in module {$module}.");
            return;
        }

        $stub = File::get(base_path('resources/stubs/module.seeder.stub'));

        // Replace placeholders in the stub
        $stub = str_replace(
            ['{{ namespace }}', '{{ module }}', '{{ seederName }}', '{{ modelName }}'],
            ["Modules\\{$module}\\database\\seeders", $module , $seederName, $name],
            $stub
        );

        // Ensure the directory exists
        File::ensureDirectoryExists(dirname($seederPath));

        // Create the seeder file
        File::put($seederPath, $stub);

        $this->info("Seeder {$seederName} created successfully in module {$module}.");
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateModuleMigration extends Command
{
    protected $signature = 'make:module-migration {module} {name}';
    protected $description = 'Create a new migration in the specified module';

    public function handle()
    {
        $module = $this->argument('module');
        $name = $this->argument('name');
        $timestamp = date('Y_m_d_His');
        $migrationName = $timestamp . '_' . Str::snake($name);
        $migrationPath = base_path("Modules/{$module}/database/Migrations/{$migrationName}.php");

        if (File::exists($migrationPath)) {
            $this->error("Migration {$migrationName} already exists in module {$module}.");
            return;
        }

        $stub = File::get(base_path('resources/stubs/module.migration.stub'));

        // Replace placeholders in the stub
        $stub = str_replace(
            ['{{ namespace }}', '{{ className }}', '{{ tableName }}'],
            ["Modules\\{$module}\\database\\Migrations", Str::studly($name), Str::snake($name)],
            $stub
        );

        // Ensure the directory exists
        File::ensureDirectoryExists(dirname($migrationPath));

        // Create the migration file
        File::put($migrationPath, $stub);

        $this->info("Migration {$migrationName} created successfully in module {$module}.");
    }
}
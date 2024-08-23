<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class CreateModules extends Command
{
    protected $signature = 'module {name?}';
    protected $description = 'Create Modules for the application under the Modules directory.';

    public function handle(): void
    {
        $name = $this->argument('name');

        if ($name === null) {
            $name = $this->ask('What\'s the name of the module?');
        }

        $dirs = [
            'Controllers',
            'Models',
            'Requests',
            'Resources',
            'routes',
            'Providers',
            'database/migrations',
            'database/seeders',
            'database/factories',
            'Tests',
        ];

        $fs = new Filesystem();
        $modulePath = base_path('Modules/' . $name);

        if ($fs->exists($modulePath)) {
            $this->error('This module already exists');
            return;
        }

        foreach ($dirs as $dir) {
            $fs->ensureDirectoryExists($modulePath . '/' . $dir, 0755, true);
        }

        // Create stub files
        $this->createStubFiles($name);

        $this->info('Module created successfully!');
    }

    protected function createStubFiles(string $name): void
    {
        $fs = new Filesystem();
        $stubPath = resource_path('stubs');
        $modulePath = base_path('Modules/' . $name);

        $stubs = [
            'module.main-seeder.stub' => 'database/seeders/' . $name . 'Seeder.php',
            'module.route.stub' => 'routes/api.php',
            'module.config.stub' => 'config.php',
        ];

        foreach ($stubs as $stub => $destination) {
            $content = $fs->get($stubPath . '/' . $stub);
            $content = str_replace('{{ ModuleName }}', $name, $content);

            $fs->put($modulePath . '/' . $destination, $content);
        }
    }
}

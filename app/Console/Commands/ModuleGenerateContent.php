<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ModuleGenerateContent extends Command
{
    protected $signature = 'module:generate {module} {name} {route_name?} {folderName?}';
    protected $description = 'Generate all module-related files';

    public function handle()
    {
        $module = $this->argument('module');
        $name = $this->argument('name');
        $routeName = $this->argument('route_name');
        $folderName = $this->argument('folderName');

        // Call the commands
        $this->call('make:module-controller', [
            'module' => $module,
            'name' => $name,
            'folderName' => $folderName
        ]);

        $this->call('make:module-factory', [
            'module' => $module,
            'name' => $name,
            'folderName' => $folderName
        ]);

        $this->call('make:module-migration', [
            'module' => $module,
            'name' => $name,
            'folderName' => $folderName
        ]);

        $this->call('make:module-model', [
            'module' => $module,
            'name' => $name,
            'folderName' => $folderName
        ]);

        $this->call('make:module-route', [
            'module' => $module,
            'name' => $name,
            'route_name' => $routeName,
            'folderName' => $folderName
        ]);

        $this->call('make:module-seeder', [
            'module' => $module,
            'name' => $name,
            'folderName' => $folderName
        ]);

        $this->info('All module-related files have been generated successfully.');
    }

}

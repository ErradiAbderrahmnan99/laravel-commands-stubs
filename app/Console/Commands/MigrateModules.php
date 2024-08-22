<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Console\Migrations\MigrateCommand;
use Illuminate\Support\Facades\Artisan;

class MigrateModules extends Command
{
    protected $signature = 'migrate:modules';
    protected $description = 'Run migrations for all modules';

    //If you don't use ModuleMigrationServiceProvider
    //    public function handle()
    //    {
    //        $modules = [
    //            'SMQ',
    //        ];
    //
    //        foreach ($modules as $module) {
    //            $this->info("Migrating module: {$module}");
    //            Artisan::call('migrate:fresh', ['--path' => "Modules/{$module}/Database/Migrations"]);
    //            $this->info(Artisan::output());
    //        }
    //
    //        $this->info('Migrations completed for all modules.');
    //    }

    public function handle()
    {
        $this->info("Running module migrations...");

        // Run the standard Laravel migrate command
        Artisan::call('migrate:fresh');

        $this->info(Artisan::output());

        $this->info("Module migrations completed.");
    }
}

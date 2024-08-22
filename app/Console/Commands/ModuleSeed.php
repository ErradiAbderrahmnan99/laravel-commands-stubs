<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Command;

class ModuleSeed extends Command
{
    protected $signature = 'module:seed {module} {--class=}';
    protected $description = 'Run database seeders for a specific module';

    public function handle()
    {
        $module = $this->argument('module');
        $class = $this->option('class');

        if ($class) {
            $seederClass = "Modules\\{$module}\\Database\\Seeders\\{$class}";
        } else {
            $seederClass = "Modules\\{$module}\\Database\\Seeders\\DatabaseSeeder";
        }

        if (!class_exists($seederClass)) {
            $this->error("Seeder class [{$seederClass}] does not exist.");
            return;
        }

        Artisan::call('db:seed', [
            '--class' => $seederClass,
        ]);

        $this->info("Seeder [{$seederClass}] has been run.");
    }
}

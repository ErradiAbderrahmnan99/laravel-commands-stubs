<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateCommande extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:commande';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Commande model, controller, migration, and seeder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Run the Artisan commands to generate model, controller, migration, and seeder
        $this->call('make:model', ['name' => 'Commande', '-mfs' => true]);
        $this->call('make:controller', ['name' => 'CommandeController', '--resource' => true]);
        $this->call('make:seeder', ['name' => 'CommandeSeeder']);

        $this->info('Commande model, controller, migration, and seeder generated successfully!');
    }
}

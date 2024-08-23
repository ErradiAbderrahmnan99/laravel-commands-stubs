<?php

namespace Modules\Commande\database\seeders\Type;

use Illuminate\Database\Seeder;
use Modules\Commande\Models\Type\TypeCommande;

class TypeCommandeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Insert seed data here
        // Example:
        TypeCommande::factory()->count(10)->create();
    }
}

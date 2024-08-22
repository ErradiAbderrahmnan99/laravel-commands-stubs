<?php

namespace Modules\SMQ\database\seeders\Nature;

use Illuminate\Database\Seeder;
use Modules\SMQ\Models\Nature\Nature;

class NatureSeeder extends Seeder
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
         Nature::factory()->count(10)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Commande\database\seeders\Type\TypeCommandeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $moduleSeeders = [
            'Commande' => true,
        ];

        foreach ($moduleSeeders as $moduleName => $isActive) {
            if ($isActive) {
                $seederClass = "Modules\\$moduleName\\Database\\Seeders\\{$moduleName}Seeder";

                if (class_exists($seederClass)) {
                    $this->call($seederClass);
                } else {
                    $this->command->warn("Seeder class $seederClass not found.");
                }
            }
        }
    }
}

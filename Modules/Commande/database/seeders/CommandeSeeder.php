<?php

namespace Modules\Commande\database\seeders;
use Illuminate\Database\Seeder;
use Modules\Commande\database\seeders\Type\TypeCommandeSeeder;

class CommandeSeeder extends Seeder {

    public function run(){
        $this->call(
            TypeCommandeSeeder::class
        );
    }

}

<?php

namespace Modules\Commande\database\factories\Type;

use Modules\Commande\Models\Type\TypeCommande;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TypeCommande>
 */
class TypeCommandeFactory extends Factory
{
    protected $model = TypeCommande::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}

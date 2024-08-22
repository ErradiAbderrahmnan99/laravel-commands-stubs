<?php

namespace Modules\SMQ\database\factories\Nature;

use Modules\SMQ\Models\Nature\Nature;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Nature>
 */
class NatureFactory extends Factory
{
    protected $model = Nature::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
        ];
    }
}

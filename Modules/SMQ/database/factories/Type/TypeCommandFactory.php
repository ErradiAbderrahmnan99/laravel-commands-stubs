<?php

namespace Modules\SMQ\database\factories\Type;

use Modules\SMQ\Models\Type\TypeCommand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TypeCommand>
 */
class TypeCommandFactory extends Factory
{
    protected $model = TypeCommand::class;

    public function definition(): array
    {
        return [
            // Define your model's attributes here
        ];
    }
}

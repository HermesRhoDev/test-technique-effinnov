<?php

namespace Database\Factories;

use App\Core\Inventory\Enums\ComponentType;
use App\Models\Component;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComponentFactory extends Factory
{
    protected $model = Component::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'reference' => $this->faker->unique()->bothify('REF-####'),
            'price' => $this->faker->randomFloat(2, 0.1, 100),
            'stock' => $this->faker->numberBetween(0, 100),
            'type' => ComponentType::RESISTOR,
            'specifications' => [],
        ];
    }
}

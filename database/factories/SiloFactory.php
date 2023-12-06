<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Silo>
 */
class SiloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $capacityTotal = $this->faker->randomFloat(2, 100, 1000);
        $currentCapacity = $this->faker->randomFloat(2, 0, $capacityTotal);
        $usedCapacity = $capacityTotal - $currentCapacity;
        return [
            'name' => 'silo_'.$this->faker->randomNumber(2),
            'capacity_total' => $capacityTotal,
            'unit_of_measure' => 'ton',
            'current_capacity' => $currentCapacity,
            'used_capacity' => $usedCapacity,
        ];
    }
}

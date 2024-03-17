<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'id_price_list' => $this->faker->numberBetween(1,5),
            'name'  => $this->faker->name,
            'color' => $this->faker->randomElement($array = ['Dark Grey', 'Black']),
            'status' => $this->faker->randomElement($array = ['Belum Lunas', 'Lunas']),

        ];
    }
}
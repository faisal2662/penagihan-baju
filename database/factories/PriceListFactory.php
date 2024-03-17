<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PriceLists>
 */
class PriceListFactory extends Factory
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
            'size' => $this->faker->randomElement($array =['S','M','L','XL']),
            'price' => $this->faker->randomFloat(2,1,100),
            'price_sale' => $this->faker->randomFloat(2,1,100),
        ];
    }
}
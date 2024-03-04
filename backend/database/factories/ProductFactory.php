<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->paragraph,
            'available' => $this->faker->boolean,
            'rate' => $this->faker->randomFloat(1, 1, 5),
            'quantity' => $this->faker->numberBetween(0, 100),
            'seller_id' => $this->faker->numberBetween(1, 2),
            'img2' => $this->faker->imageUrl(),
            'img3' => $this->faker->imageUrl(),
            'img4' => $this->faker->imageUrl(),
        ];
    }
}

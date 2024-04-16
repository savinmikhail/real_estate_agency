<?php

namespace Database\Factories;

use App\Models\Basket;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class BasketProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'basket_id' => Basket::query()->inRandomOrder()->first()->id,
            'product_id' => Product::query()->inRandomOrder()->first()->id,
            'quantity' => $this->faker->numberBetween(1, 10),
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\Basket;
use Illuminate\Database\Seeder;

class BasketSeeder extends Seeder
{
    public function run(): void
    {
        Basket::factory(100)->create();
    }
}

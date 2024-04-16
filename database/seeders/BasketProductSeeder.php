<?php

namespace Database\Seeders;

use App\Models\BasketProduct;
use Illuminate\Database\Seeder;

class BasketProductSeeder extends Seeder
{
    public function run(): void
    {
        BasketProduct::factory(100)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\OrderProduct;
use Illuminate\Database\Seeder;

class OrderProductSeeder extends Seeder
{
    public function run(): void
    {
        OrderProduct::factory(100)->create();
    }
}

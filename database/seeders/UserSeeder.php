<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => fake()->name(),
            'email' => 'demo@demo.com',
            'email_verified_at' => now(),
            'password' => Hash::make('demodemo'),
            'remember_token' => Str::random(10),
        ]);
        User::factory(10)->create();
    }

}

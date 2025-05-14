<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 4; $i++) {
            User::create([
                'name'              => $faker->name,
                'username'          => $faker->userName . $i,
                'email'             => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'), // password default
                'remember_token'    => Str::random(10),
                'role'              => 'user',
            ]);
        }
    }
}
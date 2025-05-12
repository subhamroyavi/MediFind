<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Service;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 20; $i++) {

            // User::create([

            //     //for faker data
            //     'first_name' =>  $faker->firstName,
            //     'last_name' => $faker->lastName,
            //     'email' => $faker->unique()->safeEmail,
            //     'phone' => $faker->numerify('##########'),
            //     'password' => Hash::make('password'),
            //     'status' => $faker->boolean,
            // ]);

            Service::create([
                'service_name' => $faker->firstName
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User_Profile;

class Users_ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

   
        for ($i = 0; $i < 10; $i++) {
            User_Profile::create([
                'profile__picture' => 'img.jpg',
                'user_id' => $faker->randomElement(\App\Models\User::all()->pluck('id')->toArray())
            ]);
        }
    }
}

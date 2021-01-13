<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker = \Faker\Factory::create();

        // Let's make sure everyone has the same password and
        // let's hash it before the loop, or else our seeder
        // will be too slow.
        $password = Hash::make('password');

        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => $password,
        ]);

        // And now let's generate a few dozen users for our app:
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $password,
                'country' => $faker->country,
                'gender' => 'male',
                'number' => $faker->phoneNumber,
                'username' => $faker->userName,
                'birth_date' => $faker->date($format = 'Y-m-d' , $max = 'now'),
                'institution_type' => $faker->word,
                'institution_name' => $faker->company,
                'department' => $faker->domainword,
                'faculty' => $faker->colorName,
                'education_level' => $faker->numberBetween($min = 100 , $max = 700),

            ]);
        }
    }
}

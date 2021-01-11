<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\User_Profile;
use Illuminate\Database\Seeder;

class Users_ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = \Faker\Factory::create();
        // make sure all 10 user have a profile picture
        function serialNumber(){
            for ($i=1; $i <= 9; $i++) {
                echo $i;
            }
            return $i;
        }

        for ($i=0; $i <= 10; $i++) {
            echo $i;
        }

        for ($i = 0; $i < 10; $i++) {
            User_Profile::create([
                'profile__picture' => 'https://placeimg.com/400/300/any?'.rand(20000, 90000),
                'user_id' => serialNumber()
            ]);
        }
    }
}

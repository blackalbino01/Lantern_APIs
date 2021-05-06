<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use App\Models\User_Media;
use App\Models\UserMedia;
class UserMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            UserMedia::create([
                'user_id' => rand(1, 10),
                'file' => 'https://placeimg.com/400/300/any?'.rand(20000, 90000),
                ]);
        }
    }
}

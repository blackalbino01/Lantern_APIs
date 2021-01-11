<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Advertisement;
class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        function generateRandomString(){
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-_';
            $result = '';
            for ($i = 0; $i < 11; $i++)
                $result .= $characters[mt_rand(0, 63)];
            return $result;
        }




        for ($i = 0; $i < 50; $i++) {
            Advertisement::create([
                'imageUrl' => 'https://placeimg.com/400/300/any?'.rand(20000, 90000),
                'videoUrl' =>  "https://www.youtube.com/watch?v=".generateRandomString(),
                'advertDescription' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, officiis,
                              dolorem laborum repudiandae inventore'
                ]);
        }
    }
}

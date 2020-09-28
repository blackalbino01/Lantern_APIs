<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Relationship;

class RelationshipTableSeeder extends Seeder
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
            Relationship::create([
                'follower_id' => $faker->randomElement(\App\Models\User::all()->pluck('id')->toArray()),
                'followed_id' => $faker->randomElement(\App\Models\User::all()->pluck('id')->toArray())
            ]);
        }
    }
}

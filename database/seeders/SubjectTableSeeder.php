<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectTableSeeder extends Seeder
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
            Subject::create([
                'name' => $faker->company
            ]);
        }
    }
}

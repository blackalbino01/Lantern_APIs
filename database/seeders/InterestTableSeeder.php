<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interest;

class InterestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Interest::create([
    		'name' => 'volunteer',
    		'category_id' => 1
            ]);

    	Interest::create([
    		'name' => 'climate action',
    		'category_id' => 1
            ]);

    	Interest::create([
    		'name' => 'mentoring',
    		'category_id' => 1
            ]);

    	Interest::create([
    		'name' => 'public speaking',
    		'category_id' => 1
            ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Category::create([
    		'id' => '1',
    		'name' => 'interests'
    	]);

    	Category::create([
    		'id' => '2',
    		'name' => 'skills'
    	]);

    	Category::create([
    		'id' => '3',
    		'name' => 'subjects'
    	]);
        
    }
}

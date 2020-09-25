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
      
        

       
        for ($i = 0; $i < 10; $i++) {
            Category::create([
                'name' => Str::random(10)
            ]);
        }
    }
}

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

    	Subject::create([
    		'name' => 'science',
    		'category_id' => 3
            ]);

    	Subject::create([
    		'name' => 'art',
    		'category_id' => 3
            ]);

    	Subject::create([
    		'name' => 'commerce',
    		'category_id' => 3
            ]);

    	Subject::create([
    		'name' => 'tech',
    		'category_id' => 3
            ]);
    }
}

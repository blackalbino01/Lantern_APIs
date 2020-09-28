<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;
use App\Models\User;

class SkillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skill::create([
    		'name' => 'project management',
    		'category_id' => 2
            ]);

    	Skill::create([
    		'name' => 'graphics design',
    		'category_id' => 2
            ]);

    	Skill::create([
    		'name' => 'web development',
    		'category_id' => 2
            ]);

    	Skill::create([
    		'name' => 'digital marketing',
    		'category_id' => 2
            ]);
    }
}

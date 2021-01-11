<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            Blog::create([
                'user_id' => rand(1, 10),
                'title' => 'Lorem ipsum dolor sit amet.',
                'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nobis, perspiciatis sed? Hic, sapiente amet! Magnam quas reprehenderit, enim repellendus accusamus debitis voluptatibus a tenetur sequi laudantium amet dicta ratione eos assumenda voluptatum officia et. Assumenda aspernatur magni sint optio! Dignissimos praesentium maxime quod, esse odit iure saepe dolores rem facilis.'
                ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Advertisement;
use App\Models\UserMedia;
use App\Models\Book_Store;
use App\Models\Blog;




class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            Users_ProfileTableSeeder::class,
            BlogSeeder::class,
            BookStoreSeeder::class,
            CategoryTableSeeder::class,
            AdvertisementSeeder::class,
            InterestTableSeeder::class,
            RelationshipTableSeeder::class,
            SkillTableSeeder::class,
            SubjectTableSeeder::class,
            UserMediaSeeder::class,



        ]);

        //  User::factory(50)->create();
        //  Advertisement::factory(100)->create();
        //  UserMedia::factory(100)->create();
        //  Book_Store::factory(100)->create();
        //  Blog::factory(100)->create();


    }
}

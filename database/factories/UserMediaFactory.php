<?php

namespace Database\Factories;

use App\Models\UserMedia;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserMediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserMedia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function(){
                return User::all()->random();
            },
            'file' => $this->faker->regexify('^\w+.(jpg|png|gif|mp4|svg)$')
        ];
    }
}

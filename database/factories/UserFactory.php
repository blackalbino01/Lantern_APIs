<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'country' => $this->faker->country,
            'gender' => 'male',
            'number' => $this->faker->phoneNumber,
            'username' => $this->faker->userName,
            'birth_date' => $this->faker->date($format = 'Y-m-d' , $max = 'now'),
            'institution_type' => $this->faker->word,
            'institution_name' => $this->faker->company,
            'department' => $this->faker->domainword,
            'faculty' => $this->faker->colorName,
            'education_level' => $this->faker->numberBetween($min = 100 , $max = 700),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }
}

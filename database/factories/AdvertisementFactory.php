<?php

namespace Database\Factories;

use App\Models\Advertisement;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdvertisementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Advertisement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image' => $this->faker->imageUrl($width = 640, $height = 480),
            'video' => $this->faker->regexify('^\w+.(mp3|mp4)$'),
            'event' => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true)
        ];
    }
}

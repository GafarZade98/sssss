<?php

namespace Database\Factories;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

class TopicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Topic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'slug' => $this->faker->unique()->slug(10),
            'image' => "https://via.placeholder.com/300/".rand(222141, 422141),
            'keyword' => array('science','fantastic','romantic','sport', 'life')[rand(0, 4)],

        ];
    }
}

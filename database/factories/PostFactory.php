<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'title' => $this->faker->title,
            'slug' => $this->faker->unique()->slug(10),
            'keyword' => array('science','fantastic','romantic','sport', 'life')[rand(0, 4)],
            'description' => $this->faker->text(160),
            'content' => $this->faker->text(250),
            'file' => "https://via.placeholder.com/300/".rand(222141, 422141),
            'item_id' => Item::factory(),
            'topic_id' => Topic::factory(),
        ];
    }
}

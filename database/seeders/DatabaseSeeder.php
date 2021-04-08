<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Topic;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UsersTableSeeder::class]);
        Item::factory(4)->has(
            Post::factory(5)
        )->create();
        Topic::factory(6)->has(
            Post::factory(2)
        )->create();
    }
}

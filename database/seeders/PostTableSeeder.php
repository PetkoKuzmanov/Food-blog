<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory(10)->create();

        Post::get()->each(function ($post) { 
            $post->tags()->attach(
                Tag::get()->random(rand(1, 3))->pluck('id')->toArray()
            ); 
        });

    }
}

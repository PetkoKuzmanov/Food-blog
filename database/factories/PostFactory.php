<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
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
            //
            'title' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
            'content' => $this->faker->text($maxNbChars = 100),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}

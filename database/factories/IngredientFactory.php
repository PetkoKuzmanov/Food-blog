<?php

namespace Database\Factories;

use App\Models\Ingredient;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ingredient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->word,
            'amount' => $this->faker->numberBetween($min = 1, $max = 50),
            'measurement' => $this->faker->word,
            'post_id' => Post::inRandomOrder()->first()->id,
        ];
    }
}

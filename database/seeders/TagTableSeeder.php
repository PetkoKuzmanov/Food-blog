<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // Tag::factory(30)->create();
        $tag1 = new Tag;
        $tag1->name = "Vegetarian";
        $tag1->save();

        $tag2 = new Tag;
        $tag2->name = "Vegan";
        $tag2->save();

        $tag3 = new Tag;
        $tag3->name = "Drinks";
        $tag3->save();

        $tag4 = new Tag;
        $tag4->name = "Soups";
        $tag4->save();

        $tag5 = new Tag;
        $tag5->name = "Meat and poultry";
        $tag5->save();

        $tag6 = new Tag;
        $tag6->name = "Pasta and noodles";
        $tag6->save();

        $tag7 = new Tag;
        $tag7->name = "Seafood";
        $tag7->save();

        $tag8 = new Tag;
        $tag8->name = "Healthy";
        $tag8->save();

        $tag9 = new Tag;
        $tag9->name = "Italian";
        $tag9->save();
    }
}

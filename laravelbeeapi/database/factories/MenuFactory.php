<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'title1'=>$this->faker->title(),
           'p'=>$this->faker->text(),
           'title'=>$this->faker->title(),
           'description'=>$this->faker->text(),
           'image'=>$this->faker->imageUrl(),
        ];
    }
}

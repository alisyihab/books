<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NovelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->name,
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident minus et ullam rerum, praesentium modi autem reiciendis molestias dolor nobis exercitationem at laudantium? Velit eos, sequi quae dolorem rem quis.",
            "price" => $this->faker->numberBetween($min = 15000, $max = 60000),
            "status" => $this->faker->numberBetween($min = 0, $max = 1)
        ];
    }
}

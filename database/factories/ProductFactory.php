<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'image' => 'https://source.unsplash.com/random' ,
            'description' => $this->faker->text(random_int(40 , 2500)),
            'price' => rand(1, 1000) / 10,
            'quantity' => random_int(0, 999)
        ];
    }
}

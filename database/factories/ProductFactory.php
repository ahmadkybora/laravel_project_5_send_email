<?php

namespace Database\Factories;

use App\Models\ProductCategory;
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
            'categoryId' => ProductCategory::factory()->create()->id,
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(0, 9),
            'description' => $this->faker->sentence(),
            'image' => null,
            'status' => 'ACTIVE'
        ];
    }
}

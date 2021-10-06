<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'brandId' => Brand::factory()->create()->id,
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'image' => null,
            'status' => 'ACTIVE'
        ];
    }
}

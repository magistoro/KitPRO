<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
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
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->sentence(4),
            'description' => $this->faker->text,
            'price' => floatval($this->faker->numberBetween(750,7800)),
            'image' => "default.jpg",
            'thumbnail' => "default.jpg",
            'items_in_stock' => $this->faker->numberBetween(0, 100),
            'category_id' => Category::inRandomOrder()->pluck('id')->first(),
            'type_id' => Type::inRandomOrder()->pluck('id')->first(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            // 'deleted_at' => null,
        ];
    }
}

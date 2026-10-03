<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->words(3, true);
        $price = $this->faker->numberBetween(10000, 250000);
        $hasDiscount = $this->faker->boolean(30);

        return [
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'name' => ucwords($name),
            'slug' => Str::slug($name) . '-' . Str::random(5),
            'sku' => 'SKU-' . strtoupper(Str::random(8)),
            'description' => $this->faker->paragraph(),
            'manufacturer' => $this->faker->company(),
            'price' => $price,
            'discount_price' => $hasDiscount ? $price - $this->faker->numberBetween(1000, 5000) : null,
            'stock' => $this->faker->numberBetween(0, 100),
            'image' => null,
            'requires_prescription' => $this->faker->boolean(20),
            'status' => 'active',
        ];
    }
}
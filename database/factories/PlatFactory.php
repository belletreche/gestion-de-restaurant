<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Plat;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlatFactory extends Factory
{
    protected $model = Plat::class;

    public function definition(): array
    {
        return [
            'nom' => fake()->unique()->word(),
            'prix' => fake()->randomFloat(2, 5, 150),
            'description' => fake()->sentence(),
            'categorie_id' => Category::factory(),
            'image' => 'plats/default.jpg',
        ];
    }
}

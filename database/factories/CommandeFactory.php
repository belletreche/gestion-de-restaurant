<?php

namespace Database\Factories;

use App\Models\Commande;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommandeFactory extends Factory
{
    protected $model = Commande::class;

    public function definition(): array
    {
        return [
            'client' => fake()->name(),
            'total' => fake()->randomFloat(2, 10, 500),
            'date_commande' => fake()->date(),
        ];
    }
}

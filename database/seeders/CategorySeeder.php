<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Entrées', 'description' => 'Les plats d\'entrée'],
            ['name' => 'Plats Principaux', 'description' => 'Les plats principaux du menu'],
            ['name' => 'Desserts', 'description' => 'Les desserts maison'],
            ['name' => 'Boissons', 'description' => 'Boissons chaudes et froides'],
            ['name' => 'Salades', 'description' => 'Salades fraîches et variées'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

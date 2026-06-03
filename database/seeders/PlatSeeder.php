<?php

namespace Database\Seeders;

use App\Models\Plat;
use Illuminate\Database\Seeder;

class PlatSeeder extends Seeder
{
    public function run(): void
    {
        $plats = [
            ['nom' => 'Salade César', 'prix' => 45.00, 'description' => 'Salade verte, parmesan, croûtons, sauce césar', 'categorie_id' => 5],
            ['nom' => 'Bourek', 'prix' => 25.00, 'description' => 'Brick à l\'œuf et au thon', 'categorie_id' => 1],
            ['nom' => 'Couscous Royal', 'prix' => 85.00, 'description' => 'Couscous avec légumes et viandes variées', 'categorie_id' => 2],
            ['nom' => 'Tajine Poulet', 'prix' => 65.00, 'description' => 'Tajine de poulet aux olives et citron confit', 'categorie_id' => 2],
            ['nom' => 'Mechouia', 'prix' => 30.00, 'description' => 'Salade de poivrons grillés', 'categorie_id' => 5],
            ['nom' => 'Baklawa', 'prix' => 35.00, 'description' => 'Pâtisserie orientale aux amandes et miel', 'categorie_id' => 3],
            ['nom' => 'Menthe Glacée', 'prix' => 12.00, 'description' => 'Boisson rafraîchissante à la menthe', 'categorie_id' => 4],
            ['nom' => 'Thé à la Menthe', 'prix' => 8.00, 'description' => 'Thé vert à la menthe fraîche', 'categorie_id' => 4],
            ['nom' => 'Crêpes Nutella', 'prix' => 28.00, 'description' => 'Crêpes fines garnies de Nutella', 'categorie_id' => 3],
            ['nom' => 'Chorba', 'prix' => 22.00, 'description' => 'Soupe traditionnelle algérienne', 'categorie_id' => 1],
        ];

        foreach ($plats as $plat) {
            Plat::create($plat);
        }
    }
}

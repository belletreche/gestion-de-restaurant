<?php

namespace Database\Seeders;

use App\Models\Commande;
use Illuminate\Database\Seeder;

class CommandeSeeder extends Seeder
{
    public function run(): void
    {
        $commandes = [
            ['client' => 'Ahmed Benali', 'total' => 130.00, 'date_commande' => '2025-01-15'],
            ['client' => 'Fatima Zohra', 'total' => 85.50, 'date_commande' => '2025-01-16'],
            ['client' => 'Mohamed Kerroum', 'total' => 220.00, 'date_commande' => '2025-01-17'],
            ['client' => 'Samira Bouchareb', 'total' => 65.00, 'date_commande' => '2025-01-18'],
            ['client' => 'Karim Mansouri', 'total' => 150.75, 'date_commande' => '2025-01-19'],
            ['client' => 'Lila Boumediene', 'total' => 95.00, 'date_commande' => '2025-01-20'],
            ['client' => 'Rachid Ouali', 'total' => 180.00, 'date_commande' => '2025-01-21'],
            ['client' => 'Nadia Hamdi', 'total' => 45.50, 'date_commande' => '2025-01-22'],
            ['client' => 'Youssef Amrani', 'total' => 300.00, 'date_commande' => '2025-01-23'],
            ['client' => 'Amina Sekkouri', 'total' => 112.25, 'date_commande' => '2025-01-24'],
        ];

        foreach ($commandes as $commande) {
            Commande::create($commande);
        }
    }
}

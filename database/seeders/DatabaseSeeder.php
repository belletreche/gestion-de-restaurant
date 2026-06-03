<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@restaurant.com',
        ]);

        $this->call([
            CategorySeeder::class,
            PlatSeeder::class,
            CommandeSeeder::class,
        ]);
    }
}

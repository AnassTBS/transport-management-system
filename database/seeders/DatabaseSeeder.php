<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    // database/seeders/DatabaseSeeder.php

    public function run(): void
    {
        // Trucks
        DB::table('trucks')->insert([
            ['matricule' => '12345-A-1', 'marque' => 'Mercedes', 'annee' => 2020, 'status' => 'disponible', 'created_at' => now(), 'updated_at' => now()],
            ['matricule' => '67890-B-2', 'marque' => 'Volvo',    'annee' => 2019, 'status' => 'en_route',   'created_at' => now(), 'updated_at' => now()],
            ['matricule' => '11223-C-3', 'marque' => 'Scania',   'annee' => 2021, 'status' => 'disponible', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Drivers
        DB::table('drivers')->insert([
            ['nom' => 'Hassan Alaoui',   'tel' => '0661234567', 'permis' => 'D-001', 'status' => 'actif', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Youssef Benali',  'tel' => '0662345678', 'permis' => 'D-002', 'status' => 'actif', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

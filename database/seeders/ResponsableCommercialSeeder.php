<?php

namespace Database\Seeders;

use App\Models\Commercial;
use Illuminate\Database\Seeder;

class ResponsableCommercialSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        Commercial::create([
            'nom' => "Responsable C1",
            'prenom' => "Responsable CP1",
            'contact' => "0546963368",
            'email' => "ResponsableC1@gmail.com",
            'isvalide' => 1,
            'photo' => null,
            'role' => 1,
            'identifiant' => "Rcommercial",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
    }
}
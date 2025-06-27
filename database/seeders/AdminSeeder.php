<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Adminvice;
use App\Models\Comptable;
use App\Models\Commercial;
use App\Models\Logistique;
use App\Models\Magasinier;
use Illuminate\Database\Seeder;

class AdminSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'nom' => "Admin 1",
            'prenom' => "Admin1P",
            'contact' => "0546963369",
            'email' => "admin1@gmail.com",
            'isvalide' => 1,
            'photo' => null,
            'identifiant' => "admin",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        
        Adminvice::create([
            'nom' => "Admin vice 1",
            'prenom' => "Admin vice P",
            'contact' => "0546963369",
            'email' => "Adminvice@gmail.com",
            'isvalide' => 1,
            'photo' => null,
            'identifiant' => "adminvice",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        Comptable::create([
            'nom' => "Comptable 1",
            'prenom' => "Comptable P",
            'contact' => "0546963369",
            'email' => "Comptable@gmail.com",
            'isvalide' => 1,
            'photo' => null,
            'identifiant' => "comptable",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        
        Commercial::create([
            'nom' => "Commercial 1",
            'prenom' => "Commercial P",
            'contact' => "0546963369",
            'email' => "Commercial@gmail.com",
            'isvalide' => 1,
            'photo' => null,
            'role' => 0,
            'identifiant' => "commercial",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        
        Magasinier::create([
            'nom' => "Magasinier 1",
            'prenom' => "Magasinier P",
            'contact' => "0546963369",
            'email' => "Magasinier@gmail.com",
            'isvalide' => 1,
            'photo' => null,
            'identifiant' => "magasinier",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        
        Logistique::create([
            'nom' => "Logistique 1",
            'prenom' => "Logistique P",
            'contact' => "0546963369",
            'email' => "Logistique@gmail.com",
            'isvalide' => 1,
            'photo' => null,
            'identifiant' => "logistique",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
    }
}
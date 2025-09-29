<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Adminvice;
use App\Models\Comptable;
use App\Models\Rpackauto;
use App\Models\Commercial;
use App\Models\Magasinier;
use App\Models\Rgeststock;
use App\Models\Secretaire;
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
            'role' => 1,
            'statut' => 1,
            'photo' => null,
            'connexion' => "admin",
            'identifiant' => "admin",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        
        Adminvice::create([
            'nom' => "Admin vice 1",
            'prenom' => "Admin vice P",
            'contact' => "0546963369",
            'email' => "Adminvice@gmail.com",
            'isvalide' => 1,
            'statut' => 0,
            'photo' => null,
            'connexion' => "adminvice",
            'identifiant' => "adminvice",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        Comptable::create([
            'nom' => "Comptable 1",
            'prenom' => "Comptable P",
            'contact' => "0546963369",
            'email' => "Comptable@gmail.com",
            'isvalide' => 1,
            'statut' => 0,
            'role' => 1,
            'photo' => null,
            'connexion' => "comptable",
            'identifiant' => "comptable",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        
        Commercial::create([
            'nom' => "Commercial 1",
            'prenom' => "Commercial P",
            'contact' => "0546963369",
            'email' => "Commercial@gmail.com",
            'premise' => null,
            'isvalide' => 1,
            'statut' => 0,
            'photo' => null,
            'role' => 0,
            'connexion' => "commercial",
            'identifiant' => "commercial",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        Commercial::create([
            'nom' => "Responsable C1",
            'prenom' => "Responsable CP1",
            'contact' => "0546963368",
            'email' => "ResponsableC1@gmail.com",
            'isvalide' => 1,
            'photo' => null,
            'role' => 1,
            'connexion' => "commercial",
            'identifiant' => "Rcommercial",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/ig', // password
        ]);
        
        Magasinier::create([
            'nom' => "Magasinier 1",
            'prenom' => "Magasinier P",
            'contact' => "0546963369",
            'email' => "Magasinier@gmail.com",
            'isvalide' => 1,
            'statut' => 0,
            'photo' => null,
            'connexion' => "magasinier",
            'identifiant' => "magasinier",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        
        Rgeststock::create([
            'nom' => "Gestionnaire 1",
            'prenom' => "Stock P",
            'contact' => "0546963369",
            'email' => "Rgeststock@gmail.com",
            'isvalide' => 1,
            'statut' => 0,
            'photo' => null,
            'connexion' => "geststock",
            'identifiant' => "geststock",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        
        Rpackauto::create([
            'nom' => "Pack 1",
            'prenom' => "Auto P",
            'contact' => "0546963369",
            'email' => "Rpackauto@gmail.com",
            'isvalide' => 1,
            'statut' => 0,
            'photo' => null,
            'connexion' => "packauto",
            'identifiant' => "packauto",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        
        Secretaire::create([
            'nom' => "Secretaire 1",
            'prenom' => "Secretaire P",
            'contact' => "0546963369",
            'email' => "Secretaire@gmail.com",
            'isvalide' => 1,
            'statut' => 0,
            'photo' => null,
            'connexion' => "secretaire",
            'identifiant' => "secretaire",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
    }
}
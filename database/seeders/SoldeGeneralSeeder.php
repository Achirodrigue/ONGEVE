<?php

namespace Database\Seeders;

use App\Models\Gsolde;
use Illuminate\Database\Seeder;

class SoldeGeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gsolde::create([
            'solde' => 0,
        ]);
    }
}

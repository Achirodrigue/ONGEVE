<?php

namespace App\Imports;

use App\Models\Produit;
use App\Models\Produitse;
use App\Models\Produitstat;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ListeProduitImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        // 1. Vérifiez que la ligne n'est pas vide avant de continuer
        if (empty($row[4])) {
            return null;
        }

        // 2. Créez le produit et stockez-le dans une variable
        $produit = new Produit([
            'nom' => $row[4],
            'description' => null,
            'prix' => null,
            'promo' => null,
            'stock' => 1,
            'qtyStock' => null,
            'qtyC' => null,
            'reference' => $row[3],
            'isvalide' => 1,
            'etat' => 1,
            'mvente' => 0,
            'TP' => 0,
            'TPF' => null,
            'famille' => $row[6],
            'entrepotcateg_id' => 1,
        ]);
        
        // 3. Sauvegardez le produit pour obtenir son ID
        $produit->save();

        // 4. Créez l'enregistrement dans la table Produitstat
        Produitstat::create([
            'stock_min' => 0,
            'entree' => 0,
            'sortie' => 0,
            'produit_id' => $produit->id, // Utilisez l'ID du produit nouvellement créé
        ]);

        // 5. Créez l'enregistrement dans la table Produitse
        Produitse::create([
            'quantite' => 0,
            'entree_sortie' => 1,
            'produit_id' => $produit->id, // Utilisez le même ID
        ]);
    }

    public function startRow(): int
    {
        return 4;
    }
}
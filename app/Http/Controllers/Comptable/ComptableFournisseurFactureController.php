<?php

namespace App\Http\Controllers\Comptable;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Models\Fournisseurfacture;
use App\Http\Controllers\Controller;
use App\Models\Fournisseurfacturecomptable;
use App\Models\Fournisseurfactureprod;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ComptableFournisseurFactureController extends Controller
{
    //fournisseur
        public function allFournisseur()
        {
            $fournisseurs = Fournisseur::orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.fournisseur.all-fournisseur', compact('fournisseurs'));
        }
        public function fournisseurFactureImpaye(Fournisseur $fournisseur)
        {
            $fournisseurfacturecomptables = $fournisseur->fournisseurfacturecomptables()->where('statut', null)->where('versement', null)->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.fournisseur.facture.facture-impaye', compact('fournisseur','fournisseurfacturecomptables'));
        }
        public function fournisseurFacturePaye(Fournisseur $fournisseur)
        {
            $fournisseurfacturecomptables = $fournisseur->fournisseurfacturecomptables()->where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.fournisseur.facture.facture-paye', compact('fournisseur','fournisseurfacturecomptables'));
        }
        public function fournisseurFacturePartielle(Fournisseur $fournisseur)
        {
            $fournisseurfacturecomptables = $fournisseur->fournisseurfacturecomptables()->where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.fournisseur.facture.facture-partielle', compact('fournisseur','fournisseurfacturecomptables'));
        }
        //gestion
            //statut
                public function allFactureFournisseurImpaye()
                {
                    $fournisseurfacturecomptables = Fournisseurfacturecomptable::where('statut', null)->where('versement', null)->orderBy('updated_at','desc')->get();
                    return view('dashboard.comptable.fournisseur.general-facture.facture-impaye', compact('fournisseurfacturecomptables'));
                }
                public function allFactureFournisseurPaye()
                {
                    $fournisseurfacturecomptables = Fournisseurfacturecomptable::where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
                    return view('dashboard.comptable.fournisseur.general-facture.facture-paye', compact('fournisseurfacturecomptables'));
                }
                public function allFactureFournisseurPartielle()
                {
                    $fournisseurfacturecomptables = Fournisseurfacturecomptable::where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
                    return view('dashboard.comptable.fournisseur.general-facture.facture-partielle', compact('fournisseurfacturecomptables'));
                }
            //
        //
    //














    public function fournisseurFactureDetail(Fournisseurfacture $fournisseurfacture)
    {
        return view('dashboard.comptable.fournisseur.fournisseur-facture-detail', compact('fournisseurfacture'));
    }
 
    public function fournisseurFactureValide()
    {
        $fournisseurfactures = Fournisseurfacture::where('isvalide', 1)->orderBy('updated_at','desc')->get();
        return view('dashboard.comptable.fournisseur.facture-valide', compact('fournisseurfactures'));
    }
    public function fournisseurFactureInvalide()
    {
        $fournisseurfactures = Fournisseurfacture::where('isvalide', 0)->orderBy('updated_at','desc')->get();
        return view('dashboard.comptable.fournisseur.facture-invalide', compact('fournisseurfactures'));
    }

    public function fournisseurFactureEtatUpdate(Fournisseurfacture $fournisseurfacture)
    {
        $fournisseurfacture->update([
            'isvalide' => !$fournisseurfacture->isvalide,
        ]);
            
        return redirect()->route('comptable.fournisseur.facture.valide')->with('success', "Facture $fournisseurfacture->numero_facture approuvé avec succès");
    }

    public function fournisseurFactureAdd(Request $request, Fournisseurfacture $fournisseurfacture)
    {
        $request->validate([
            'fichier' => 'required',
        ]);
        // Generate a unique filename
        $filename = time() . '_' . uniqid() . '.' . $request->file('fichier')->extension();

        // Store the file and get its public path
        // $filePath will contain the path like 'FournisseurFactureFichier/1678888888_abcde.pdf'
        $filePath = $request->file('fichier')->storeAs("FournisseurFactureFichier", $filename, 'public');

        // dd($request->fichier);
        // Optional: If you had a previous file and wanted to delete it
        // if ($fournisseurfacture->fichier) {
        //     Storage::disk('public')->delete($fournisseurfacture->fichier);
        // }

        // Update the 'fichier' field with the stored file's path
        $fournisseurfacture->update([
            'ffacture' => $filePath, // Use $filePath here
        ]);

        return back()->with('success', "Facture associé à $fournisseurfacture->numero_facture avec succès");
    }
}

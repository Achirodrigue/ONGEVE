<?php

namespace App\Http\Controllers\Comptable\newFonction;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Models\Fournisseurfct;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Fournisseurfacturecomptable;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ComptableFournisseurFactureComptableController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'delai_reglement' => 'required|min:1|max:255',
            'designation' => 'required|min:1|max:255',
            'echeance' => 'required|min:1|max:255',
            // 'versement' => 'nullable|numeric|min:1|max:255',
            'total_payer' => 'required|min:1|max:255',
            'facture' => 'nullable|mimes:png,jpg,jpeg,pdf',
            'bon' => 'nullable|mimes:png,jpg,jpeg,pdf',
            'fournisseur_id' => 'required|min:1',
        ]);

        // if ($request->versement > $request->total_payer)
        // {
        //     return back()->with('error', "Desolé! Le total à payer est inferieur à la somme déjà versé.");       
        // }

        //donnée
            $facture = null;
            $bon = null;
            $date = date('d/m/Y H:i');
            $fournisseur = Fournisseur::findOrFail($request->fournisseur_id);

            $statut = null;
            // if($request->versement)
            // {
            //     if($request->versement === $request->total_payer)
            //     {
            //         $statut = 1;
            //     }
            //     else{ $statut = 2;}

            //     // $fournisseurfct = Fournisseurfct::create([
            //     //     'reference' => null,
            //     //     'montant' => $request->versement,
            //     //     'date' => $date,
            //     //     'description' => null,
            //     //     'decaissement' => $request->decaissement,
            //     //     'fournisseurfacturecomptable_id' => $fournisseurfacturecomptable->id,
            //     // ]);
            // }
        //

        if (!empty($request->file('facture')))
        {
            // if(auth()->user()->photo) { Storage::disk('public')->delete(auth()->user()->photo); }
            $facture = storeImage($request->file('facture'), "FournisseurFactureFichier");
        }
        if (!empty($request->file('bon')))
        {
            $bon = storeImage($request->file('bon'), "FournisseurFactureBon");
        }

        // Génération de la référence
            $nom = strtoupper(substr(removeAccents($fournisseur->nom), 0, 3));
            $contact = strtoupper(substr(removeAccents($fournisseur->contact), 0, 3));
            $lastfacture = Fournisseurfacturecomptable::orderBy('id', 'desc')->first();
            $lastNumber = $lastfacture ? $lastfacture->id : 0;
            $numero_facture = "{$nom}-{$contact}-{$lastNumber}";
        //
        
        $fournisseurfacturecomptable = Fournisseurfacturecomptable::create([
            'numero_facture' => $numero_facture,
            'date' => $date,
            'delai_reglement' => $request->delai_reglement,
            'designation' => $request->designation,
            'echeance' => $request->echeance,
            'statut' => $statut,
            'versement' => null ,//$request->versement,
            'total_payer' => $request->total_payer,
            'facture' => $facture,
            'bon' => $bon,
            'createur' => 0,
            'fournisseur_id' => $fournisseur->id,
        ]);

        $nom = "$fournisseurfacturecomptable->numero_facture ajouté avec succès";
        
        if($statut == null)
        {
            return redirect()->route('comptable.fournisseur.facture.impaye', compact('fournisseur'))->with('success', $nom);
        }elseif($statut == 1){
            return redirect()->route('comptable.fournisseur.facture.paye', compact('fournisseur'))->with('success', $nom);
        }else{
            return redirect()->route('comptable.fournisseur.facture.partielle', compact('fournisseur'))->with('success', $nom);
        }
    }

    public function edit(Fournisseurfacturecomptable $fournisseurfacturecomptable)  
    {
        // return view('dashboard.comptable.client.edit-client', compact('client'));
    }

    public function update(Request $request, Fournisseurfacturecomptable $fournisseurfacturecomptable)
    {
        //données
            $noms = $fournisseurfacturecomptable->numero_facture ;
            $statut = $fournisseurfacturecomptable->statut ;
            $facture = $fournisseurfacturecomptable->facture ;
            $bon = $fournisseurfacturecomptable->bon ;
        //
        
        $this->validate($request, [
            'delai_reglement' => 'required|min:1|max:255',
            'designation' => 'required|min:1|max:255',
            'echeance' => 'required|min:1|max:255',
            'total_payer' => 'required|min:1|max:255',
            'facture' => 'nullable|mimes:png,jpg,jpeg,pdf',
            'bon' => 'nullable|mimes:png,jpg,jpeg,pdf',
            // 'fournisseur_id' => 'required|min:1',
        ]);

        if ($request->total_payer < $fournisseurfacturecomptable->versement)
        {
            return back()->with('error', "Desolé! Le total à payer est inferieur à la somme déjà versé.");       
        }

        if ($request->total_payer > $fournisseurfacturecomptable->versement && $fournisseurfacturecomptable->versement != null)
        { $statut = 2; }
        if ($request->total_payer == $fournisseurfacturecomptable->versement)
        { $statut = 1; }


        if (!empty($request->file('facture')))
        {
            if($fournisseurfacturecomptable->facture) { Storage::disk('public')->delete($fournisseurfacturecomptable->facture); }
            $facture = storeImage($request->file('facture'), "FournisseurFactureFichier");
        }
        if (!empty($request->file('bon')))
        {
            if($fournisseurfacturecomptable->bon) { Storage::disk('public')->delete($fournisseurfacturecomptable->bon); }
            $bon = storeImage($request->file('bon'), "FournisseurFactureBon");
        }
        
        $fournisseurfacturecomptable->update($request->post());

        $fournisseurfacturecomptable->update([
            'statut' => $statut,
            'facture' => $facture,
            'bon' => $bon,
        ]);
        
        return back()->with('success', "$noms modifié avec succès");
    }

    public function destroy(Fournisseurfacturecomptable $fournisseurfacturecomptable)
    {
        //données
            $noms = $fournisseurfacturecomptable->numero_facture ;
        //
        $fournisseurfacturecomptable->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }

    //fournisseur facture comptable transaction
        public function fournisseurFactureTransaction(Fournisseurfacturecomptable $fournisseurfacturecomptable)
        {
            $fournisseurfcts = $fournisseurfacturecomptable->fournisseurfcts()->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.fournisseur.facture-transaction', compact('fournisseurfacturecomptable','fournisseurfcts'));
        }
        public function fournisseurFactureTransactionStore(Request $request, Fournisseurfacturecomptable $fournisseurfacturecomptable)
        {
            $this->validate($request, [
                'decaissement' => 'required|min:1|max:255',
                'montant' => 'required|min:1|max:255',
                'reference' => 'required|min:1|max:255',
            ]);
            
            //données
                $date = date('d/m/Y H:i');
                $versement = $fournisseurfacturecomptable->versement + $request->montant;

                if ($versement > $fournisseurfacturecomptable->total_payer)
                {
                    return back()->with('error', "Desolé! Le montant est superieur au reste à payer.");       
                }

                if ($versement == $fournisseurfacturecomptable->total_payer) { $statut = 1; } else{ $statut = 2; }
            //

            $fournisseurfct = Fournisseurfct::create([
                'reference' => $request->reference,
                'montant' => $request->montant,
                'date' => $date,
                'description' => null,
                'decaissement' => $request->decaissement,
                'fournisseurfacturecomptable_id' => $fournisseurfacturecomptable->id,
            ]);

            $fournisseurfacturecomptable->update([
                'statut' => $statut,
                'versement' => $versement,
            ]);

            return redirect()->route('comptable.fournisseur.facture.transaction', compact('fournisseurfacturecomptable'))->with('success', "Nouvelle transaction de $fournisseurfct->montant ajouté avec succès");
        }
        public function fournisseurFactureTransactionUpdate(Request $request, Fournisseurfct $fournisseurfct)
        {
            //données
                $noms = $fournisseurfct->montant ;
                $statut = $fournisseurfct->fournisseurfacturecomptable->statut ;
            //
            
            $this->validate($request, [
                'montant' => 'required|min:1|max:255',
                'decaissement' => 'required|min:1|max:255',
                'reference' => 'required|min:1|max:255',
            ]);

            //données
                $noms = $fournisseurfct->montant ;
                $versement = $fournisseurfct->fournisseurfacturecomptable->versement - $fournisseurfct->montant;
                $newVersement = $fournisseurfct->fournisseurfacturecomptable->versement + $request->montant;
            //

            if ($request->montant > ($fournisseurfct->fournisseurfacturecomptable->total_payer - $versement))
            {
                return back()->with('error', "Desolé! Le montant est superieur au reste à payer.");       
            }

            if ($newVersement == $fournisseurfct->fournisseurfacturecomptable->total_payer) { $statut = 1; } else{ $statut = 2; }

            $fournisseurfct->fournisseurfacturecomptable->update([
                'statut' => $statut,
                'versement' => $newVersement,
            ]);
            
            $fournisseurfct->update($request->post());
            
            return back()->with('success', "Transaction à {$noms}F supprimé avec succès");
        }
        public function fournisseurFactureTransactionDestroy(Fournisseurfct $fournisseurfct)
        {
            //données
                $noms = $fournisseurfct->montant ;
                $versement = $fournisseurfct->fournisseurfacturecomptable->versement - $fournisseurfct->montant;
                // $etatVersement = $fournisseurfct->fournisseurfacturecomptable->total_payer - $versement;
            //

            if ($versement == 0) { $statut = null; } else{ $statut = 2; }

            $fournisseurfct->fournisseurfacturecomptable->update([
                'statut' => $statut,
                'versement' => $versement,
            ]);

            $fournisseurfct->delete();
            return back()->with('success', "Transaction à {$noms}F supprimé avec succès");
        }
    //
}

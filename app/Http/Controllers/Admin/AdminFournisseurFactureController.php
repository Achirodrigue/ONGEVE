<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Models\Fournisseurfacture;
use App\Http\Controllers\Controller;
use App\Models\Fournisseurfacturecomptable;
use App\Models\Fournisseurfactureprod;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AdminFournisseurFactureController extends Controller
{
    //fournisseur
        public function allFournisseur()
        {
            $fournisseurs = Fournisseur::orderBy('updated_at','desc')->get();
            return view('dashboard.admin.fournisseur.all-fournisseur', compact('fournisseurs'));
        }
        public function fournisseurFactureImpaye(Fournisseur $fournisseur)
        {
            $fournisseurfacturecomptables = $fournisseur->fournisseurfacturecomptables()->where('statut', null)->where('versement', null)->orderBy('updated_at','desc')->get();
            return view('dashboard.admin.fournisseur.facture.facture-impaye', compact('fournisseur','fournisseurfacturecomptables'));
        }
        public function fournisseurFacturePaye(Fournisseur $fournisseur)
        {
            $fournisseurfacturecomptables = $fournisseur->fournisseurfacturecomptables()->where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
            return view('dashboard.admin.fournisseur.facture.facture-paye', compact('fournisseur','fournisseurfacturecomptables'));
        }
        public function fournisseurFacturePartielle(Fournisseur $fournisseur)
        {
            // dd(1);
            $fournisseurfacturecomptables = $fournisseur->fournisseurfacturecomptables()->where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
            return view('dashboard.admin.fournisseur.facture.facture-partielle', compact('fournisseur','fournisseurfacturecomptables'));
        }
        //gestion
            //statut
                public function allFactureFournisseurImpaye()
                {
                    $fournisseurfacturecomptables = Fournisseurfacturecomptable::where('statut', null)->where('versement', null)->orderBy('updated_at','desc')->get();
                    return view('dashboard.admin.fournisseur.general-facture.facture-impaye', compact('fournisseurfacturecomptables'));
                }
                public function allFactureFournisseurPaye()
                {
                    $fournisseurfacturecomptables = Fournisseurfacturecomptable::where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
                    return view('dashboard.admin.fournisseur.general-facture.facture-paye', compact('fournisseurfacturecomptables'));
                }
                public function allFactureFournisseurPartielle()
                {
                    $fournisseurfacturecomptables = Fournisseurfacturecomptable::where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
                    return view('dashboard.admin.fournisseur.general-facture.facture-partielle', compact('fournisseurfacturecomptables'));
                }
            //
        //
    //
    //fournisseur facture comptable transaction
        public function fournisseurFactureTransaction(Fournisseurfacturecomptable $fournisseurfacturecomptable)
        {
            $fournisseurfcts = $fournisseurfacturecomptable->fournisseurfcts()->orderBy('updated_at','desc')->get();
            return view('dashboard.admin.fournisseur.facture-transaction', compact('fournisseurfacturecomptable','fournisseurfcts'));
        }
    //
}

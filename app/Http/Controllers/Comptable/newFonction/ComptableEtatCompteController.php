<?php

namespace App\Http\Controllers\Comptable\newFonction;

use App\Models\Clientdevis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Fournisseurfacturecomptable;

class ComptableEtatCompteController extends Controller
{
    //client
        public function etatCompteClientImpaye()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', null)->where('versement', null)->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.etat-compte.client.facture-impaye', compact('clientdevis'));
        }
        public function etatCompteClientPartielle()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.etat-compte.client.facture-partielle', compact('clientdevis'));
        }
        public function etatCompteClientPaye()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.etat-compte.client.facture-paye', compact('clientdevis'));
        }
    //
    //fournisseur
        public function etatCompteFournisseurImpaye()
        {
            // dd(5);
            $fournisseurfacturecomptables = Fournisseurfacturecomptable::where('statut', null)->where('versement', null)->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.etat-compte.fournisseur.facture-impaye', compact('fournisseurfacturecomptables'));
        }
        public function etatCompteFournisseurPartielle()
        {
            $fournisseurfacturecomptables = Fournisseurfacturecomptable::where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.etat-compte.fournisseur.facture-partielle', compact('fournisseurfacturecomptables'));
        }
        public function etatCompteFournisseurPaye()
        {
            $fournisseurfacturecomptables = Fournisseurfacturecomptable::where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.etat-compte.fournisseur.facture-paye', compact('fournisseurfacturecomptables'));
        }
    //

    //chiffre d'affaire client
        public function chiffreAffaireClientImpaye()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', null)->where('versement', null)->orderBy('updated_at','desc')->get();

                // dd($clientdevis->count());
            return view('dashboard.comptable.chiffre-affaire.client.facture-impaye', compact('clientdevis'));
        }
        public function chiffreAffaireClientPartielle()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.chiffre-affaire.client.facture-partielle', compact('clientdevis'));
        }
        public function chiffreAffaireClientPaye()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
                // dd($clientdevis->count());
            return view('dashboard.comptable.chiffre-affaire.client.facture-paye', compact('clientdevis'));
        }

        public function chiffreAffaireClientGeneral()
        {
            $clientdevisimpayes = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                $query->where('isvalide', 1);
            })->where('statut', null)->where('versement', null)->orderBy('updated_at','desc')->get();

            $clientdevispartielles = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                $query->where('isvalide', 1);
            })->where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();

            $clientdevispayes = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                $query->where('isvalide', 1);
            })->where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();

            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                $query->where('isvalide', 1);
            })->get();

            return view('dashboard.comptable.chiffre-affaire.client.facture-globale', compact('clientdevis','clientdevisimpayes','clientdevispartielles','clientdevispayes'));
        }
    //
}
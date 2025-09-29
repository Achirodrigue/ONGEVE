<?php

namespace App\Http\Controllers\Commercial\newFonction;

use App\Models\Clientdevis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CommercialFactureClientController extends Controller
{
    //facture client
        public function factureClientImpaye()
        {
            if(auth()->user()->role)
            {
                $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', null)->where('versement', null)->orderBy('updated_at','desc')->get();
            }
            else
            {
                $clientdevis = auth()->user()->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', null)->where('versement', null)->orderBy('updated_at','desc')->get();
            }

            return view('dashboard.commercial.facture-client.facture-impaye', compact('clientdevis'));
        }
        public function factureClientPartielle()
        {
            if(auth()->user()->role)
            {
                $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
            }
            else
            {
                $clientdevis = auth()->user()->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
            }

            return view('dashboard.commercial.facture-client.facture-partielle', compact('clientdevis'));
        }
        public function factureClientPaye()
        {
            if(auth()->user()->role)
            {
                $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', 2)->where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
            }
            else
            {
                $clientdevis = auth()->user()->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
            }

            return view('dashboard.commercial.facture-client.facture-paye', compact('clientdevis'));
        }
    //
}
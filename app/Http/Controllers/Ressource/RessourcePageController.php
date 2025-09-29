<?php

namespace App\Http\Controllers\Ressource;

use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\Client;
use App\Models\Projet;
use App\Models\Employe;
use App\Models\Clientdevis;
use Illuminate\Http\Request;
use App\Models\Employepresence;
use Illuminate\Routing\Controller;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Validation\ValidatesRequests;

class RessourcePageController extends Controller
{
    use ValidatesRequests;

    public function logout(Request $request) {
        Auth::logout();
        return redirect(route('ressource.login'));
    }
    
    public function home()
    {
        $clientdevis = Clientdevis::orderBy('updated_at','desc')->get();
        $employes = Employe::orderBy('updated_at','desc')->get();
        $demandeconges = Employe::orderBy('updated_at','desc')->get();
        $demandeconges = 0;
        
        $CA = 0 ;
        $MT = 0 ;
        foreach($clientdevis as $ChiffreAffaire)
        {
            $CA += $ChiffreAffaire->versement ;
            $MT += $ChiffreAffaire->total_payer ;
        }

        //client
            $clients = Client::orderBy('updated_at','desc')->get();
        //

        return  view('dashboard.ressource.home', 
                compact('employes','demandeconges','CA','MT','clients'));
    }

    //projet   
        public function projet()
        { 
            $projets = Projet::orderBy('updated_at','desc')->get();
            return  view('dashboard.ressource.projet.projet', compact('projets'));
        }
        public function projetTache(Projet $projet)
        { 
            return  view('dashboard.ressource.projet.projet-tache', compact('projet'));
        }
    //

    //liste de presence employéuse 
        public function listePresence()
        {
            // dd(1);
            $dateDebut = Carbon::createFromFormat('d/m/Y', '01/08/2025');
            $dateFin = Carbon::today();

            // Générer toutes les dates de dateFin vers dateDebut (ordre décroissant)
            $dates = [];
            $date = $dateFin->copy();
            while ($date->gte($dateDebut)) {
                $dates[] = $date->copy();
                $date->subDay();
            }

            // Récupérer toutes les présences dans la plage selon la colonne 'date'
            $presences = Employepresence::whereBetween('date', [$dateDebut->format('Y-m-d'), $dateFin->format('Y-m-d')])
                ->with('employe')
                ->get()
                ->groupBy(function ($presence) {
                    // Formatage clé de groupement en Y-m-d
                    return Carbon::parse($presence->date)->format('Y-m-d');
                });

            // Conversion en objet PHP (pour accéder avec -> dans Blade)
            // $presences = json_decode(json_encode($presences));
            $dates = collect($dates);

            return view('dashboard.ressource.presence.liste-presence', compact('dates', 'presences'));
        }
        public function listePresenceEmploye($ids, $date)
        {
            // dd($date);
            $idsT = explode(',', $ids); // transforme la chaîne en tableau d'IDs
            $presences = Employepresence::whereIn('id', $idsT)->get();
            return view('dashboard.ressource.presence.liste-presence-employe', compact('date', 'presences'));
        }
        public function presenceQrcodePdf() 
        {
            return view('dashboard.ressource.presence.qrcode-pdf');
            // dd(1);
            // $html = View::make('dashboard.ressource.presence.qrcode-presence')->render();
    
            // $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            // $mpdf->WriteHTML($html);

            // return response()->streamDownload(
            //     fn () => $mpdf->Output(),
            //     "Qrcode-presence.pdf"
            // );

            $url = route('commun.formulaire.presence'); // URL du formulaire

            // Générer le QR code en PNG et récupérer en base64
            $result = Builder::create()
                ->writer(new PngWriter())
                ->data($url)
                ->size(200)
                ->margin(10)
                ->build();

            $qrCodeDataUri = $result->getDataUri();

            // Générer le contenu HTML du PDF avec le QR code intégré en base64
            $html = view('dashboard.ressource.presence.qrcode-presence', compact('qrCodeDataUri'))->render();

            // Générer le PDF avec mPDF
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            return $mpdf->Output('formulaire_inscription.pdf', 'I'); // Affiche dans le navigateur
        }
    //
}

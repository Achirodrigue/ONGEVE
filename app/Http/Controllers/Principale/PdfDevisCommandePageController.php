<?php

namespace App\Http\Controllers\Principale;

use Mpdf\Mpdf;
use App\Models\Clientdevis;
use App\Models\Clientdevisavoir;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use App\Models\Fournisseurfacturecomptable;

class PdfDevisCommandePageController extends Controller
{
    //devis pdf

    // public function pdfVente() 
        public function pdfVente(Clientdevis $clientdevis) 
        {
            if($clientdevis->TDF == null)
            {
                $html = View::make('dashboard.facture.pdf-vente', compact('clientdevis'))->render();
        
                $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
                $mpdf->WriteHTML($html);

                return response()->streamDownload(
                    fn () => $mpdf->Output(),
                    "facture-vente-$clientdevis->id.pdf"
                );
            }
            elseif($clientdevis->TDF == 1) 
            {
                $html = View::make('dashboard.facture.pdf-location', compact('clientdevis'))->render();
        
                $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
                $mpdf->WriteHTML($html);

                return response()->streamDownload(
                    fn () => $mpdf->Output(),
                    "facture-location-$clientdevis->id.pdf"
                );
            }
            elseif($clientdevis->TDF == 2) 
            {
                $html = View::make('dashboard.facture.pdf-prestation', compact('clientdevis'))->render();
        
                $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
                $mpdf->WriteHTML($html);

                return response()->streamDownload(
                    fn () => $mpdf->Output(),
                    "facture-prestation-$clientdevis->id.pdf"
                );
            }
            else
            {
                return back()->with('error', "Desolé! erreur lors du chargement");
            }
        }
        public function pdfBonLivraison(Clientdevis $clientdevis) 
        {
            $html = View::make('dashboard.facture.pdf-bon-livraison', compact('clientdevis'))->render();
    
            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($html);

            return response()->streamDownload(
                fn () => $mpdf->Output(),
                "bon-livraison-$clientdevis->id.pdf"
            );
        }

        // public function pdfLocation(Clientdevis $clientdevis) 
        public function pdfLocation() 
        {
            // return view('dashboard.facture.pdf-location');
            $html = View::make('dashboard.facture.pdf-location')->render();
            // $html = View::make('dashboard.facture.pdf-location', compact('clientdevis'))->render();
    
            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($html);

            return response()->streamDownload(
                fn () => $mpdf->Output(),
                "facture-location.pdf"
                // "facture-location-$clientdevis->id.pdf"
            );
        }

        // public function pdfPrestation(Clientdevis $clientdevis) 
        public function pdfPrestation() 
        {
            $html = View::make('dashboard.facture.pdf-prestation')->render();
            // $html = View::make('dashboard.facture.pdf-prestation', compact('clientdevis'))->render();
    
            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($html);

            return response()->streamDownload(
                fn () => $mpdf->Output(),
                "facture-prestation.pdf"
                // "facture-prestation-$clientdevis->id.pdf"
            );
        }





        public function pdfAvoir(Clientdevisavoir $clientdevisavoir) 
        {
            $html = View::make('dashboard.facture.pdf-avoir', compact('clientdevisavoir'))->render();
        
    
            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($html);

            return response()->streamDownload(
                fn () => $mpdf->Output(),
                "facture-$clientdevisavoir->id.pdf"
            );
        }
        public function pdfBordereau(Fournisseurfacturecomptable $fournisseurfacturecomptable) 
        {
            // $html = View::make('dashboard.facture.pdf-vente', compact('clientdevis'))->render();

            // $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            // $mpdf->WriteHTML($html);

            // $pdfContent = $mpdf->Output('', 'S'); // 'S' = retourne en string

            // return response()->streamDownload(
            //     fn () => print($pdfContent),
            //     "facture-$clientdevis->id.pdf"
            // );

            // $html = View::make('dashboard.facture.pdf-vente', compact('clientdevis'))->render();

            // $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            // $mpdf->WriteHTML($html);
            // $mpdf->Output("facture-$clientdevis->id.pdf", 'I'); // 'I' = inline dans le navigateur

            // // 1️⃣ Charger la vue Blade et la rendre en HTML
            // $html = view('dashboard.facture.pdf-vente')->render();

            // // 2️⃣ Créer mPDF
            // $mpdf = new Mpdf();

            // // 3️⃣ Écrire le HTML
            // $mpdf->WriteHTML($html);

            // // 4️⃣ Télécharger le PDF
            // $mpdf->Output('facture.pdf', 'I');

            $html = View::make('dashboard.facture.pdf-bordereau', compact('fournisseurfacturecomptable'))->render();
    
            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($html);

            // Mail::send([], [], function ($message) use ($clientdevis, $mpdf) {
            //     $message->to("achirodrigue3@gmail.com")
            //             ->subject('Votre devis ' . $clientdevis->reference)
            //             ->attachData($mpdf->output(), "devis_{$clientdevis->reference}.pdf");
            // });

            return response()->streamDownload(
                fn () => $mpdf->Output(),
                "facture-$fournisseurfacturecomptable->id.pdf"
            );
        }
    //
}

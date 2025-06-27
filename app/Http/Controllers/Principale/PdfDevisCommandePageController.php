<?php

namespace App\Http\Controllers\Principale;

use Mpdf\Mpdf;
use App\Models\Clientdevis;
use App\Models\Particulierdevis;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class PdfDevisCommandePageController extends Controller
{
    //devis pdf
        public function pdfDevisCommandeClient(Clientdevis $clientdevis) 
        {
            $html = View::make('dashboard.facture.pdf-client', compact('clientdevis'))->render();
        
    
            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($html);

            Mail::send([], [], function ($message) use ($clientdevis, $mpdf) {
                $message->to("achirodrigue3@gmail.com")
                        ->subject('Votre devis ' . $clientdevis->reference)
                        ->attachData($mpdf->output(), "devis_{$clientdevis->reference}.pdf");
            });

            return response()->streamDownload(
                fn () => $mpdf->Output(),
                "facture-$clientdevis->id.pdf"
            );
        }
        public function pdfDevisCommandeParticulier(Particulierdevis $particulierdevis) 
        {
            $html = View::make('dashboard.facture.pdf-particulier', compact('particulierdevis'))->render();
        
            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($html);

            return response()->streamDownload(
                fn () => $mpdf->Output(),
                "facture-$particulierdevis->id.pdf"
            );
        }
    //
}

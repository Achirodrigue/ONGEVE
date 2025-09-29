<?php

namespace App\Exports;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use App\Models\Clientdevis; // Remplacez par votre modèle si nécessaire
use Maatwebsite\Excel\Concerns\WithHeadings; // Optionnel : pour ajouter des en-têtes
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ClientdevisExport implements FromCollection, WithHeadings, WithTitle, WithMapping, WithEvents, WithCustomStartCell, WithDrawings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // //param
        // protected $clientDevisId;

        // public function __construct($clientDevisId)
        // {
        //     $this->clientDevisId = $clientDevisId;
        // }
        // public function collection()
        // {
        //     return \App\Models\ClientDevis::with(['client', 'clientdevisbon', 'Clientdevistransactions'])
        //         ->where('id', $this->clientDevisId)
        //         ->get(); // 👈 N'oublie le ->get() (car FromCollection attend une collection)
        // }
    // //
    public function collection()
    {
        // Récupérez les données que vous souhaitez exporter
        // Exemple : toutes les données de la table 'users'
        // return Clientdevis::select('id', 'numero_devis', 'total_payer', 'statut', 'created_at')->get();
         return ClientDevis::with(['client', 'clientdevisbon', 'Clientdevistransactions'])->get();

        // Ou pour des colonnes spécifiques :
        // return User::select('id', 'name', 'email')->get();

        // Ou avec des conditions :
        // return User::where('status', 'active')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Définissez les en-têtes de vos colonnes Excel
        // return [
        //     'ID',
        //     'Nom',
        //     'Email',
        //     // Ajoutez d'autres en-têtes correspondant à vos colonnes
        // ];
        // return ["Date d'émission", 'Client', 'Numero facture', 'Désignation', 'Date reception', 'Delai paiement', 'Net à payer', 'Montant reglé', 'Reste à payer'];
        return [
            'Date émission',
            'Client',
            'Numéro facture',
            'Désignation',
            'Date réception',
            'Délai paiement',
            'Net à payer',
            'Montant réglé',
            'Reste à payer',
            'Bon de commande (lien)',
            'Détails (lien)',
            'Transactions (lien)',
        ];
    }

    public function map($clientdevis): array
    {
        $bonCommandeURL = $clientdevis->clientdevisbon
            ? asset(Storage::url($clientdevis->clientdevisbon->bon))
            : null;

        $detailsURL = route('comptable.commande.client.detail', $clientdevis);
        $transactionsURL = route('comptable.commande.client.versement', $clientdevis);

        return [
            $clientdevis->created_at->format('d/m/Y H:i'),
            $clientdevis->client->nom ?? '',
            $clientdevis->numero_devis,
            $clientdevis->TD ? 'Location' : 'Vente de produit',
            $clientdevis->daterecfacture ?? 'Vide',
            $clientdevis->delai_paiement ?? 'Vide',
            $clientdevis->total_payer,
            $clientdevis->versement,
            $clientdevis->total_payer - $clientdevis->versement,
            $bonCommandeURL ? '=HYPERLINK("' . $bonCommandeURL . '", "Voir bon")' : 'Non disponible',
            '=HYPERLINK("' . $detailsURL . '", "Voir détails")',
            '=HYPERLINK("' . $transactionsURL . '", "Voir transactions (' . $clientdevis->Clientdevistransactions->count() . ')")',
        ];
    }

    public function title(): string
    {
        // Retourne le titre de la feuille Excel
        return 'Rapport des utilisateurs'; // Votre titre ici
    }

    public function startCell(): string
    {
        return 'A6'; // Le tableau commencera à la ligne 6 (A6)
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Contenu des entêtes personnalisés
                $sheet->setCellValue('A1', 'IVOIRE TRANSPORT');
                $sheet->setCellValue('A2', 'Rapport des commandes clients');
                $sheet->setCellValue('A3', 'Période : Janvier - Juin 2025');
                $sheet->setCellValue('A4', 'Téléchargé le : ' . now()->format('d/m/Y'));

                // Mise en forme (optionnelle)
                $sheet->mergeCells('A1:L1');
                $sheet->mergeCells('A2:L2');
                $sheet->mergeCells('A3:L3');
                $sheet->mergeCells('A4:L4');

                $sheet->getStyle('A1')->getFont()->setSize(16)->setBold(true);
                $sheet->getStyle('A2')->getFont()->setSize(14)->setBold(true);
                $sheet->getStyle('A3')->getFont()->setItalic(true);
                $sheet->getStyle('A4')->getFont()->setItalic(true);
            },
        ];
        
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo Ivoire Transport');
        $drawing->setPath(public_path('dashboard/img/logo1.png')); // 📌 Chemin vers ton image (mets-la dans le dossier "public/")
        $drawing->setHeight(80); // hauteur en pixels
        $drawing->setCoordinates('A1'); // position dans Excel
        $drawing->setOffsetX(10);
        $drawing->setOffsetY(5);

        return [$drawing];
    }

}
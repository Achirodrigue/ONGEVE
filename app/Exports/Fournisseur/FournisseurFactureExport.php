<?php

namespace App\Exports\Fournisseur;

use App\Models\Fournisseurfacturecomptable;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    WithMapping,
    WithEvents,
    WithCustomStartCell,
    WithDrawings,
    ShouldAutoSize
};
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class FournisseurFactureExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithEvents,
    WithCustomStartCell,
    WithDrawings,
    ShouldAutoSize // élargit les colonnes automatiquement
{
    public function collection()
    {
        return Fournisseurfacturecomptable::with(['fournisseur', 'fournisseurfcts'])->get();
    }

    public function headings(): array
    {
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
            '=HYPERLINK("' . $transactionsURL . '", "Voir transactions (' . $clientdevis->clientdevistransactions->count() . ')")',
        ];
    }

    public function startCell(): string
    {
        return 'A8'; // Commence après les infos et le logo
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Infos d’en-tête à gauche
                $sheet->setCellValue('A1', "GROUPE CHALLENGE LOGISTIQUE INTERNATIONAL SERVICE");
                $sheet->setCellValue('A2', "18 BP 268 Abj 18");
                $sheet->setCellValue('A3', "Téléphone : 2721350013");
                $sheet->setCellValue('A4', "Fax : 2721250253");
                $sheet->setCellValue('A5', "Email : clis2001@yahoo.fr");
                $sheet->setCellValue('A6', "Téléchargé le : " . now()->format('d/m/Y'));

                // Fusionner pour alignement propre
                foreach (range(1, 6) as $row) {
                    $sheet->mergeCells("A{$row}:H{$row}");
                }

                // Mise en forme
                $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);
                $sheet->getStyle('A2:A6')->getFont()->setSize(11);

                // ➕ Mettre les entêtes du tableau en gras (ligne 8)
                $sheet->getStyle('A8:L8')->getFont()->setBold(true);

                // ✅ Couleur de fond pour les en-têtes du tableau
                $sheet->getStyle('A8:L8')->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => 'D9E1F2', // Bleu clair
                        ],
                    ],
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => '000000'],
                    ],
                ]);
            }
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo CLIS');
        $drawing->setPath(public_path('dashboard/img/logo1.png')); // chemin vers le logo
        $drawing->setHeight(40); // plus petit
        $drawing->setCoordinates('I1'); // à droite
        $drawing->setOffsetX(20);
        $drawing->setOffsetY(5);

        return [$drawing];
    }
}

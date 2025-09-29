<?php

namespace App\Exports\Client;

use App\Models\Clientdevis;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    WithMapping,
    WithTitle,
    WithEvents,
    WithCustomStartCell,
    WithDrawings,
    ShouldAutoSize
};
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ClientdevisIndividuelExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithEvents,
    WithTitle,
    WithCustomStartCell,
    WithDrawings,
    ShouldAutoSize // élargit les colonnes automatiquement
{
    protected $client;
    protected $statut;
    protected $rowCount;

    public function __construct(Client $client, $statut)
    {
        $this->client = $client;
        $this->statut = $statut;
    }

    public function collection()
    {
        if($this->statut == 0) {$statut = null;} elseif($this->statut == 1) {$statut = 1;} else {$statut = 2;}

        // $fournisseur = Fournisseur::with('fournisseurfacturecomptables')->findOrFail($this->fournisseur);

        $clientdevis = $this->client->clientdevis()
            ->whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', $statut)->orderBy('created_at','desc')->get();

        $this->rowCount = $clientdevis->count(); // 💡 On stocke le nombre de lignes
        return $clientdevis;
    }

    public function headings(): array
    {
        return [
            'Date émission',
            'Numéro facture',
            'Désignation',
            'Date réception',
            'Délai paiement',
            'Net à payer (Fcfa)',
            'Montant réglé (Fcfa)',
            'Reste à payer (Fcfa)',
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
        if($clientdevis->TDF == null)
        { $TDF = "Vente de produit"; }
        elseif($clientdevis->TDF == 1)
        { $TDF = "Location de produit"; }
        else
        { $TDF = "Prestation de service"; }

        $detailsURL = route('comptable.commande.client.detail', $clientdevis);
        $transactionsURL = route('comptable.commande.client.versement', $clientdevis);

        return [
            $clientdevis->created_at->format('d/m/Y H:i'),
            $clientdevis->numero_devis,
            $TDF,
            $clientdevis->daterecfacture ?? 'Vide',
            $clientdevis->delai_paiement ?? 'Vide',
            $clientdevis->total_payer,
            $clientdevis->versement ?? '0',
            $clientdevis->total_payer - $clientdevis->versement,
            $bonCommandeURL ? '=HYPERLINK("' . $bonCommandeURL . '", "Voir bon")' : 'Non disponible',
            '=HYPERLINK("' . $detailsURL . '", "Voir détails")',
            $clientdevis->Clientdevistransactions->count() > 0 ? '=HYPERLINK("' . $transactionsURL . '", "Voir transactions (' . $clientdevis->Clientdevistransactions->count() . ')")' : 'Aucune',
        ];
    }

    public function title(): string
    {
        // Retourne le titre de la feuille Excel
        return 'Rapport des clients'; // Votre titre ici
    }

    public function startCell(): string
    {
        return 'A10'; // Commence après les infos et le logo
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
                $sheet->setCellValue('A7', 'Client : ' . $this->client->nom);
                $statutLabel = match ((int)$this->statut) {
                    0 => "Impayé",
                    1 => "Finalisé",
                    2 => "Partiellement Payé",
                    default => "Inconnu",
                };
                $sheet->setCellValue('A8', 'Statut des Factures : ' . $statutLabel);

                // Fusionner pour alignement propre
                foreach (range(1, 8) as $row) {
                    $sheet->mergeCells("A{$row}:H{$row}");
                }

                // Mise en forme
                $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);
                $sheet->getStyle('A2:A6')->getFont()->setSize(11);
                $sheet->getStyle('A7:A8')->getFont()->setItalic(true)->setSize(11);

                // ➕ Mettre les entêtes du tableau en gras (ligne 10)
                $sheet->getStyle('A10:K10')->getFont()->setBold(true);

                // ✅ Couleur de fond pour les en-têtes du tableau
                $sheet->getStyle('A10:K10')->applyFromArray([
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

                // Style des liens (texte bleu souligné)
                $linkStyle = [
                    'font' => [
                        'color' => ['rgb' => '0000FF'],
                        'underline' => 'single'
                    ]
                ];

                // Appliquer le style aux colonnes I, J et K
                for ($row = 11; $row < 11 + $this->rowCount; $row++) {
                    $sheet->getStyle("I{$row}")->applyFromArray($linkStyle);
                    $sheet->getStyle("J{$row}")->applyFromArray($linkStyle);
                    $sheet->getStyle("K{$row}")->applyFromArray($linkStyle);
                }

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